<tbody id="tableGastos">
    @forelse ($expenses as $gasto)
    @php
        $title = $gasto->title;
    @endphp
    <tr>
        <td>{{ $gasto->title }}</td>
        <td>{{ $gasto->description }}</td>
        <td>${{number_format( $gasto->total,2) }}</td>
        <td>{{ $gasto->user }}</td>
        <td>{{ $gasto->office }}</td>
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
{{ $expenses->appends(['search'=>$search,'option'=>$option]) }}
</table>