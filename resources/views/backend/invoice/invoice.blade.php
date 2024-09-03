@extends('backend.master')
@section('title')
    invoice
@endsection
@section('content') 

<div class="container my-5">
    <div class="card p-5">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>{{ $company->company_name }}</strong>
                    </div>
                    <div>{{ $company->company_address }}</div>  
                    <div>Phone: {{ $company->company_phone_number }}</div>
                </div>

                <div class="col-6 text-sm-end">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>{{ $invoice->customer->name }}</strong>
                    </div> 
                    <div>{{ $invoice->customer->address }}</div>
                    <div>Email: {{ $invoice->customer->email }}</div>
                    <div>Phone: {{ $invoice->customer->phone_number }}</div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6"> 
                    <div>
                        <strong>Invoice #: {{ $invoice->id }}</strong>
                    </div>
                    <div>Date: {{ date('d-M-y', strtotime($invoice->created_at)) }}</div> 
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $total = 0; 
                        @endphp

                    @foreach ($invoice->details as $key => $details) 
                        <tr>
                            <td>{{ $key++ }}</td>
                            <td>
                                {{ $details->stock->item->name }} <br>
                                <small> <i class="bi bi-arrow-right"></i> {{ $details->stock->color->name }} </small> <br>
                                <small> <i class="bi bi-arrow-right"></i> {{ $details->stock->size->name }} </small> <br>
                                <small> <i class="bi bi-arrow-right"></i> {{ $details->stock->country->name }} </small> <br>
                            </td>
                            <td>
                                {{ $details->unit_qty.' ('.$details->stock->item->unit->name.')' }} <br>
                                {{ $details->sub_unit_qty.' ('.$details->stock->item->subUnit->name.')' }}
                            </td>
                            <td>{{ number_format($details->sale_price, 2) }}</td>
                            <input type="hidden" value="{{ $subTotal =  $details->sale_price * $details->unit_qty }}">
                            <td>{{ number_format($subTotal, 2) }}</td>
                        </tr>

                        <input type="hidden" value="{{ $total= $total+$subTotal }}">
                    @endforeach  
                        <tr>
                            <td colspan="4" class="text-end"><strong>Subtotal</strong></td>
                            <td>{{ number_format($total,2) }}</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="4" class="text-end"><strong>Tax (10%)</strong></td>
                            <td>$34.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                            <td><strong>$374.00</strong></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>


            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">Payment Details:</h6> 
                    @foreach ($invoice->transitions as $transition)
                        <span> {{ date('d-M-y', strtotime($transition->created_at)) }} : {{ number_format($transition->deposit,2) }} tk
                            {{ '('.$transition->account->ac_title.')' }}
                        </span>
                        <br>
                    @endforeach
            </div>


            <div class="text-center mt-3">
                <p class="text-muted">Thank you for your purchase!</p>
            </div>
        </div>

        <a href="javascript:window.print()" class="btn btn-secondary d-print-none float-end">Print</a>
    </div>  
</div>

@endsection


@push('style')
    <style>
        @media print {
        .not-print{
            display: none;
        }
        .printable{
            width: 100%;
            font-size: 9px;
            margin-top:0 !important;
            margin: 0; /* Remove any margin to take full page width */
            padding: 0;
        }
    }
    </style>
@endpush
 



