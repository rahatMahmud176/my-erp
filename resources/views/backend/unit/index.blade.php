@extends('backend.master')
@section('title')
    Units
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Units</h3>
                    <a href="{{ route('admin.units.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Unit</a>
                </div>

                <div class="row">
                    <div class="col-md-3">



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('admin.units.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" name="name" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-secondary container-fluid mt-3">Submit </button>
                            </div>

                        </form>
                    </div>

                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($units as $key => $unit)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $unit->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.units.edit', $unit) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            @if ($unit->deletable == true)
                                                <a href="#" onclick="unitDelete({{ $unit->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteUnitForm{{ $unit->id }}"
                                                    action="{{ route('admin.units.destroy', $unit) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    {{ $units->links('pagination::bootstrap-5') }}
                </div>



            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        function unitDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonUnit: "#3085d6",
                cancelButtonUnit: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteUnitForm' + id).submit();
                }
            });
        }
    </script>
@endpush
