@extends('backend.master')
@section('title')
    Challan Details
@endsection
@section('content')
    <div class="container my-5">
        <div class="card p-5">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6">
                        <h6 class="mb-3">Supplier:</h6>
                        <span>{{ $challan->supplier->name  }}</span>
                        <span>{{ $challan->supplier->phone_number }}</span>
                        
                    </div>  
                </div>

                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div>
                            <strong>Challan #:  {{ $challan->id }}</strong>
                        </div>
                        <div>Date: {{ date('d-M-y', strtotime($challan->created_at)) }}</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Purchase Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($challan->details as $stock)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $stock->item->name }} <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->color->name }} </small> <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->size->name }} </small> <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->country->name }} </small> <br> 
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->serial }} </small> <br> 
                                    </td>
                                    <td>{{ $stock->unit_qty.' '.$stock->item->unit->name.' |'.$stock->sub_unit_qty.' '.$stock->item->subUnit->name }}
                                    </td>
                                    <td>{{ number_format($stock->purchase_price) }}</td>
                                    <td>{{ $stock->unit_qty * $stock->purchase_price }}</td>
                                    </tr>
                            @empty
                                    @foreach ($challan->stocks as $stock)
                                    <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $stock->item->name }} <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->color->name }} </small> <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->size->name }} </small> <br>
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->country->name }} </small> <br> 
                                        <small> <i class="bi bi-arrow-right"></i> {{ $stock->serial }} </small> <br> 
                                    </td>
                                    <td>{{ $stock->unit_qty.' '.$stock->item->unit->name.' |'.$stock->sub_unit_qty.' '.$stock->item->subUnit->name }}
                                    </td>
                                    <td>{{ number_format($stock->purchase_price) }}</td>
                                    <td>{{ $stock->unit_qty * $stock->purchase_price }}</td>
                                    </tr>
                                @endforeach 
                            @endforelse


                      
                            
                        </tbody>
                    </table> 

                </div> 
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <div>
                            <strong>Total Amount #:  {{ number_format($challan->total) }}</strong>
                        </div>  
                        <h6 class="mb-1 mt-3">Payment Details:</h6> 
                        @foreach ($challan->transitions as $transition)
                            <span> {{ date('d-M-y', strtotime($transition->created_at)) }} : {{ number_format($transition->pay,2) }} tk ({{ $transition->account->ac_title }})</span>
                            <br>
                        @endforeach
                    </div>
                </div>

             

                {{-- <a href="javascript:window.print()" class="btn btn-secondary d-print-none float-end">Print</a> --}}
            </div>
        </div>
    @endsection


    @push('style')
        <style>
            @media print {
                .not-print {
                    display: none;
                }

                .printable {
                    width: 100%;
                    font-size: 9px;
                    margin-top: 0 !important;
                    margin: 0;
                    /* Remove any margin to take full page width */
                    padding: 0;
                }
            }
        </style>
    @endpush
