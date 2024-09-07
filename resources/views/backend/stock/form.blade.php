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
                                    <label for="">Supplier 
                                        <button type="button" 
                                                class="btn btn-sm my-btn  btn-secondary"
                                                data-bs-toggle="modal" data-bs-target="#supplierModal">+</button></label>
                                    <select class="form-control select2 my-field" name="supplier_id" id="">
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
                                    <input type="text" readonly name="challan" class="form-control my-field"
                                        value="{{ $challanId }}">
                                </div>
                            </div>
                        </div>



                        <table class="table table-striped mt-3 stock-table">
                            <tr>
                                <th>item</th>
                                @if ($setting->color)
                                    <th>color 
                                        <button type="button" 
                                        class="btn btn-sm my-btn btn-secondary"
                                        data-bs-toggle="modal" data-bs-target="#colorModal">+</button></th>
                                @endif
                                @if ($setting->size)
                                    <th>size <button type="button" class="btn btn-sm my-btn btn-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#sizeModal">+</button></th>
                                @endif
                                @if ($setting->country)
                                    <th>country <button type="button" 
                                                        class="btn btn-sm my-btn btn-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#countryModal">+</button></th>
                                @endif

                                @if ($setting->qty_manage_by_serial == false)
                                    <th>Qty (unit) <button type="button" class="btn btn-sm my-btn  btn-secondary">+</button></th>
                                @endif


                                @if ($setting->sub_unit)
                                    <th>Qty (sub-unit) <button type="button" class="btn btn-sm my-btn  btn-secondary">+</button></th>
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
                                        <select class="form-control select2 my-field" name="stock[1][item]" id="item">
                                            <option value="">--Select--</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} <small class="text-black-50">{{ '(ID:'.$item->id.')' }}</small></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                                @if ($setting->color)
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control select2 my-field" name="stock[1][color_id]" id="">
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
                                            <select class="form-control select2 my-field" name="stock[1][size_id]" id="">
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
                                            <select class="form-control select2 my-field" name="stock[1][country_id]"
                                                id="">
                                                @foreach ($countries as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                @endif

                                @if ($setting->qty_manage_by_serial == false)
                                    <td>
                                        <input style="width: 100px" name="stock[1][unit_qty]" id="unit_qty" type="number"
                                            value="{{ old('stock.1.unit_qty') }}" class="my-field">
                                    </td>
                                @endif

                                @if ($setting->sub_unit)
                                    <td>
                                        <input style="width: 100px" 
                                               name="stock[1][sub_unit_qty]" 
                                               value="{{ old("stock.1.sub_unit_qty") }}"
                                               id="sub_unit_qty"
                                               type="number" 
                                               class="my-field">

                                    </td>
                                @endif

                                <td>
                                    <input style="width: 100px" 
                                            id="purchase" 
                                            name="stock[1][purchase]" type="number"
                                            value="{{ old("stock.1.purchase") }}"
                                            class="my-field">
                                </td>
                                @if ($setting->serial_number)
                                    <td>
                                        @if ($setting->qty_manage_by_serial)
                                            <textarea name="stock[1][serial]"
                                                      value="{{ old("stock.1.serial") }}"
                                                      id="" 
                                                      class="form-control my-field"></textarea>
                                        @else
                                            <input type="text" 
                                                   name="stock[1][serial]" 
                                                   value="{{ old("stock.1.serial") }}"
                                                   class="my-field">
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
                                    <label for="">Payment Type <button type="button" class="btn btn-sm my-btn  btn-secondary">+</button></label>
                                    <select class="form-control select2 my-field" name="account_id" id="accounts">
                                        @foreach ($accounts as $item)
                                            <option {{ old('account_id') == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->ac_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 my-3"> </div>

                            <div class="form-group col-md-3 my-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Total =</th>
                                        <td> <input name="total" 
                                                    value="{{ old('total') }}"
                                                    class="form-control my-field" 
                                                    type="number"
                                                    id="total"></td>
                                    </tr>
                                    <tr>
                                        <th>Pay =</th>
                                        <td><input name="pay"
                                                   value="{{ old('pay') }}"
                                                   type="number" 
                                                   id="pay"
                                                   class="form-control my-field"></td>
                                    </tr>
                                    <tr>
                                        <th>Due =</th>

                                        <td><input name="due" 
                                                   value="{{ old('due') }}"
                                                   type="number" 
                                                   id="due" 
                                                   readonly
                                                class="form-control my-field"></td>
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





@push('modal')


 
<form action="{{ route('admin.country_variants.store') }}" method="post">
    @csrf  
  <div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Country Register Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Country Name</label>
              <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </div>
    </div>
  </div> 
</form>

 
<form action="{{ route('admin.sizes.store') }}" method="post">
    @csrf  
  <div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Size Register Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Size Name</label>
              <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </div>
    </div>
  </div> 
</form>
 
<form action="{{ route('admin.colors.store') }}" method="post">
    @csrf  
  <div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Color Register Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Color Name</label>
              <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
             </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </div>
    </div>
  </div> 
</form>









<form action="{{ route('admin.suppliers.store') }}" method="post">
    @csrf 
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="supplierModalLabel">Supplier Register Form</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row"> 
                
                <div class="form-group">
                  <label for="">Supplier Name</label>
                  <input type="text" 
                         name="name" 
                         id="" required
                         class="form-control" 
                         placeholder="" 
                         aria-describedby="helpId">
                </div>
                <div class="form-group mb-3">
                  <label for="">Supplier Phone Number </label>
                  <input type="text" name="phone_number" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"> Save </button>
            </div>
          </div>
        </div>
      </div> 
</form>  
 

     
 
@endpush

 









@push('script')
    <script>
        $('#item').on('change', function() {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ url('admin/get-item-info') }}",
                data: {
                    id: id
                },
                success: function(res) {
                    console.log(res);
                    $('#unit_qty').attr('placeholder', res.unit.name);
                    $('#sub_unit_qty').attr('placeholder', res.sub_unit.name);
                }
            })
        })
    </script>

    <script>
        $('#unit_qty, #purchase').on('keyup', function() {
            var qty = $('#unit_qty').val();
            var price = $('#purchase').val();
            var total = qty * price;
            $('#total').empty();
            $('#total').val(total);
        })
    </script>

    <script>
        $('#pay,#unit_qty, #purchase').on('keyup', function() {
            let pay = $('#pay').val();
            let total = $('#total').val();
            $('#due').empty();
            $('#due').val(total - pay);
        })
    </script>

    <script>
        $('#pay').on('click', function() {
            $.ajax({
                type: "GET",
                url: "{{ url('admin/get-account-info-without-first-one') }}",
                success: function(res) {
                    console.log(res);
                    $('#accounts').empty();
                    $('#accounts').html(res);
                }
            })
        })
    </script>


    <script>
        var i = 2;
        $('.add-row').on('click', function() { 
            $.ajax({
                type: "GET",
                data: {
                    i: i
                },
                url: "{{ url('admin/add-stock-row') }}",
                success: function(res) { 
                    $('.stock-table').append(res);
                    i++;
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
