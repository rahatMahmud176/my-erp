@extends('backend.master')
@section('title')
    Pos
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Point Of Sale</h3>
                    <div class="float-end">
                        <input class="my-field pos-search" placeholder="serial number" type="text">
                    </div>
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                @include('backend.pos.ajax-body')
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
        $('.cart-icon').on('click', function() {
            let id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url: "{{ url('admin/add-to-cart-ajax') }}",
                data: {
                    id: id
                },
                success: function(res) {
                    // console.log(res);
                    toastr.success(res);
                }
            })
        })
    </script>


     
    <script>
       $('.pos-search').on('blur', function(){
        let searchKey = $(this).val();
        $.ajax({
            type: "GET",
            url : "{{ url('admin/get-pos-search-result') }}",
            data: {searchKey:searchKey},
            success: function(res){ 
                $('.t-body').empty();
                $('.t-body').html(res);
            }
        })
        
       })
    </script>
@endpush
