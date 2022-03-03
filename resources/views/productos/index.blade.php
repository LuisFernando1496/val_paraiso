@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Productos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-productos')
                                <a href="{{ route('productos.create') }}" class="btn btn-warning">Nuevo</a>
                            @endcan
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff;">Codigo Barras</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">Marca</th>
                                    <th style="color: #fff;">Categoria</th>
                                    <th style="color: #fff;">Costos</th>
                                    <th style="color: #fff;">Proveedor</th>
                                    <th style="color: #fff;">Sucursal</th>
                                    <th style="color: #fff;">Editar</th>
                                    <th style="color: #fff;">Eliminar</th>
                                </thead>
                                <tbody>
                                    @forelse ($productos as $producto)
                                        <td style="display: none">{{ $producto->id }}</td>
                                        <td>{{ $producto->bar_code }}</td>
                                        <td>{{ $producto->name }}</td>
                                        <td>{{ $producto->mark }}</td>
                                        <td>{{ $producto->category->name }}</td>
                                        <td>
                                            @if (sizeof($producto->vendor[0]->costos) > 0)
                                                <a href="{{ route('costos.ver',$producto->id) }}" class="btn btn-secondary">Ver</a>
                                            @else
                                                <p>Sin costoso</p>
                                            @endif
                                            <a href="{{ route('costos.crear') }}" class="btn btn-warning">Agregar</a>
                                        </td>
                                        <td>{{ $producto->vendor[0]->vendor->name }}</td>
                                        <td>{{ $producto->vendor[0]->vendor->office->name }}</td>
                                        <td>
                                            @can('editar-productos')
                                                <a href="{{ route('productos.edit',$producto->id) }}" class="btn btn-info">Editar</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('borrar-productos')
                                                <a href="{{ route('productos.destroy',$producto->id) }}" class="btn btn-danger">Borrar</a>
                                            @endcan
                                        </td>
                                    @empty
                                        <tr>
                                            <td colspan="10">Sin registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination">
                                {!! $productos->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

