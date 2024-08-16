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

                    <select class="float-end category" name="" id="">
                        <option value=""> Categories </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>

                 
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
                            <tbody class="stock-body">

                                @include('backend.stock.ajax-body')


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

    <script>
        $('.category').on('change', function(){
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url : "{{ url('admin/get-stock-by-category') }}",
                data: {id:id},
                success: function(res){ 
                    $('.stock-body').empty();
                    $('.stock-body').html(res); 
                }

            })
        })
    </script>
@endpush
