


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
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="iarepi" value="0">
                                    <input class="custom-control-input" type="radio" id="iarepi" name="iarepi" value="iarepi"
                                        {{($vigilancia->iarepi ?? 0) ? 'checked' : ''}}>
                                    <label for="iarepi" class="custom-control-label">IAREPI</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="hidden" name="paa" value="0">
                                    <input class="custom-control-input" type="radio" id="paa" name="paa" value="paa"
                                        {{($vigilancia->paa ?? 0) ? 'checked' : ''}}>
                                    <label for="paa" class="custom-control-label">PAA</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>


                <!-- Comentarios Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('comentarios', 'Comentarios:') !!}
                    <p>{{$vigilancia->comentarios}}</p>
                </div>


            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

