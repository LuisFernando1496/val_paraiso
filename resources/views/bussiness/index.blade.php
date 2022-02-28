@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Negocios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('negocios.create') }}" class="btn btn-warning">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff;">Nombre</th>
                                    <th style="color: #fff;">RFC</th>
                                    <th style="color: #fff;">Representate</th>
                                    <th style="color: #fff;">Telefono</th>
                                    <th style="color: #fff;">Editar</th>
                                    <th style="color: #fff;">Eliminar</th>
                                </thead>
                                <tbody>
                                    @forelse ($negocios as $negocio)
                                        <tr>
                                          for  <td style="display: none">{{$negocio->id}}</td>
                                            <td>{{ $negocio->name }}</td>
                                            <td>{{ $negocio->rfc }}</td>
                                            <td>{{ $negocio->legal_representative }}</td>
                                            <td>{{ $negocio->number }}</td>
                                            <td>
                                                <a href="{{ route('negocios.edit',$negocio) }}" class="btn btn-info">Editar</a>
                                            </td>
                                            <td>
                                                {!!Form::open(['method' => 'DELETE', 'route' => ['negocios.destroy',$negocio], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Borrar',['class' => 'btn btn-danger']) !!}
                                                {!!Form::close() !!}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Sin registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $negocios->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

