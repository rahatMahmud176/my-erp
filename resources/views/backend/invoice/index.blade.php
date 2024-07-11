@extends('backend.master')
@section('title')
    Invoices
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Invoices</h3> 
                </div>

                <div class="row"> 

                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead class="">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice No.</th>
                                    <th class="text-center" scope="col">Cutomer</th>
                                    <th class="text-center" scope="col">Total</th> 
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($invoices as $key => $invoice)
                                    <tr>
                                        <td>{{ date("d-M-y" , strtotime($invoice->created_at)) }}</td>
                                        <td scope="row">Invoice#{{ $invoice->id }}</td>
                                        <td scope="row">
                                            {{ $invoice->customer->name }} <br>
                                            <small>{{ $invoice->customer->phone_number }}</small>

                                        </td>
                                        <td scope="row">{{ number_format($invoice->total, 2) }}</td>
                                        <td scope="row">
                                        
                                        @if ($invoice->deletable == true)
                                            <a href="{{ route('admin.invoice.show',$invoice->id) }}" class="btn btn-sm btn-secondary">View</a>
                                             <a href="#" onclick="invoiceDelete({{ $invoice->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash3-fill"></i>
                                                Delete</a>

                                            <form id="deleteInvoiceForm{{ $invoice->id }}"
                                                action="{{ route('admin.invoice.destroy', $invoice) }}"
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
        function invoiceDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonInvoice: "#3085d6",
                cancelButtonInvoice: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteInvoiceForm' + id).submit();
                }
            });
        }
    </script>
@endpush
