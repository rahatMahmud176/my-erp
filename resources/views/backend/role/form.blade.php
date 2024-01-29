@extends('backend.master')
@section('title')
  @if (isset($role))
        Role Edit 
      @else
      Role Add
  @endif 
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-left">
                <div class="card-body">
                    <h2 class="card-title">#Role @if(isset($role)) Edit @else Create @endif </h2>


                    <form action="@if(isset($role)) {{ route('admin.roles.update',$role) }} @else {{ route('admin.roles.store') }} @endif " method="POST">
                        @csrf 
                        @isset($role) 
                            @method('PUT')
                        @endIsset

                        <div class="form-group">
                            <label for="">Role Title</label>
                            <input type="text" name="name" id=""
                            @if(isset($role))  @else autofocus @endif 
                                class="form-control @error('name')is-invalid @enderror"
                                value="@if(isset($role)){{ $role->name }} @else {{ old('name') }} @endif "
                                aria-describedby="helpId">
                                @error('name') <small class="text-danger"> {{ $message }} </small> @enderror
                        </div>


                        <div class="mt-3 text-center">
                            <h4>
                                {{-- <i class="bi bi-shield-fill-check text-danger"></i> --}}
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Role Permissions
                            </h4>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id="select_all_permissions" value="">
                                Select All
                              </label>
                            </div>
                            <hr>
                        </div>

                        <div class="row">

                            @foreach ($modules as $module)
                                <div class="col-md-6">
                                    <h5>
                                        <i class="bi bi-arrow-right-short"></i>
                                        {{ $module->name }}
                                    </h5>
                                    <div class="" style="margin-left: 30px">
                                        @foreach ($module->permissions as $key => $permission)
                                            <div class="form-check">
                                                <input class="form-check-input " 
                                                        name="permissions[]" 
                                                        type="checkbox"
                                                        value="{{ $permission->id }}"
                                                        @if (isset($role))
                                                            @foreach ($role->permissions as $rolePermission)
                                                                    {{ $rolePermission->id == $permission->id ? 'checked':''  }}
                                                            @endforeach
                                                        @endif 
                                                        {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                                    id="flexCheckDefault{{ $permission->id }}">
                                                <label class="form-check-label" for="flexCheckDefault{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <button type="submit" class="btn btn-success mt-3"> @if(isset($role)) Update @else Create @endif Role </button>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('#select_all_permissions').on('click', function(){
            if (this.checked) {
                $(':checkbox').prop('checked', true);
            } else {
                $(':checkbox').prop('checked', false);
                
            }
        })
    </script>

    
@endpush
