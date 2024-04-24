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
                                    <th scope="col">Variant</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Purchase P.</th>
                                    <th scope="col">Wholesale P.</th>
                                    <th scope="col">Sell P.</th> 
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($stocks as $key => $stock)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $stock->item->name }}</td>
                                        <td>
                                            {{ $stock->size->name.
                                                ', '.$stock->color->name.
                                                ', '.$stock->country->name
                                                 }}
                                        </td>
                                       <td> {{ $stock->qty }}
                                            @if($stock->item->unit->id!=1) {{ $stock->item->unit->name}}@endif
                                            @if($stock->item->subUnit->id!=1){{'/'.$stock->item->subUnit->name }}@endif
                                       </td>
                                       <td>{{ number_format($stock->purchase_price, 2) }}</td>
                                       <td>{{ number_format($stock->wholesale_price, 2) }}</td>
                                       <td>{{ number_format($stock->price, 2) }}</td> 
                                        <td>
                                            <a href="{{ route('admin.stocks.edit', $stock) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            @if ($stock->deletable == true)
                                                <a href="#" onclick="stockDelete({{ $stock->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteStockForm{{ $stock->id }}"
                                                    action="{{ route('admin.stocks.destroy', $stock) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif

                                        </td>
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
