@extends('layouts.app')

@section('content')
<style>
    .tableFixHead {
        overflow-y: auto;
        height: 150px;
    }
    .tableFixHead thead th {
        position: sticky;
        top: 0;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
</style>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Vender</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="search">Busqueda Producto</label>
                                                    {!! Form::text('search', null, array('class' => 'form-control','id' => 'search','placeholder' => 'Busqueda de producto')) !!}
                                                </div>
                                            </div>
                                            <div class="tableFixHead">
                                                <table class="table table.striped mt-2">
                                                    <thead style="background-color: #6777ef;">
                                                        <th style="color: #fff;">Codigo</th>
                                                        <th style="color: #fff;">Producto</th>
                                                        <th style="color: #fff;">Stock</th>
                                                        <th style="color: #fff;">Precio</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($productos as $producto)
                                                            <tr>
                                                                <td>{{ $producto->bar_code }}</td>
                                                                <td>{{ $producto->name }}</td>
                                                                <td>{{ $producto->vendor[0]->stock }}</td>
                                                                <td>
                                                                    <select name="" id="costo{{ $producto->id }}" class="form-control">
                                                                        <option value="">Seleccionar</option>
                                                                        @forelse ($producto->vendor[0]->costos as $costo)
                                                                            <option value="{{ $costo->id }}">{{ $costo->name }} - ${{ $costo->price }}</option>
                                                                        @empty
                                                                            <option value="">Sin costos</option>
                                                                        @endforelse
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4">Sin registros</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="search-service">Busqueda Servicio</label>
                                                    {!! Form::text('search-service', null, array('class' => 'form-control','id' => 'search-service','placeholder' => 'Busqueda de producto')) !!}
                                                </div>
                                            </div>
                                            <div class="tableFixHead">
                                                <table class="table table.striped mt-2">
                                                    <thead style="background-color: #6777ef;">
                                                        <th style="color: #fff;">Codigo</th>
                                                        <th style="color: #fff;">Servicio</th>
                                                        <th style="color: #fff;">Precio</th>
                                                        <th style="color: #fff;">Agregar</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($servicios as $servicio)
                                                            <tr>
                                                                <td>{{ $servicio->bar_code }}</td>
                                                                <td>{{ $servicio->name }}</td>
                                                                <td>${{ number_format($servicio->price,2,'.',',') }}</td>
                                                                <td>
                                                                    <button class="btn btn-success" data-id="{{ $servicio->id }}">Agregar</button>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="4">Sin registros</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="refresh">
                                                <table class="table table-hover mt-2">
                                                    <thead style="background-color: #6777ef">
                                                        <th style="color: #fff">Producto</th>
                                                        <th style="color: #fff">Precio</th>
                                                        <th style="color: #fff">Marca</th>
                                                        <th style="color: #fff">Cantidad</th>
                                                        <th style="color: #fff">Descuento</th>
                                                        <th style="color: #fff">Total</th>
                                                        <th style="color: #fff">Eliminar</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($carrito as $item)
                                                            <tr>
                                                                <td>{{ $item->costprice->vendorproduct->product->name }}</td>
                                                                <td>${{ $item->costprice->price }}</td>
                                                                <td>{{ $item->costprice->vendorproduct->product->mark }}</td>
                                                                <td>
                                                                    {!! Form::number('quantity', $item->quantity, array('class' => 'form-control')) !!}
                                                                </td>
                                                                <td>
                                                                    {!! Form::number('percent', $item->percent, array('class' => 'form-control')) !!}
                                                                </td>
                                                                <td>

                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger">Quitar</button>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7">Sin registros</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Tipo</label>
                                            <select name="" id="" class="form-control">
                                                <option value="Venta">Venta</option>
                                                <option value="Cotizacion">Cotizacion</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Subtotal</label>
                                            {!! Form::number('subtotal', null, array('class' => 'form-control','step' => 'any','readonly' => 'true')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Descuento</label>
                                            {!! Form::number('percent', null, array('class' => 'form-control','step' => 'any')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Descuento</label>
                                            {!! Form::number('discount', null, array('class' => 'form-control','step' => 'any','readonly' => 'true')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Total</label>
                                            {!! Form::number('total', null, array('class' => 'form-control','step' => 'any','readonly' => 'true')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Modo</label>
                                            <select name="" id="" class="form-control">
                                                <option value="Credito">Credito</option>
                                                <option value="Una Exhibicion">Una Exhibicion</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Metodo</label>
                                            <select name="" id="" class="form-control">
                                                <option value="Tarjeta">Tarjeta</option>
                                                <option value="Efectivo">Efectivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Cliente</label>
                                            {!! Form::select('client_id', $clientes, [], array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

