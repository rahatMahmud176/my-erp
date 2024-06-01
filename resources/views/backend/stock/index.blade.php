@extends('backend.master')
@section('title')
    Stocks
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                 

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Stocks</h3>
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
                                    <th scope="col">Item </th> 
                                    <th scope="col">Qty</th>  
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $key => $item)
                                   
                                    @if ($item->stocks->sum('unit_qty') !=0)      
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->name }}</td>
                                       
                                       <td>
                                         {{ $item->stocks->sum('unit_qty') }}
                                            @if($item->unit_id!=1) {{ $item->unit->name}}@endif
                                            @if($item->sub_unit_id!=1){{' / '.$item->stocks->sum('sub_unit_qty').' '.$item->subUnit->name }}@endif
                                       </td>
 
                                      
                                        <td>
                                            <a href="{{ route('admin.stock.details',['id'=>$item->id]) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-eye"></i>
                                                view
                                            </a>  
                                        </td>
                                    </tr>
                                    @endif    
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
