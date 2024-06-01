@extends('backend.master')
@section('title')
    Stocks
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body"> 

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#{{ $stocks[0]->item->name }}</h3>
                    <a href="{{ route('admin.stocks.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Stock</a>
                </div>

                <div class="row"> 
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Variant </th> 
                                    <th scope="col">Qty</th>   
                                    <th scope="col">Sub Qty</th>   
                                </tr>
                            </thead>
                            <tbody>
                              


  @php

  $i = 1;
    // Group and sum the stocks
    $groupedStocks = $stocks->groupBy(function($stocks) {
        return $stocks->color_id.'-'.$stocks->size_id.'-'.$stocks->country_id;
    })->map(function($group) {
        return [
            'name' => $group->first()->color->name.'-'.$group->first()->size->name.'-'.$group->first()->country->name,
            'unit_qty' => $group->sum('unit_qty'),
            'sub_unit_qty' => $group->sum('sub_unit_qty'),
            'unit_name' => $group->first()->item->unit->name,
            'sub_unit_name' => $group->first()->item->subUnit->name,
        ];
    });
@endphp

@foreach ($groupedStocks as $key => $group)
    <tr>
        <td scope="col">{{ $i++ }}</td>
        <td scope="col">{{ $group['name'] }}</td>
        <td scope="col">{{ $group['unit_qty'] . ' ' . $group['unit_name'] }}</td>
        <td scope="col">{{ $group['sub_unit_qty'] . ' ' . $group['sub_unit_name'] }}</td>
    </tr>
@endforeach


                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        function stockDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonStock: "#3085d6",
                cancelButtonStock: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteStockForm' + id).submit();
                }
            });
        }
    </script>
@endpush
