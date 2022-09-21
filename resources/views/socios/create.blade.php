@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de socios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>Revisa los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            @endif

                            {!! Form::open(array('route' => 'clientes.store', 'method' => 'POST','enctype'=>'multipart/formdata')) !!}
                                <div class="row">
                                   
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="last_name">Primer apellido</label>
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="second_lastname">Segundo apellido</label>
                                            {!! Form::text('name', null, array('class' => 'form-control','placeholder'=>'Opcional')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            {!! Form::text('email', null, array('class' => 'form-control','placeholder'=>'Opcional')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="age">Años</label>
                                            {!! Form::number('age', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="phone">Telefono</label>
                                            {!! Form::number('phone', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="phone_emergency">Telefono de emergencia</label>
                                            {!! Form::number('phone_emergency', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="certificate">Subir constancia medica</label>
                                            {!! Form::file('certificate', null, array('class' => 'form-control','require')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-warning form-control" type="submit">Agregar Firma</button>
                                        </div>
                                    </div>
                                 
                                   
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button class="btn btn-primary form-control" type="submit">Guardar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

