@extends('backend.master')
@section('title')
    Categories
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Categoris</h3>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Category</a>
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


                        <form action="{{ route('admin.categories.store') }}" method="post">
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
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            @if ($category->deletable == true)
                                                <a href="#" onclick="categoryDelete({{ $category->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteCategoryForm{{ $category->id }}"
                                                    action="{{ route('admin.categories.destroy', $category) }}"
                                                    method="post">
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

                </div>



            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        function categoryDelete(id) {
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
                    $('#deleteCategoryForm' + id).submit();
                }
            });
        }
    </script>
@endpush
