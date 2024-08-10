@foreach ($supplier_transitions as $key => $transition)
    <tr>
        <td>{{ date('d-M-y', strtotime($transition->created_at)) }}</td>
        <td class="text-center"><a href="#">#Challan:{{ $transition->challan_id }}</a></td>
        <td class="text-center"><a href="#">{{ $transition->supplier->name }}</a></td>
        <td class="text-success text-center">{{ number_format($transition->deposit, 2) }}</td>
        <td class="text-success text-center">{{ number_format($transition->due, 2) }}</td>
    </tr>
@endforeach
