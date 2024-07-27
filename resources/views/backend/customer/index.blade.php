@extends('backend.master')
@section('title')
    Customers
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body mt-3">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Customers</h3>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-secondary  float-end"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle"></i>
                        Add Customer</a>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name </th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Due</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($customers as $key => $customer)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            @if (!$customer->invoices->isEmpty())
                                                <input type="hidden"
                                                    value="{{ $totalDue = $customer->invoices->sum('total') }}">
                                                @php
                                                    $totalDeposit = 0;
                                                @endphp
                                                @foreach ($customer->invoices as $invoice)
                                                    <input type="hidden" name=""
                                                        value="{{ $totalDeposit = $totalDeposit + $invoice->transitions->sum('deposit') }}">
                                                @endforeach
                                                {{ number_format($totalDue - $totalDeposit, 2) }}
                                            @else
                                                -
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



@push('modal')
    <form action="{{ route('admin.customers.store') }}" method="post">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Register form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">

                        <div class="form-group">
                            <label for="">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="" class="form-control"
                                aria-describedby="helpId">
                        </div>

                        <div class="form-group">
                            <label for="">Customer Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" id="" class="form-control"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Customer Email <span class="text-secondary">(Optional)</span></label>
                            <input type="text" name="email" id="" class="form-control"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Customer Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id=""></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endpush






@push('script')
    <script>
        function customerDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonCustomer: "#3085d6",
                cancelButtonCustomer: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteCustomerForm' + id).submit();
                }
            });
        }
    </script>
@endpush
