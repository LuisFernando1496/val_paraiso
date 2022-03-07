<tbody id="cuerpo">
    @forelse ($carrito as $item)
        @if ($item->service_id != null)
            @php
                $total = $item->service->price * $item->quantity;
                $gtotal += $total;
            @endphp
            <tr>
                <td>{{ $item->service->name }}</td>
                <td>
                    ${{ $item->service->price }}
                    <input type="number" name="" id="precio{{$item->id}}" hidden value="{{$item->service->price}}">
                </td>
                <td>Servicio</td>
                <td>
                    {!! Form::number('quantity', $item->quantity, array('class' => 'form-control quantity','id' => 'quantity'.$item->id,'data-id' => $item->id)) !!}
                </td>
                <td>
                    {!! Form::number('percent', $item->percent, array('class' => 'form-control percent','id' => 'percent'.$item->id,'data-id' => $item->id)) !!}
                </td>
                <td>
                    {!! Form::number('total', $total, array('class' => 'form-control','id' => 'total'.$item->id)) !!}
                </td>
                <td>
                    <button class="btn btn-danger">Quitar</button>
                </td>
            </tr>
        @else
            @php
                $total = $item->costprice->price * $item->quantity;
                $gtotal += $total;
            @endphp
            <tr>
                <td>{{ $item->costprice->vendorproduct->product->name }}</td>
                <td>
                    ${{ $item->costprice->price }}
                    <input type="number" name="" id="precio{{$item->id}}" hidden value="{{$item->costprice->price}}">
                </td>
                <td>{{ $item->costprice->vendorproduct->product->mark }}</td>
                <td>
                    {!! Form::number('quantity', $item->quantity, array('class' => 'form-control quantity','id' => 'quantity'.$item->id,'data-id' => $item->id)) !!}
                </td>
                <td>
                    {!! Form::number('percent', $item->percent, array('class' => 'form-control percent','id' => 'percent'.$item->id,'data-id' => $item->id)) !!}
                </td>
                <td>
                    {!! Form::number('total', $total, array('class' => 'form-control','id' => 'total'.$item->id)) !!}
                </td>
                <td>
                    <button class="btn btn-danger">Quitar</button>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="7">Sin registros</td>
        </tr>
    @endforelse
</tbody>
