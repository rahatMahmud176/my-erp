@extends('backend.master')
@section('title')
    Suppliers
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Suppliers</h3>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Supplier</a>
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


                        <form action="{{ route('admin.suppliers.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Mr."
                                    aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for=""></label>
                                <input type="number" name="phone_number" id="" class="form-control" placeholder="015********"
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
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col"> Due </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($suppliers as $key => $supplier)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone_number }}</td>
                                        <td>{{ number_format($supplier->credit - $supplier->debit, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>
                                           
                                                <a href="#" onclick="supplierDelete({{ $supplier->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteSupplierForm{{ $supplier->id }}"
                                                    action="{{ route('admin.suppliers.destroy', $supplier) }}" method="post">
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
        function supplierDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonSupplier: "#3085d6",
                cancelButtonSupplier: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteSupplierForm' + id).submit();
                }
            });
        }
    </script>
@endpush
