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
                        <input class="my-field" type="text">
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
                                @foreach ($stocks as $stock)
                                   <tr>
                                        <td>{{ $stock->item->name }}</td>
                                        <td>{{ $stock->color->name.','. $stock->size->name.','. $stock->country->name }}</td>
                                        <td>{{ $stock->unit_qty.' '.$stock->item->unit->name .' / '.$stock->sub_unit_qty.' '.$stock->item->subUnit->name }}</td>
                                        <td>{{ $stock->serial }}</td>
                                        <td><a href="#" class="cart-icon" data-id="{{ $stock->id }}">
                                            <i class="bi bi-cart-plus-fill"></i>
                                            </a></td>
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
    $('.cart-icon').on('click', function(){
        let id = $(this).attr('data-id'); 
        $.ajax({
            type: "GET",
            url : "{{ url('admin/add-to-cart-ajax') }}",
            data: {id:id},
            success: function(res){
                // console.log(res);
                toastr.success(res);
            }
        })
    })
</script>







    <script>
        function itemDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteItemForm' + id).submit();
                }
            });
        }
    </script>




@endpush
