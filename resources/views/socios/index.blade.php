@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Socios</h3>
        </div>
        <div class="row  d-block">
            <div class="float-sm-right">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="search" class="form-control" placeholder="Buscar"/>
                        <input type="hidden" value="Sucursales" id="option" name="option">
                    </div>
                    <button type="button" class="btn btn-primary ">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="section-body" style="margin-top: 100px">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('socios.create') }}" class="btn btn-warning">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff;">Numero de cliente</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Apellidos</th>
                                    <th style="color: #fff;">Telefono</th>
                                    <th style="color: #fff;"></th>
                                    <th colspan="2" style="color: #fff;">Acciones</th>
                                </thead>
                                <tbody id="tableSucursales">
                                    @forelse ($partners as $partner)
                                        <tr>
                                            <td style="display: none;">{{ $partner->id }}</td>
                                            <td>{{ $partner->num_socio }}</td>
                                            <td>{{ $partner->name }}</td>
                                            <td>{{ $partner->last_name }} {{ $partner->second_lastname }}</td>
                                            <td>{{ $partner->phone }}</td>
                                            <td>
                                                @if($partner->certification != null)
                                                    <span class="badge badge-success badge-pill">Constancia Medica</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">Constancia Medica</i></span>
                                                @endif
                                                @if($partner->sign != null)
                                                    <span class="badge badge-success badge-pill">Firma Digital</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">Firma Digital</i></span>
                                                @endif
                                                @if($partner->photo != null)
                                                    <span class="badge badge-success badge-pill">Foto Socio</i></span>
                                                @else
                                                    <span class="badge badge-danger badge-pill">Foto Socio</i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Espacio QR -->
                                                <a href="{{ route('socios.edit',$partner) }}" class="btn btn-info">Editar</a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['socios.destroy',$partner], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                     @empty
                                        <tr>
                                            <td colspan="8">Sin registros</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                            </table>
                            <div class="pagination" id="pag">
                                {{ $partners->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection