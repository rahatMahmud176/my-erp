@php
    $totalPay = 0;
    $totalDeposit = 0;
@endphp

@foreach ($transitions as $key => $transition)
<tr>
    <td>{{ date("d-M-y" , strtotime($transition->created_at)) }}</td> 
    <td class="text-center"><a href="#">{{ $transition->account->ac_title }}</a></td>

    <td class="text-center">
        @if ($transition->challan_id != 1)
            <a href="#">#Challan:{{ $transition->challan_id }}</a> <br>
        @else
            <a href="#">#Invoice:{{ $transition->invoice_id }}</a>
        @endif 
        
    </td> 

    <td class="text-center">
        @if ($transition->challan_id != 1)
            #Supp: <a href="#">{{ $transition->challan->supplier->name }}</a> <br>
        @else
           #Cust: <a href="#">{{ $transition->invoice->customer->name }}</a>
        @endif  
    </td> 
         <td class="text-success text-center">{{  $transition->deposit != 0 ? number_format($transition->deposit,2): '-' }}</td>
        <td class="text-success text-center">{{  $transition->pay != 0 ? number_format($transition->pay,2): '-' }}</td> 
   </tr>

   <input type="hidden" name="" value="{{ $totalPay = $totalPay + $transition->pay }}">
   <input type="hidden" name="" value="{{ $totalDeposit = $totalDeposit + $transition->deposit }}">


@endforeach

<tr> 
    <td></td>
    <td></td>
    <td></td>
    <th class="text-center">Total =</th>
    <th class="text-center">{{ number_format($totalDeposit) }}</th>
    <th class="text-center">{{ number_format($totalPay) }}</th>
</tr>