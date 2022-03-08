<?php

namespace App\DataTables;

use App\Models\Vigilancia;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VigilanciaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

       return $dataTable->addColumn('action', function(Vigilancia $vigilancia){

                 $id = $vigilancia->id;

                 return view('vigilancias.datatables_actions',compact('vigilancia','id'))->render();
             })
             ->editColumn('paciente.rut_completo',function (Vigilancia $vigilancia){

                 return $vigilancia->paciente->rut_completo ?? '';

             })
          
           ->editColumn('pesquisa',function (Vigilancia $vigilancia){
               return $vigilancia->pesquisa  ?? '';
           })

           ->editColumn('dip',function (Vigilancia $vigilancia){
               return $vigilancia->dip  ?? '';
           })

           ->editColumn('procedimientos_cirugias',function (Vigilancia $vigilancia){
               return $vigilancia->procedimientos_cirugias  ?? '';
           })

           ->editColumn('iarepi',function (Vigilancia $vigilancia){
               return $vigilancia->iarepi  ?? '';
           })

           ->editColumn('paa',function (Vigilancia $vigilancia){
               return $vigilancia->paa  ?? '';
           });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vigilancia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Solicitud $model)
    {
        return $model->newQuery()
            ->with(['paciente'])
            ->select('vigilancias.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->ajax([
                'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
            ])
            ->parameters([
                'dom'     => '
                                    <"row mb-2"
                                        <"col-sm-12 col-md-6" B>
                                        <"col-sm-12 col-md-6" f>
                                    >
                                    rt
                                    <"row"
                                        <"col-sm-6 order-2 order-sm-1" ip>
                                        <"col-sm-6 order-1 order-sm-2 text-right" l>

                                    >',
                'order'   => [[0, 'desc']],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                'scrollX' => true,
                'responsive' => true,
                'stateSave' => true,
                'buttons' => [
                    //['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Crear</span>'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'],
                    //['extend' => 'reload', 'text' => '<i class="fa fa-sync-alt"></i> <span class="d-none d-sm-inline">Recargar</span>'],
                    ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'],
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>'],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            

            Column::make('paciente.apellido_paterno')
                ->visible(false)->exportable(false),
            Column::make('paciente.apellido_materno')
                ->visible(false)->exportable(false),
            Column::make('paciente.primer_nombre')
                ->visible(false)->exportable(false),
            Column::make('paciente.segundo_nombre')
                ->visible(false)->exportable(false),

            Column::make('paciente')->name('paciente.nombre_completo')->data('paciente.nombre_completo')
                ->searchable(false)->orderable(false),


            Column::make('servicio')->name('descserv')->data('descserv'),

            Column::make('run')->name('paciente.rut_completo')->data('paciente.rut_completo')
                ->searchable(false)->orderable(false),


            Column::make('rut')->name('paciente.run')->data('paciente.run')
                ->visible(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'vigilanciasdatatable_' . time();
    }
}
