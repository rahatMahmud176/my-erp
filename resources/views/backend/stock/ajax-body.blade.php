@foreach ($items as $key => $item)
    @if ($item->stocks->sum('unit_qty') != 0)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ $item->name }}</td>

            <td>
                {{ $item->stocks->sum('unit_qty') }}
                @if ($item->unit_id != 1)
                    {{ $item->unit->name }}
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
