@extends('backend.master')
@section('title')
    Items
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Items</h3>
                    <a href="{{ route('admin.items.create') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Item</a>
                </div>

                <div class="row">
                    {{-- <div class="col-md-3">



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('admin.items.store') }}" method="post">
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
                    </div> --}}

                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Utility</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($items as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->name.'(#'.$item->id.')' }}</td>
                                        <td>
                                            <table class="table table-borderless ">
                                                <tr><th>Category</th>    <td>:</td>  <td> @foreach($item->categories as $cat ) {{ $cat->name }} {{ $loop->last ? '':',' }}  @endforeach</td> </tr>
                                                <tr><th>SubCategory</th> <td>:</td>  <td>@foreach($item->subCats as $cat ) {{ $cat->name }} {{ $loop->last ? '':',' }}  @endforeach</td> </tr>
                                                <tr><th>Brand</th>       <td>:</td>  <td>{{ $item->brand->name }}</td> </tr> 
                                                <tr><th>Unit</th>        <td>:</td>  <td>{{ $item->unit->name }}</td> </tr> 
                                                <tr><th>Sub Unit</th>    <td>:</td>  <td>{{ $item->subUnit->name }}</td> </tr> 
                                                <tr><th>Country</th>     <td>:</td>  <td>@foreach($item->countries as $cat ) {{ $cat->name }} {{ $loop->last ? '':',' }}  @endforeach</td> </tr> 
                                            </table>   
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.items.edit', $item) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                            
                                                <a href="#" onclick="itemDelete({{ $item->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteItemForm{{ $item->id }}"
                                                    action="{{ route('admin.items.destroy', $item) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                             

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
        function itemDelete(id) {
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
                    $('#deleteItemForm' + id).submit();
                }
            });
        }
    </script>
@endpush
