


<div class="col-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Datos Paciente</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-row">
                @include('pacientes.fields')
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>



<div class="col-sm-12 mb-3">
    <div class="card card-outline card-info ">
        <div class="card-header">
            <h3 class="card-title">Factores de Riesgo</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-row">

                <!-- Treatamiento -->
                <div class="form-group col-4">
                    <div class="card ">
                        <div class="card-header py-0 px-1">
                            <h3 class="card-title">Factores de Riesgo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <!-- radio -->
                            <div class="form-group mb-0">
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="pesquisa" value="0">
                                  <input class="custom-control-input" type="radio" id="pesquisa" name="pesquisa" value="inicio" required
                                      {{($vigilancia->pesquisa ?? 0) ? 'checked' : ''}}>
                                  <label for="pesquisa" class="custom-control-label">Pesquisa</label>
                                </div>
                                
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="form-group col-4">
                    <div class="card ">
                        <div class="card-header py-0 px-1">
                            <h3 class="card-title">Dip Hospitalización</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="dip" value="0">
                                    <input class="custom-control-input" type="radio" id="dip" name="dip" value="dip" required 
                                        {{($vigilancia->dip ?? 0) ? 'checked' : ''}}>
                                    <label for="dip" class="custom-control-label">DIP (Hospitalizados)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="procedimientos_cirugias" value="0">
                                    <input class="custom-control-input" type="radio" id="procedimientos_cirugias" name="procedimientos_cirugias" value="procedimientos_cirugias"
                                        {{($vigilancia->procedimientos_cirugias ?? 0) ? 'checked' : ''}}>
                                    <label for="procedimientos_cirugias" class="custom-control-label">Procedimientos y Cirugías</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="form-group col-4">
                    <div class="card ">
                        <div class="card-header py-0 px-1">
                            <h3 class="card-title">Fuente de infección</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">

                            <div class="form-group mb-0">
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="infeccion_extrahospitalaria" value="0">
                                    <input class="custom-control-input" type="radio" id="infeccion_extrahospitalaria" name="fuente_infeccion" value="infeccion_extrahospitalaria" required 
                                        {{($solicitud->infeccion_extrahospitalaria ?? 0) ? 'checked' : ''}}>
                                    <label for="infeccion_extrahospitalaria" class="custom-control-label">Infección Extrahospitalaria</label>

                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="infeccion_intrahospitalaria" value="0">
                                    <input class="custom-control-input" type="radio" id="infeccion_intrahospitalaria" name="fuente_infeccion" value="infeccion_intrahospitalaria"
                                        {{($solicitud->infeccion_intrahospitalaria ?? 0) ? 'checked' : ''}}>
                                    <label for="infeccion_intrahospitalaria" class="custom-control-label">Infeccion Intrahospitalaria</label>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>


                   
                </div>

               

                <div class="form-group col-12">
                    @include('solicitudes.panel_disfuncion')
                </div>

                <!-- Observaciones Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('observaciones', 'Observaciones:') !!}
                    {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows' => 3]) !!}
                </div>


            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

