
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
                                <div class="col" id="divpro">
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
                                                        <th style="color: #fff;">Agregar</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($inventarios as $inventario)
                                                            <tr>
                                                                <td>{{ $inventario->bar_code }}</td>
                                                                <td>{{ $inventario->name }}</td>
                                                                <td>{{ $inventario->stock }}</td>
                                                                <td>${{ $inventario->price }}</td>
                                                                <td>
                                                                    <button class="btn btn-success add" type="button" data-id="{{ $inventario->id }}">Agregar</button>
                                                                </td>
                                                            </tr>
                                                        @empty

                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="refresh" id="refresh">
                                                @php
                                                    $gtotal = 0;
                                                @endphp
                                                <table class="table table-hover mt-2" id="tablarefresh">
                                                    <thead style="background-color: #6777ef">
                                                        <th style="color: #fff">Producto</th>
                                                        <th style="color: #fff">Precio</th>
                                                        <th style="color: #fff">Marca</th>
                                                        <th style="color: #fff">Cantidad</th>
                                                        <th style="color: #fff">Descuento %</th>
                                                        <th style="color: #fff">Total</th>
                                                        <th style="color: #fff">Eliminar</th>
                                                    </thead>
                                                    <tbody id="cuerpo">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Tipo</label>
                                                <select name="" id="tipo-venta" class="form-control" onchange="tipoventa()">
                                                    <option value="Venta">Vender</option>
                                                    <option value="Cotizacion">Comprar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3" id="new-cliente">
                                            <div class="form-group">
                                                <label for="">Sucursal</label>
                                                <select name="office_id" id="office_id" class="form-control" required>
                                                    @forelse ($oficinas as $oficina)
                                                        <option value="{{ $oficina->id }}">{{ $oficina->name }}</option>
                                                    @empty
                                                        <option value="">Sin sucursales</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3" id="div-metodo-pay">
                                            <div class="form-group">
                                                <label for="">Metodo Pago</label>
                                                <select name="" id="metodo-pay" class="form-control">
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Tarjeta">Tarjeta</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="divtotales">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Subtotal</label>
                                                    {!! Form::number('subtotal', $gtotal, array('class' => 'form-control','step' => 'any','readonly' => 'true','id' => 'subtotal')) !!}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Descuento %</label>
                                                    {!! Form::number('percent', 0, array('class' => 'form-control','step' => 'any','id'=>'discount')) !!}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Descuento</label>
                                                    {!! Form::number('discount', 0, array('class' => 'form-control','step' => 'any','readonly' => 'true','id' => 'descuentoprecio')) !!}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Total</label>
                                                    {!! Form::number('total', $gtotal, array('class' => 'form-control','step' => 'any','readonly' => 'true','id' => 'total')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3" id="div-pago">
                                            <div class="form-group">
                                                <label for="">Pago con:</label>
                                                {!! Form::number('pay', null, array('class' => 'form-control','step' => 'any','id' => 'pagocon')) !!}
                                            </div>
                                        </div>
                                        <div class="col-3" id="div-cambio">
                                            <div class="form-group">
                                                <label for="">Cambio</label>
                                                {!! Form::number('cambio', null, array('class' => 'form-control','step' => 'any','id'=>'cambio','readonly' => true)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" id="divpay">
                                    <button class="btn btn-primary" type="submit" id="sell">Vender</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" id="divcot">
                                    <button class="btn btn-primary" type="submit" id="buy">Comprar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.add').on('click',function(){
            const id = $(this).data('id');
            $.post('ventaalmacen')
        });
    </script>
@endsection

