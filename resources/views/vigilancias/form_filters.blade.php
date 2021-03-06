
<form id="formFiltersDatatables">
<h2>Filtrar por fecha solicitud</h2>
    <div class="form-row">




        <div class="form-group col-sm-2">
            {!! Form::label('del', 'Desde:') !!}
            {!! Form::date('del', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('al', 'Hasta:') !!}
            {!! Form::date('al', null, ['class' => 'form-control']) !!}
        </div>

        <!-- @unlessrole('Médico')
            <div class="form-group col-sm-4">
                {!! Form::label('del', 'Medico:') !!}
                <multiselect v-model="user" :options="users" label="name" placeholder="Seleccione uno...">
                </multiselect>
                <input type="hidden" name="users" :value="user ? user.id : null">
            </div>
        @endunlessrole -->

      

        <div class="form-group col-sm-4">
            {!! Form::label('servicio', 'Servicio:') !!}
            <multiselect v-model="servicio" :options="servicios"  placeholder="Seleccione uno...">
            </multiselect>
            <input type="hidden" name="servicios" :value="servicio">
        </div>

        <div class="form-group col-sm-2">
            <label for="">&nbsp;</label>
            <div>
                <button type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-sync"></i> Aplicar Filtros
                </button>
            </div>
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('boton','&nbsp;') !!}
            <div>
                <a  href="{{route('vigilancias.index')}}" type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-times"></i> Limpiar Filtros
                </a>
            </div>
        </div>
    </div>
</form>

