@extends('backend.master')
@section('content')
    <div class="row">


        <div class="card col-md-10 mx-auto text-left"> 
          <div class="card-body">
            <h4 class="card-title">#{{ $supplier->name }} History</h4>
            
                <table class="table table-border">
                    <tr>
                        <th>Date</th>
                        <th>Deposit</th>
                        <th>Due</th>
                        <th>Note</th>
                    </tr>
                    @foreach ($supplier->transitions as $transition)
                    <tr>
                        <td>{{ date('d-M-y', strtotime($transition->created_at)) }}</td>
                        <td>{{ $transition->deposit !=0 ? $transition->deposit:'-' }}</td>
                        <td>{{ $transition->due!=0 ? $transition->due :'-' }}</td>
                        <td>
                            @if ($transition->challan_id !=1)
                                <a href="{{ route('admin.challans.show',$transition->challan_id) }}">{{ 'Challan#'.$transition->challan_id }}</a>
                            @else
                             {{ '-"'.$transition->note.'"' }}
                            @endif
                           
                        </td>
                    </tr>
                    @endforeach
                </table>
           
          </div>
        </div>

        


    </div>
@endsection