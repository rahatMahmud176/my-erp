@extends('backend.master')

@section('title')
    Users
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
                <div class="card-body">

                    <div class="mt-3 clearfix"> 
                        <h3 class="float-start">#Users</h3>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-secondary  float-end">
                            <i class="bi bi-plus-circle"></i>
                            Add User</a>
                    </div>

                    <table class="table mt-3 table-striped">

                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Role</th> 
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td> <span class="badge bg-secondary"">{{ $user->role->name }}</span> </td>
                                
                                <td class="text-center">
                                    @if ($user->role->slug !== "super-admin") 
                                        <a href="{{ route('admin.users.edit',$user) }}" class="btn btn-sm btn-secondary">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit</a>
                                    
                                            <a href="#" onclick="userDelete({{ $user->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3-fill"></i>
                                                Delete</a>

                                            <form id="deleteuserForm{{ $user->id }}"
                                                action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                    @endif


                                </td>
                            </tr>
                        @endforeach



                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        function userDelete(id) {
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
                    $('#deleteuserForm' + id).submit();
                }
            });
        }
    </script>
@endpush
