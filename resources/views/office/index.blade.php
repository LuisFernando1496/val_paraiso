@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Sucursales</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('sucursales.create') }}" class="btn btn-warning">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Telefono</th>
                                    <th style="color: #fff;">Responsable</th>
                                    <th style="color: #fff;">Direccion</th>
                                    <th style="color: #fff;">Negocio</th>
                                    <th style="color: #fff;">Editar</th>
                                    <th style="color: #fff;">Eliminar</th>
                                </thead>
                                <tbody>
                                    @forelse ($oficinas as $sucursale)
                                        <tr>
                                            <td style="display: none;">{{ $sucursale->id}}</td>
                                            <td>{{ $sucursale->name }}</td>
                                            <td>{{ $sucursale->number }}</td>
                                            <td>{{ $sucursale->responsable }}</td>
                                            <td>{{ $sucursale->address->street }} {{ $sucursale->address->number }} {{ $sucursale->address->suburb }}, {{ $sucursale->address->postal_code }}, {{ $sucursale->address->city }}, {{ $sucursale->address->state }}, {{ $sucursale->address->country }}</td>
                                            <td>{{ $sucursale->business->name }}</td>
                                            <td>
                                                <a href="{{ route('sucursales.edit',$sucursale) }}" class="btn btn-primary">Editar</a>
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['sucursales.destroy',$sucursale], 'style' => 'display:inline']) !!}
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
                            <div class="pagination">
                                {!! $oficinas->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
