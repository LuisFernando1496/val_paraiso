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
                                    @forelse ($negocios as $business)
                                        <tr>
                                            <td style="display: none">{{$business->id}}</td>
                                            <td>{{ $business->name }}</td>
                                            <td>{{ $business->rfc }}</td>
                                            <td>{{ $business->legal_representative }}</td>
                                            <td>{{ $business->number }}</td>
                                            <td>
                                                <a href="{{ route('negocios.edit',$business) }}" class="btn btn-info">Editar</a>
                                            </td>
                                            <td>
                                                {!!Form::open(['method' => 'DELETE', 'route' => ['negocios.destroy',$business], 'style' => 'display:inline']) !!}
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

