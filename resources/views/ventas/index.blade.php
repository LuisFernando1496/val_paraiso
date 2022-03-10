@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ventas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-2">
                                <thead style="background-color: #6777ef;">
                                    <th style="display: none;">ID</th>
                                    <th style="color: #fff;">Folio</th>
                                    <th style="color: #fff;">Metodo Pago</th>
                                    <th style="color: #fff;">Total</th>
                                    <th style="color: #fff;">Vendio</th>
                                    <th style="color: #fff;">Fecha</th>
                                    <th style="color: #fff;">Detalles</th>
                                    <th style="color: #fff;">Ticket</th>
                                    <th style="color: #fff;">Cancelar</th>
                                </thead>
                                <tbody>
                                    @forelse ($ventas as $venta)
                                        <tr>
                                            <td style="display: none;">{{ $venta->id }}</td>
                                            <td>{{ $venta->folio }}</td>
                                            <td>{{ $venta->method }}</td>
                                            <td>${{ $venta->total }}</td>
                                            <td>{{ $venta->usercash->user->name }} {{ $venta->usercash->user->last_name }} {{ $venta->usercash->user->second_last_name }}</td>
                                            <td>{{ $venta->date }}</td>
                                            <td>
                                                @can('ver-ventas')
                                                    <a href="{{ route('ventas.show',$venta->id) }}" class="btn btn-info">Detalles</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('ver-ventas')
                                                    <a href="{{ route('ventas.ticket',$venta->id) }}" target="blank" class="btn btn-primary">Ticket</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('borrar-ventas')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['ventas.destroy',$venta->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Canelar', ['class' => 'btn btn-danger']) !!}
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
                                {!! $ventas->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

