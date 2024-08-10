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
@endforeach