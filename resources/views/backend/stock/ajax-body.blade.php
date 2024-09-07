@php
    $totalUnitQty = 0;
    $unitName = '';
    $i = 1;
@endphp
@foreach ($items as $key => $item)
    @if ($item->stocks->sum('unit_qty') != 0)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $item->name}} <small class="text-black-50">{{ '(ID:'.$item->id.')' }}</small></td>

            <td>
                {{ $item->stocks->sum('unit_qty') }}
                <input type="hidden" name=""
                    value="{{ $totalUnitQty = $totalUnitQty + $item->stocks->sum('unit_qty') }}">
                @if ($item->unit_id != 1)
                    {{ $unitName = $item->unit->name }}
                @endif
                @if ($item->sub_unit_id != 1)
                    {{ ' / ' . $item->stocks->sum('sub_unit_qty') . ' ' . $item->subUnit->name }}
                @endif
            </td>


            <td>
                <a href="{{ route('admin.stock.details', ['id' => $item->id]) }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-pencil-eye"></i>
                    view
                </a>
            </td>
        </tr>
    @endif
@endforeach
<tr>
    <td></td>
    <th> Total =</th>
    <td> {{ $totalUnitQty . ' ' . $unitName }} </td>
    <td></td>
</tr>
 