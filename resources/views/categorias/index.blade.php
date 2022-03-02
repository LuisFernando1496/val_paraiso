@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Categorias</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-categoria')
                                <a href="{{ route('categorias.create') }}" class="btn btn-warning">Nuevo</a>
                                <table class="table table-striped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">ID</th>
                                        <th style="color: #fff;">Nombre</th>
                                        <th style="color: #fff;">Descripcion</th>
                                        <th style="color: #fff;">Sucursal</th>
                                        <th style="color: #fff;">Editar</th>
                                        <th style="color: #fff;">Eliminar</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($categorias as $categoria)
                                            <tr>
                                                <td style="display: none;">{{ $categoria->id }}</td>
                                                <td>{{ $categoria->name }}</td>
                                                <td>{{ $categoria->description }}</td>
                                                <td>
                                                    @can('editar-categoria')
                                                        <a href="{{ route('categorias.edit',$categoria->id) }}" class="btn btn-info">Editar</a>
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('borrar-categoria')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['categorias.destroy',$categoria->id], 'style' => 'display:inline']) !!}
                                                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Sin registros</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {!! $categorias->links() !!}
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

