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
                    <div class="form-check float-end">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="fullMonth" value="checkedValue">
                            Full Month ?
                        </label>
                    </div>
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
                                    <th class="text-center" scope="col">Profit</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="invoice-body-ajax">

                                @include('backend.invoice.ajax-invoice-body')


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
                            <input readonly type="text" id="due" class="form-control text-danger" placeholder=""
                                aria-describedby="helpId">
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
                            <input type="number" name="deposit" id="pay-amount" max="" class="form-control">
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
        $('.pay-invoice').on('click', function() {
            let id = $(this).attr('data-id');
            let deu = $(this).attr('data-due');
            $('#pay-amount').attr('max', deu);
            const nFormat = new Intl.NumberFormat(undefined, {
                minimumFractionDigits: 2
            });
            $('#invoice_id').val(id);
            $('#due').val(nFormat.format(deu));
            $('#exampleModalLabel').empty();
            $('#exampleModalLabel').append('Invoice#' + id);
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

    <script>
        $('#fullMonth').on('click', function() {
            if (this.checked) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-full-month-invoices') }}",
                    data: '',
                    success: function(res) {
                        $('.invoice-body-ajax').empty();
                        $('.invoice-body-ajax').html(res);
                    }
                });
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-today-invoices') }}",
                    data: '',
                    success: function(res) {
                        // console.log(res); 
                        $('.invoice-body-ajax').empty();
                        $('.invoice-body-ajax').html(res);
                    }
                });
            }
        })
    </script>
@endpush
