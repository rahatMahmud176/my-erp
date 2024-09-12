@extends('backend.master')
@section('title')
    {{ $item->name }} History
@endsection
@section('content')
    <div class="row">
        <div class="card text-left"> 
          <div class="card-body row">
            <h4 class="card-title">#{{ $item->name }}</h4>
            
          <div class="col-md-6">
            <h6>#Purchase</h6> <hr>
              <table class="table">
                @foreach ($item->challan_details as $detail)
                  <tr> 
                    <td>{{ date('d-M-y' ,strtotime($detail->created_at)) }}</td>
                    <td>challan#{{ $detail->challan_id }}</td>
                    <td>{{ $detail->challan->supplier->name }}</td>
                    <td>{{ $detail->unit_qty }}</td>
                  </tr>
                @endforeach  
                <tr>
                  <th></th>
                  <th>Total</th>
                  <th>=</th>
                  <th>{{ $item->challan_details->sum('unit_qty') }}</th>
                </tr>
             
              </table>
          </div>
          
          <div class="col-md-6">
            <h6>#Sold</h6> <hr> 
            @php
                $totalQty =0;
            @endphp

            <table class="table">
               @forelse ($item->stocks as $stock) 
                  @forelse ($stock->invoice_details as $detail)
                       <tr>
                         <td>{{ date('d-M-y',strtotime($detail->created_at)) }}</td>
                        <td>invoice#{{ $detail->invoice_id }}</td>
                        <td>{{ $detail->unit_qty }}</td>
                        <td class="d-none">{{ $totalQty= $totalQty + $detail->unit_qty }}</td>
                       </tr>
                  @empty   
                  @endforelse 
               @empty 
               @endforelse
              <tr>
                <th>Total</th>
                <th>=</th>
                <th>{{ $totalQty }}</th>
              </tr>
            </table>

          </div>
            

          </div>
        </div>
    </div>
@endsection