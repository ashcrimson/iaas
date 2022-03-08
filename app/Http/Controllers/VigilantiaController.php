<?php

namespace App\Http\Controllers;

use App\DataTables\VigilantiaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVigilantiaRequest;
use App\Http\Requests\UpdateVigilantiaRequest;
use App\Models\Vigilantia;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VigilantiaController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Vigilantias')->only(['show']);
        $this->middleware('permission:Crear Vigilantias')->only(['create','store']);
        $this->middleware('permission:Editar Vigilantias')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Vigilantias')->only(['destroy']);
    }

    /**
     * Display a listing of the Vigilantia.
     *
     * @param VigilantiaDataTable $vigilantiaDataTable
     * @return Response
     */
    public function index(VigilantiaDataTable $vigilantiaDataTable)
    {
        return $vigilantiaDataTable->render('vigilantias.index');
    }

    /**
     * Show the form for creating a new Vigilantia.
     *
     * @return Response
     */
    public function create()
    {
        return view('vigilantias.create');
    }

    /**
     * Store a newly created Vigilantia in storage.
     *
     * @param CreateVigilantiaRequest $request
     *
     * @return Response
     */
    public function store(CreateVigilantiaRequest $request)
    {
        $input = $request->all();

        /** @var Vigilantia $vigilantia */
        $vigilantia = Vigilantia::create($input);

        Flash::success('Vigilantia guardado exitosamente.');

        return redirect(route('vigilantias.index'));
    }

    /**
     * Display the specified Vigilantia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vigilantia $vigilantia */
        $vigilantia = Vigilantia::find($id);

        if (empty($vigilantia)) {
            Flash::error('Vigilantia no encontrado');

            return redirect(route('vigilantias.index'));
        }

        return view('vigilantias.show')->with('vigilantia', $vigilantia);
    }

    /**
     * Show the form for editing the specified Vigilantia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Vigilantia $vigilantia */
        $vigilantia = Vigilantia::find($id);

        if (empty($vigilantia)) {
            Flash::error('Vigilantia no encontrado');

            return redirect(route('vigilantias.index'));
        }

        return view('vigilantias.edit')->with('vigilantia', $vigilantia);
    }

    /**
     * Update the specified Vigilantia in storage.
     *
     * @param  int              $id
     * @param UpdateVigilantiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVigilantiaRequest $request)
    {
        /** @var Vigilantia $vigilantia */
        $vigilantia = Vigilantia::find($id);

        if (empty($vigilantia)) {
            Flash::error('Vigilantia no encontrado');

            return redirect(route('vigilantias.index'));
        }

        $vigilantia->fill($request->all());
        $vigilantia->save();

        Flash::success('Vigilantia actualizado con éxito.');

        return redirect(route('vigilantias.index'));
    }

    /**
     * Remove the specified Vigilantia from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Vigilantia $vigilantia */
        $vigilantia = Vigilantia::find($id);

        if (empty($vigilantia)) {
            Flash::error('Vigilantia no encontrado');

            return redirect(route('vigilantias.index'));
        }

        $vigilantia->delete();

        Flash::success('Vigilantia deleted successfully.');

        return redirect(route('vigilantias.index'));
    }
}
