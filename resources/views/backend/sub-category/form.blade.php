@extends('backend.master')
@section('title')
    SubCategory Edit  
@endsection
@section('content')
    <div class="row">
        <div class="card text-left"> 
          <div class="card-body">
             
            <div class="mt-3 clearfix">
                <h3 class="float-start">#SubCategory Edit</h3>
                <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-sm btn-danger float-end">
                     Cancel</a>
            </div>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="{{ route('admin.sub-categories.update',$subCategory->id) }}" method="post">
                        @csrf
                        @method('PUT') 

                        <div class="form-group">
                          <label for="" class="mb-2">Category</label>
                          <select class="form-control" name="cat" id="">
                              @foreach ($categories as $category)
                                <option {{ $category->id ==  $subCategory->category->id ?'selected':'' }}  value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach 
                          </select>
                      </div>

                        <div class="form-group mt-3">
                          <label for="">Sub Category</label>
                          <input type="text" name="name" id="" class="form-control" value="{{ $subCategory->name }}">
                         </div>

                         <div class="form-group"> 
                           <button class="btn btn-secondary container-fluid mt-3">Update </button>
                         </div>

                    </form>
                </div> 

            </div>



          </div>
        </div>
    </div>
@endsection


 