@extends('backend.master')
@section('title')
    Product History
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">



                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Stocks</h3>

                    <input type="text" class="float-end serial" placeholder="Serial">


                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Item </th>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Supplier</th>
                                </tr>
                            </thead>
                            <tbody class="history-body">

                               @include('backend.product-history.ajax-body')


                            </tbody>
                        </table>
                        {{ $stocks->links('pagination::bootstrap-5') }}
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
        $('.serial').on('blur', function() {
            let string = $(this).val();  
            $.ajax({
                type: "GET",
                url: "{{ url('admin/product-history-search') }}",
                data: {
                    string: string
                },
                success: function(res) { 
                     $('.history-body').empty();                    
                     $('.history-body').html(res);                    
                }

            })
        })
    </script>
@endpush
