@extends('backend.master-without-sidebar')



@section('title')
    Stock @isset($stock)
        Edit
    @else
        Add
    @endisset
@endsection
@section('content')
    <div class="mt-4"></div>

    <div class="row">
        <div class="card text-left">
            <div class="card-body">
                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Stock @isset($stock)
                            Edit
                        @else
                            Add
                        @endisset </h3>
                    <a href="{{ route('admin.stocks.index') }}" class="btn btn-sm btn-danger  float-end">
                        Cancel</a>
                </div>

                <div class="row">


                    


                    <form
                        action=" @isset($stock) {{ route('admin.stocks.update', $stock->id) }} @else {{ route('admin.stocks.store') }} @endisset"
                        method="post">
                        @csrf
                        @isset($stock)
                            @method('PUT')
                        @endisset

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        <div class="row">
                            <div class="form-group col-md-3 my-3">
                                <div class="form-group">
                                    <label for="">Supplier</label>
                                    <select class="form-control my-field" name="supplier_id" id="">
                                        @foreach ($suppliers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group col-md-6 my-3"> </div>
    
                            <div class="form-group col-md-3 my-3">
                                <div class="form-group">
                                    <label for="">Challan / Lot Traking </label>
                                    <input type="text" readonly name="challan" class="form-control my-field" value="{{ $challanId }}">
                                </div>
                            </div>
                        </div>



                        <table class="table table-striped mt-3 stock-table">
                            <tr>
                                <th>item</th>
                                @if ($setting->color)
                                    <th>color</th>
                                @endif
                                @if ($setting->size)
                                    <th>size</th>
                                @endif
                                @if ($setting->country)
                                    <th>country</th>
                                @endif

                                @if ($setting->qty_manage_by_serial==false )
                                     <th>Qty (unit)</th>
                                @endif


                                @if ($setting->sub_unit)
                                    <th>Qty (sub-unit)</th>
                                @endif
                                <th>Purchase p.</th>
                                @if ($setting->serial_number)
                                    <th>SL / IMEI No.</th>
                                @endif
                                <th>Action</th>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control my-field" name="item" required id="item">
                                            <option value="">--Select--</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                                @if ($setting->color)
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control my-field" name="color_id" id="">
                                                @foreach ($colors as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                @endif

                                @if ($setting->size)
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control my-field" name="size_id" id="">
                                                @foreach ($sizes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                @endif
                                @if ($setting->country)
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control my-field" name="country_id" id="">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                @endif

                                @if ($setting->qty_manage_by_serial==false )
                                    <td>
                                        <input style="width: 100px" name="unit_qty" id="unit_qty" type="text" class="my-field">
                                    </td>
                                @endif  

                                @if ($setting->sub_unit)
                                    <td>
                                        <input style="width: 100px" name="sub_unit_qty" id="sub_unit_qty" type="number" class="my-field">
                                        
                                    </td>
                                @endif

                                <td>
                                    <input style="width: 100px" required id="purchase" name="purchase" type="number" class="my-field">
                                </td>
                                @if ($setting->serial_number)
                                <td>
                                    @if ($setting->qty_manage_by_serial)
                                        <textarea name="serial" id="" class="form-control my-field"></textarea>
                                    @else
                                        <input type="text" name="serial" class="my-field">
                                    @endif
                                </td>
                                @endif
                                <td>
                                    <button type="button" class="btn btn-sm btn-success my-btn add-row">+</button>
                                </td>
                            </tr>






                        </table>




                        <div class="row">
                            <div class="form-group col-md-3 my-3">
                                <div class="form-group">
                                    <label for="">Payment Type</label>
                                    <select class="form-control my-field" name="account_id" id="accounts">
                                        @foreach ($accounts as $item)
                                            <option value="{{ $item->id }}">{{ $item->ac_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 my-3"> </div>

                            <div class="form-group col-md-3 my-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total =</th>
                                        <td> <input name="total" class="form-control my-field" type="number" id="total" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>Pay =</th>
                                        <td><input name="pay" type="number" id="pay" class="form-control my-field"></td>
                                    </tr>
                                    <tr>
                                        <th>Due =</th>
                                         
                                        <td><input name="due" type="number" id="due" readonly class="form-control my-field"></td>
                                    </tr>
                                </table>
                            </div>


                        </div>




                        <div class="form-group col-1 float-end">
                            <button class="btn btn-secondary container-fluid mt-3">
                                @isset($stock)
                                    Update
                                @else
                                    Submit
                                @endisset
                            </button>
                        </div>

                    </form>


                </div>



            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        
        $('#item').on('change', function(){
             let id = $(this).val();
              $.ajax({
                    type : "GET",
                    url : "{{ url('admin/get-item-info') }}",
                    data : {id:id},
                    success : function(res){
                         console.log(res); 
                         $('#unit_qty').attr('placeholder',res.unit.name);
                         $('#sub_unit_qty').attr('placeholder',res.sub_unit.name);
                    }
              })
        })
    </script>

<script>
    $('#unit_qty, #purchase').on('keyup', function(){  
        var qty = $('#unit_qty').val();
        var price = $('#purchase').val();
        var total = qty*price; 
        $('#total').empty();
        $('#total').val(total);
    })  
</script>

<script>
    $('#pay,#unit_qty, #purchase').on('keyup', function(){
        let pay = $('#pay').val();
        let total = $('#total').val();  
        $('#due').empty();
        $('#due').val(total-pay);
    })
</script>

<script>
    $('#pay').on('click', function(){   
        $.ajax({
            type: "GET",
            url : "{{ url('admin/get-account-info-without-first-one') }}",
            success: function(res){
                // console.log(res);
                $('#accounts').empty();
                $('#accounts').html(res);
            }
        }) 
    }) 

</script>


<script>
    $('.add-row').on('click', function(){
        $.ajax({
            type: "GET",
            url : "{{ url('admin/add-stock-row') }}",
            success: function(res){
                $('.stock-table').append(res); 
            }
        }) 
    })
</script>



@endpush
@push('style')
    <style>
        .my-btn {
            --bs-btn-padding-y: 0px;
            --bs-btn-padding-x: 5px;
        }
    </style>
@endpush
