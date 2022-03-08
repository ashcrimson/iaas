@extends('layouts.app')

@section('title_page',__('Edit Vigilencia'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1>{{ $vigilancia->esTemporal() ? "Nueva" : "Editar"  }} Vigilancia</h1>
                </div>
                <div class="col">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('vigilancias.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">{{__('List')}}</span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">


            @include('layouts.partials.request_errors')

            <div class="card">
                <div class="card-body">

                   {!! Form::model($vigilancia, ['route' => ['vigilancias.update', $vigilancia->id], 'method' => 'patch','id' => 'form-solicitud']) !!}
                        <div class="form-row">


                            @include('vigilancias.fields')


                        </div>

                        <div class="form-row" id="botonesGuardarVigilancia">

                           
                            <!-- Submit Field -->
                            <div class="form-group col-sm-4 text-right ">

                                <a href="{!! route('vigilancias.index') !!}" class="btn btn-outline-secondary mr-3">
                                    Cancelar
                                </a>
                                &nbsp;
                              
                                    <button type="submit" class="btn btn-outline-success mr-3"
                                            >
                                        <i class="fa fa-save"></i> Guardar
                                    </button>
                              

                            </div>

                        </div>

                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>

    let vmBotonesGuardarVigilancia = new Vue({
        el: '#botonesGuardarVigilancia',
        name: 'botonesGuardarVigilancia',
        mounted() {
            console.log('Instancia vue montada');
        },
        created() {
            console.log('Instancia vue creada');
        },
        data: {
            desabilitar_botones_guardar: false
        },
        methods: {
            getDatos(){
                console.log('Metodo Get Datos');
            }
        }
    });

    $(function () {
        $("#password").keypress(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $("#btnEnviar").focus().click();
                return;
            }
        });


    })
</script>
@endpush



