@extends('backend.master')
@section('title')
    Color Edit  
@endsection
@section('content')
    <div class="row">
        <div class="card text-left"> 
          <div class="card-body">
             
            <div class="mt-3 clearfix">
                <h3 class="float-start">#Color Edit</h3>
                <a href="{{ route('admin.colors.index') }}" class="btn btn-sm btn-danger  float-end">
                     Cancel</a>
            </div>

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="{{ route('admin.colors.update',$color->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for=""></label>
                          <input type="text" name="name" id="" class="form-control" value="{{ $color->name }}">
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


 