@foreach ($stocks as $stock)
<tr>
    <td>{{ date('d-M-y', strtotime($stock->created_at)) }} </td>
    <td>{{ $stock->item->name }} </td>
    <td>{{ $stock->serial }} </td>
    <td>{{ $stock->supplier->name }} </td>
</tr>
@endforeach