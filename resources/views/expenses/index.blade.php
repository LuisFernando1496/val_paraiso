@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Gastos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-gastos')
                                <a href="{{route('expenses.create')}}" class="btn btn-success">Nuevo</a>
                            @endcan

                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="color: #fff;">Nombre del gasto</th>
                                    <th style="color: #fff;">Descripcion</th>
                                    <th style="color: #fff;">Total</th>
                                    <th style="color: #fff;">Generado por: </th>
                                    <th style="color: #fff;">Sucursal</th>
                                    <th style="color: #fff; text-align: center">Fecha</th>
                                    <th colspan="2" style="color: #fff; text-align: center">Acciones </th>
                                </thead>
                                <tbody>
                                    @forelse ($expenses as $gasto)
                                    @php
                                        $title = $gasto->title;
                                    @endphp
                                    <tr>
                                        <td>{{ $gasto->title }}</td>
                                        <td>{{ $gasto->description }}</td>
                                        <td>${{number_format( $gasto->total,2) }}</td>
                                        <td>{{ $gasto->user->name }}</td>
                                        <td>{{ $gasto->office->name }}</td>
                                        <td>{{ $gasto->date }}</td>
                                        <td>
                                           
                                            @can('editar-gastos')
                                                <a href="{{route('expenses.edit',$gasto)}}" class="btn btn-warning">Editar</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('borrar-gastos')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['expenses.destroy', $gasto],'style' => 'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick'=>"return confirm('¿Seguro que desea elminar: $title?')" ]) !!}
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
                            <div class="pagination">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
