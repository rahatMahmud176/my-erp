@extends('backend.master')
@section('title')
    Sub Categories
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Categoris</h3>
                    <a href="{{ route('admin.subCategories.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add SubCategory</a>
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


                        <form action="{{ route('admin.subCategories.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="" class="mb-2">Category</label>
                                <select class="form-control" name="cat" id="">
                                    @foreach ($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach 
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="" class="my-3">Sub Category</label>
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
                                    <th scope="col">SubCategory</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($subCategories as $key => $subCategory)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.subCategories.edit', $subCategory) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            @if ($subCategory->deletable == true)
                                                <a href="#" onclick="subCategoryDelete({{ $subCategory->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteSubCategoryForm{{ $subCategory->id }}"
                                                    action="{{ route('admin.subCategories.destroy', $subCategory) }}"
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
        function subCategoryDelete(id) {
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
                    $('#deleteSubCategoryForm' + id).submit();
                }
            });
        }
    </script>
@endpush
