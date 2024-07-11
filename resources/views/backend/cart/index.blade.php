@extends('backend.master')
@section('title')
    Prducts for sale out
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Product for Sale out</h3>
                    <a href="{{ route('admin.pos.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-skip-backward"></i>
                        Back to Pos</a>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <form class="row" action="{{ route('admin.cart.store') }}" method="post">
                            @csrf

                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="thead-color">Product</th>
                                            <th scope="col" class="thead-color">P.Price</th>
                                            <th scope="col" class="thead-color">S.Price</th>
                                            <th scope="col" class="thead-color">Profit (pice)</th>
                                            <th scope="col" class="thead-color">Unit Qty</th>
                                            <th scope="col" class="thead-color">Sub Unit Qty</th>
                                            <th scope="col" class="thead-color">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contents as $key => $content)
                                            <tr>
                                                <td>{{ $content->item->name }}</td>
                                                <input name="sale[{{ $key }}][id]" type="hidden" value="{{ $content->id }}">
                                                <td>
                                                    {{ number_format($content->purchase_price, 2) }} Tk.
                                                </td>
                                                <td>
                                                    <input type="number" name="sale[{{ $key }}][sale_price]" class="form-control my-field"
                                                        placeholder="0.00" min="1">
                                                </td>
                                                <td>10.00 Tk.</td>
                                                <td>
                                                    <input name="sale[{{ $key }}][unit_qty]" type="number" class="form-control my-field"
                                                        value="{{ $content->unit_qty }}" min="1"
                                                            >{{ $content->item->unit->name }}
                                                </td>
                                                <td>
                                                    <input name="sale[{{ $key }}][sub_unit_qty]" type="number" class="form-control my-field"
                                                        value="{{ $content->sub_unit_qty }}">
                                                    <small>{{ $content->item->subUnit->name }}</small>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody> 
                                </table>
                            </div>

                            <div class="col-lg-6 mt-5">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="thead-color">Customer Info</th>
                                            <th scope="col" class="thead-color">Inputs</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            <tr>
                                                <td>Customer Phone Number:</td>  
                                                <td> <input name="phone_number" class="my-field phone_number" placeholder="015********" type="text"> </td>
                                                <input type="hidden" class="customer_id" name="customer_id" id="">
                                            </tr> 
                                            <tr>
                                                <td>Customer Name:</td>  
                                                <td> <input name="name" class="my-field name" placeholder="Mr. xyz" type="text"> </td>
                                            </tr> 
                                            <tr>
                                                <td>Customer Address:</td>  
                                                <td> <textarea name="address" class="my-field address"></textarea> </td>
                                            </tr> 
                                    </tbody> 
                                </table>
                            </div>

                            <div class="col-lg-6 mt-5">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="thead-color">Payment Info</th>
                                            <th scope="col" class="thead-color">Inputs</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            <tr>
                                                <td>Account Number:</td>  
                                                <td> 
                                                    <select class="my-field" name="account_id" id="">
                                                        @foreach ($accounts as $account)
                                                            <option value="{{ $account->id }}">{{ $account->ac_title }}</option>
                                                        @endforeach   
                                                    </select>    
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td>Total Due:</td>  
                                                <td> <input name="total" class="my-field due-field" type="number"> </td>
                                            </tr> 
                                            <tr>
                                                <td>Payment:</td>  
                                                <td> <input name="deposit" class="my-field due-field" type="number"> </td>
                                            </tr> 
                                    </tbody> 
                                </table>
                            </div>


                            <div class="mt-3 clearfix"> 
                                <button class="btn btn-success  float-end"> Submit</button>
                            </div>


                        </form>


                    </div>
                </div>

                

            </div>
        @endsection



        @push('script')


            <script>
                $('.phone_number').on('blur', function(){
                    let number = $(this).val();
                    $.ajax({
                        type: "GET",
                        url : "{{ url('admin/find-customer') }}",
                        data: {number:number},
                        success: function(res){

                            if (res.phone_number) { 
                                $('.phone_number').val(res.phone_number);
                            } 
                            $('.name').val(res.name);
                            $('.address').val(res.address);
                            $('.customer_id').val(res.id);
                            console.log(res);
                        }
                    })
                })
            </script>








            <script>
                function colorDelete(id) {
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
                            $('#deleteColorForm' + id).submit();
                        }
                    });
                }
            </script>
        @endpush


@push('style')
    <style>
        .thead-color{
            background: #6c757d !important;
            color: white !important;
        }
    </style>
@endpush