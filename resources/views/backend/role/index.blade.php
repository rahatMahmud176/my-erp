@extends('backend.master')

@section('title')
    Roles
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card text-left">
                <div class="card-body">

                    <div class="mt-3 clearfix">
                        <h3 class="float-start">#Roles</h3>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-secondary  float-end">
                            <i class="bi bi-plus-circle"></i>
                            Add Role</a>
                    </div>

                    <table class="table mt-3 table-striped">

                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Slug</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td> <span class="badge bg-secondary"">{{ $role->permissions->count() }}</span> </td>
                                <td>{{ $role->slug }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.roles.edit',$role) }}" class="btn btn-sm btn-secondary">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit</a>
                                    @if ($role->deletable == true)
                                        <a href="#" onclick="roleDelete({{ $role->id }})"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i>
                                            Delete</a>

                                        <form id="deleteRoleForm{{ $role->id }}"
                                            action="{{ route('admin.roles.destroy', $role) }}" method="post">
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
        function roleDelete(id) {
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
                    $('#deleteRoleForm' + id).submit();
                }
            });
        }
    </script>
@endpush
