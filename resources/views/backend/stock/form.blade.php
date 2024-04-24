@extends('backend.master')
@section('title')
    Stock @isset($stock)
        Edit
    @else
        Add
    @endisset
@endsection
@section('content')
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

                    <form class="row"
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


                        <div class="form-group col-md-6 my-3">
                            <div class="form-group">
                                <label for="">Item</label>
                                <select class="form-control" name="item" id="">
                                   @foreach ($items as $item) 
                                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                                   @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6 my-3">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <select class="form-control" name="supplier" id="">
                                  @foreach ($suppliers as $item) 
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach 
                               </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 my-3">
                            <div class="form-group">
                                <label for="">Size</label>
                                <select class="form-control" name="size" id="">
                                  @foreach ($sizes as $item) 
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach 
                               </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 my-3">
                            <div class="form-group">
                                <label for="">Color</label>
                                <select class="form-control" name="color" id="">
                                  @foreach ($colors as $item) 
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach 
                               </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 my-3">
                            <div class="form-group">
                                <label for="">Country</label>
                                <select class="form-control" name="country" id="">
                                  @foreach ($countries as $item) 
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach 
                               </select>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-3 my-3">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input name="qty" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group col-md-9 my-3">
                                <label for="">Prices</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Purchase | Wholesale | Sale </span>
                                    </div>
                                    <input name="purchase" type="text" class="form-control">
                                    <input name="wholesale" type="text" class="form-control">
                                    <input name="price" type="text" class="form-control">
                                </div>
                            </div>

                        </div>


                        <div class="form-group col-md-12 my-3">

                          <label for=""> Serial or, IMEI</label>
                          <textarea class="form-control" name="serial" id=""></textarea>

                        </div>



                        <div class="form-group">
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
