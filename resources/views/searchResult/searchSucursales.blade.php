<tbody id="tableSucursales">
    @forelse ($oficinas as $sucursale)
        <tr>
            <td style="display: none;">{{ $sucursale->id}}</td>
            <td>{{ $sucursale->name }}</td>
            <td>{{ $sucursale->phone }}</td>
            <td>{{ $sucursale->responsable }}</td>
            <td>{{ $sucursale->address->street }} {{ $sucursale->address->number }} {{ $sucursale->address->suburb }}, {{ $sucursale->address->postal_code }}, {{ $sucursale->address->city }}, {{ $sucursale->address->state }}, {{ $sucursale->address->country }}</td>
            <td>{{ $sucursale->business->name }}</td>
            <td>
                <a href="{{ route('sucursales.edit',$sucursale) }}" class="btn btn-info">Editar</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['sucursales.destroy',$sucursale], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">Sin registros</td>
        </tr>
    @endforelse 
    {{ $oficinas->appends(['search'=>$search,'option'=>$option]) }}
</tbody>
   
