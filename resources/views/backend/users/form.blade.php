@extends('backend.master')
@section('title')
    Edit User
@endsection
@section('content')
    <div class="row">
        <div class="card text-left"> 
          <div class="card-body">
            <h4 class="card-title">User Role SetUp</h4>
            
            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                @method('PUT')
                @csrf 
             
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""></label>
                        <input type="text" readonly class="form-control" value="{{ $user->name.' ('.$user->email.')' }}" aria-describedby="helpId"> 
                      </div>
                    
                    <div class="form-group col-md-6">
                        <div class="form-group">
                          <label for="">Role</label>
                          <select class="form-control" name="role" id="">
                            @foreach ($roles as $role)
                                 <option {{ $role->id == $user->role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option> 
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 mx-auto">
                            <button type="submit" class="btn btn-success container-fluid mt-3">Update</button>
                      </div>
                </div>

            </form>

          </div>
        </div>
    </div>
@endsection


