@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Proveedores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-proveedor')
                                <a href="{{ route('proveedores.create') }}" class="btn btn-warning">Nuevo</a>
                            @endcan
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none">ID</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Telefono</th>
                                    <th style="color: #fff;">Correo</th>
                                    <th style="color: #fff;">Direccion</th>
                                    <th style="color: #fff;">Sucursal</th>
                                    <th style="color: #fff;">Editar</th>
                                    <th style="color: #fff;">Eliminar</th>
                                </thead>
                                <tbody>
                                    @forelse ($vendors as $vendor)
                                        <tr>
                                            <td style="display: none;">{{ $vendor->id }}</td>
                                            <td>{{ $vendor->name }}</td>
                                            <td>{{ $vendor->phone }}</td>
                                            <td>{{ $vendor->email }}</td>
                                            <td>{{ $vendor->address->street }} {{ $vendor->address->number }} {{ $vendor->address->suburb }}, {{ $vendor->address->postal_code }}, {{ $vendor->address->city }}, {{ $vendor->address->state }}, {{ $vendor->address->country }}</td>
                                            <td>{{ $vendor->office->name }}</td>
                                            <td>
                                                @can('editar-proveedor')
                                                    <a href="{{ route('proveedores.edit',$vendor->id) }}" class="btn btn-info">Editar</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('borrar-proveedor')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['proveedores.destroy',$vendor->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Sin registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

