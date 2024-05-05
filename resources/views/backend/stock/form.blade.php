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
                                    <input type="text" name="challan" class="form-control my-field">
                                </div>
                            </div>
                        </div>



                        <table class="table table-striped mt-3">
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

                                <th>Qty</th>
                                @if ($setting->sub_unit)
                                    <th>Qty</th>
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
                                        <select class="form-control my-field" name="item" id="">
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

                                <td>
                                    <input style="width: 100px" name="unit_qty" type="number" class="my-field">
                                </td>
                                @if ($setting->sub_unit)
                                    <td>
                                        <input style="width: 100px" name="sub_unit_qty" type="number" class="my-field">
                                    </td>
                                @endif

                                <td>
                                    <input style="width: 100px" required name="purchase" type="number" class="my-field">
                                </td>
                                @if ($setting->serial_number)
                                <td>
                                    <textarea name="serial" id="" class="form-control my-field"></textarea>
                                    {{-- <input type="text" name="serial" class="my-field"> --}}
                                </td>
                                @endif
                                <td>
                                    <button class="btn btn-sm btn-success my-btn">+</button>
                                </td>
                            </tr>






                        </table>




                        <div class="row">
                            <div class="form-group col-md-3 my-3">
                                <div class="form-group">
                                    <label for="">Payment Type</label>
                                    <select class="form-control my-field" name="account" id="">
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
                                        <td>{{ number_format(54654, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pay =</th>
                                        <td><input type="number" class="form-control my-field"></td>
                                    </tr>
                                    <tr>
                                        <th>Due =</th>
                                        <td>{{ number_format(54654, 2) }}</td>
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


@push('style')
    <style>
        .my-btn {
            --bs-btn-padding-y: 0px;
            --bs-btn-padding-x: 5px;
        }
    </style>
@endpush
