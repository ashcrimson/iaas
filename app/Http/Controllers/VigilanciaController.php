<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\ScopeVigilanciaDataTable;
use App\DataTables\VigilanciaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use App\Models\Paciente;
use App\Models\Role;
use App\Models\Vigilancia;
use App\Models\SolicitudEstado;
use App\Models\SolicitudMedicamento;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Exception;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use nusoap_client;
use Response;

class VigilanciaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Vigilancias')->only(['show']);
        $this->middleware('permission:Crear Vigilancias')->only(['create','store']);
        $this->middleware('permission:Editar Vigilancias')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Vigilancias')->only(['destroy']);
    }

    /**
     * Display a listing of the Vigilancia.
     *
     * @param VigilanciaDataTable $vigilanciaDataTable
     * @return Response
     */
    public function index(VigilanciaDataTable $vigilanciaDataTable)
    {
        $scope = new ScopeVigilanciaDataTable();
        $scope->del = $request->del ?? null;
        $scope->al = $request->al ?? null;

        $vigilanciaDataTable->addScope($scope);

        return $vigilanciaDataTable->render('vigilancias.index');
    }


    /**
     * Show the form for creating a new Vigilancia.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        /**
         * @var Vigilancia $vigilancia
         */
        $vigilancia = $this->getVigilanciaTemporal();

        if ($request->rut){
            return redirect(route('vigilancias.edit',$vigilancia->id).'?rut='.$request->rut);

        }else{
            return redirect(route('vigilancias.edit',$vigilancia->id));

        }




    }

    /**
     * Store a newly created Vigilancia in storage.
     *
     * @param CreateVigilanciaRequest $request
     *
     * @return Response
     */
    public function store(CreateVigilanciaRequest $request)
    {

        try {
            DB::beginTransaction();

            /**
             * @var  Paciente $paciente
             */
            $paciente = $this->creaOactualizaPaciente($request);

            $request->merge([
                'user crea' => auth()->user()->id,
                'paciente_id' => $paciente->id,
                'estado_id' => SolicitudEstado::INGRESADA,
                'fecha_inicio_tratamiento' => 'fecha_solicita'
            ]);

            /** @var Solicitud $vigilencia */

            $vigilancia = Vigilancia::create($request->all());

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();


        flash()->success('Vigilancia guardada exitosamente.');

        return redirect(route('vigilancias.index'));
    }

    /**
     * Display the specified Vigilancia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vigilancia $vigilancia */
        $vigilancia = Vigilancia::find($id);

        if (empty($vigilancia)) {
            flash()->error('Vigilancia no encontrada');

            return redirect(route('vigilancias.index'));
        }

        return view('vigilancias.show')->with('vigilancia', $vigilancia);
    }

    /**
     * Show the form for editing the specified Vigilancia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Vigilancia $vigilancia */
        $vigilancia = Vigilancia::find($id);


        if (!$vigilancia->esTemporal()){
            $vigilancia = $this->addAttributos($vigilancia);
        }

        if (empty($vigilancia) {
            flash()->error('Vigilancia no encontrada');

            return redirect(route('vigilancias.index'));
        }

        return view('vigilancias.edit')->with('vigilancia', $vigilancia);
    }

    /**
     * Update the specified Vigilancia in storage.
     *
     * @param  int              $id
     * @param UpdateVigilanciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVigilanciaRequest $request)
    {


        /** @var Vigilancia $vigilancia */
        $vigilancia = Vigilancia::find($id);


        if (empty($vigilancia)) {
            flash()->error('Vigilancia no encontrada');

            return redirect(route('vigilancias.index'));
        }

        $estado = SolicitudEstado::INGRESADA;


        try {
            DB::beginTransaction();

            /**
             * @var  Paciente $paciente
             */
            $paciente = $this->creaOactualizaPaciente($request);


            $request->merge([
                'paciente_id' => $paciente->id,
                'estado_id' => $estado,
                'inicio' => $request->tratamiento=='inicio' ? 1 : 0,
                'continuacion' => $request->tratamiento=='continuacion' ? 1 : 0,
                'terapia_empirica' => $request->terapia=='terapia_empirica' ? 1 : 0,
                'terapia_especifica' => $request->terapia=='terapia_especifica' ? 1 : 0,
                'infeccion_extrahospitalaria' => $request->fuente_infeccion=='infeccion_extrahospitalaria' ? 1 : 0,
                'infeccion_intrahospitalaria' => $request->fuente_infeccion=='infeccion_intrahospitalaria' ? 1 : 0,
            ]);

            $vigilancia->fill($request->all());
            $vigilancia->save();

            $vigilancia->diagnosticos()->sync($request->diagnosticos ?? []);
            $vigilancia->cultivos()->sync($request->cultivos ?? []);



        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();



        flash()->success('Vigilancia actualizada con éxito.');

        return redirect(route('vigilancias.index'));
    }

    /**
     * Remove the specified Vigilancia from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Vigilancia $vigilancia */
        $vigilancia = Vigilancia::find($id);

        if (empty($vigilancia)) {
            flash()->error('Vigilancia no encontrada');

            return redirect(route('vigilancias.index'));
        }

        $vigilancia->delete();

        flash()->success('Vigilancia deleted successfully.');

        return redirect(route('vigilancias.index'));
    }

    public function creaOactualizaPaciente(UpdateVigilanciaRequest $request)
    {
        $paciente = Paciente::updateOrCreate([
            'run' => $request->run,
            'dv_run' => $request->dv_run,

        ],[
            'run' => $request->run,
            'fecha_nac' => $request->fecha_nac,
            'dv_run' => $request->dv_run,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,

            'sexo' => $request->sexo ? 'M' : 'F',

            'direccion' => $request->direccion,
            'familiar_responsable' => $request->familiar_responsable,
            'telefono' => $request->telefono,
            'telefono2' => $request->telefono2,
            'prevision_id' => $request->prevision_id,
            'clave' => $request->clave,
            'movil_envia' => $request->movil_envia,

        ]);



        return $paciente;
    }


    public function getVigilanciaTemporal()
    {
        $sol = Vigilancia::where('user_crea',auth()->user()->id)->where('estado_id',SolicitudEstado::TEMPORAL)->first();

        if ($sol){
            $sol->delete();
        }

        $sol = Vigilancia::create([
            'user_crea' => auth()->user()->id,
            'estado_id' => SolicitudEstado::TEMPORAL,
        ]);


        return $sol;
    }

    public function addAttributos(Vigilancia $vigilancia)
    {

        $vigilancia->setAttribute("run" ,$vigilancia->paciente->run);
        $vigilancia->setAttribute("dv_run" ,$vigilancia->paciente->dv_run);
        $vigilancia->setAttribute("apellido_paterno" ,$vigilancia->paciente->apellido_paterno);
        $vigilancia->setAttribute("apellido_materno" ,$vigilancia->paciente->apellido_materno);
        $vigilancia->setAttribute("primer_nombre" ,$vigilancia->paciente->primer_nombre);
        $vigilancia->setAttribute("segundo_nombre" ,$vigilancia->paciente->segundo_nombre);
        $vigilancia->setAttribute("fecha_nac" ,fechaEn($vigilancia->paciente->fecha_nac));
        $vigilancia->setAttribute("sexo" ,$vigilancia->paciente->sexo == 'M' ? 1 : 0);

        $vigilancia->setAttribute("direccion" ,$vigilancia->paciente->direccion);
        $vigilancia->setAttribute("familiar_responsable" ,$vigilancia->paciente->familiar_responsable);
        $vigilancia->setAttribute("telefono" ,$vigilancia->paciente->telefono);
        $vigilancia->setAttribute("telefono2" ,$vigilancia->paciente->telefono2);
        $vigilancia->setAttribute("prevision_id" ,$vigilancia->paciente->prevision_id);
        $vigilancia->setAttribute("clave" ,$vigilancia->paciente->clave);
        $vigilancia->setAttribute("movil_envia" ,$vigilancia->paciente->movil_envia);


        return $vigilancia;
    }

   
}
