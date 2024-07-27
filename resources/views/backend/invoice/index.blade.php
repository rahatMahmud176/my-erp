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
                                    <th class="text-center" scope="col">Branch</th>
                                    <th class="text-center" scope="col">Total</th> 
                                    <th class="text-center" scope="col">Due</th> 
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
                                        <td scope="row">{{ $invoice->branch->name }}</td>
                                        <td scope="row">{{ number_format($total = $invoice->total, 2) }}</td>
                                        <td scope="row">{{ number_format($due = $total - $invoice->transitions->sum('deposit'),2) }}</td>
                                        <td scope="row">
                                        
                                        @if ($invoice->deletable == true)
                                            @if ($due != 0)
                                            <a href="#" 
                                                data-id = "{{ $invoice->id }}"
                                                data-due = "{{ $due }}"
                                                class="btn btn-sm btn-success pay-invoice" 
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                 <i class="bi bi-coin"></i>
                                                 Pay</a>    
                                            
                                            @endif
                                                

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






@push('modal')
<form action="{{ route('admin.transitions.store') }}" method="post">
    @csrf 
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row"> 
                <div class="form-group col-md-6 mb-3">
                  <label for="">Due Amount</label>
                  <input type="hidden" name="invoice_id" id="invoice_id"> 
                  <input readonly type="text" id="due" class="form-control text-danger" placeholder="" aria-describedby="helpId"> 
                </div> 
                <div class="form-group col-md-6 mb-3">
                </div> 
                <div class="form-group col-md-6">
                    <label for=""> Account </label>
                    <select name="account_id" class="form-control" id="">
                        @foreach ($accounts as $account)
                             <option value="{{ $account->id }}">{{ $account->ac_title }} </option>                            
                        @endforeach
                    </select>
                </div> 
                <div class="form-group col-md-6">
                  <label for="">Pay Amount</label>
                  <input type="number" name="deposit" id="pay-amount" max="" class="form-control" > 
                </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"> <i class="bi bi-coin"></i> Pay </button>
            </div>
          </div>
        </div>
      </div>

</form>
@endpush



@push('script')  


<script>
    $('.pay-invoice').on('click', function(){
        let id = $(this).attr('data-id');
        let deu = $(this).attr('data-due');  
        $('#pay-amount').attr('max', deu);
        const nFormat = new Intl.NumberFormat(undefined, {minimumFractionDigits: 2});
        $('#invoice_id').val(id); 
        $('#due').val(nFormat.format(deu));
        $('#exampleModalLabel').empty();
        $('#exampleModalLabel').append('Invoice#'+id); 
    })
</script>
 
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
