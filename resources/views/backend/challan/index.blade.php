@extends('backend.master')
@section('title')
    Challans
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Challans</h3> 
                </div>

                <div class="row"> 

                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead class="">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Challan No.</th>
                                    <th class="text-center" scope="col">Supplier</th>
                                    <th class="text-center" scope="col">Total</th>
                                    <th class="text-center" scope="col">Pay</th>
                                    <th class="text-center" scope="col">Due</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($challans as $key => $challan)
                                    <tr>
                                        <td>{{ date("d-M-y" , strtotime($challan->created_at)) }}</td>
                                        <td scope="row">Challan#{{ $challan->id }}</td>
                                        <td class="text-center"><a href="#">{{ $challan->supplier->name }}</a></td>
                                        <td class="text-center">{{ number_format($challan->total, 2) }}</td>
                                        <td class="text-success text-center">{{ number_format($challan->pay, 2) }}</td>
                                        <td class="{{ $challan->due == 0 ?'text-success':'text-danger' }} text-center">{{ number_format($challan->due, 2) }}</td>
                                        
                                        <td class="text-center">

                                            @if ($challan->due != 0)
                                               <a href="#" 
                                               data-id = "{{ $challan->id }}"
                                               data-due = "{{ $challan->due }}"
                                               data-supplier = "{{ $challan->supplier->name }}"
                                               data-supplier_id = "{{ $challan->supplier_id }}"
                                               class="btn btn-sm btn-success pay-challan" 
                                               data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="bi bi-coin"></i>
                                                    Pay</a>
                                            @endif
                                            
                                            @if ($challan->deletable == true)   
                                                <a href="#"  class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                    View</a> 

                                                <a href="#" onclick="challanDelete({{ $challan->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteChallanForm{{ $challan->id }}"
                                                    action="{{ route('admin.challans.destroy', $challan) }}" method="post">
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
<form action="{{ route('admin.payments.store') }}" method="post">
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
                  <input type="hidden" name="challan_id" id="challan_id">
                  <input type="hidden" name="supplier_id" id="supplier_id">
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
                  <input type="number" name="pay" id="pay-amount" max="" class="form-control" > 
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
    $('.pay-challan').on('click', function(){
        let id = $(this).attr('data-id');
        let deu = $(this).attr('data-due');
        let supplier = $(this).attr('data-supplier');
        let supplier_id = $(this).attr('data-supplier_id');

        $('#pay-amount').attr('max', deu);
        const nFormat = new Intl.NumberFormat(undefined, {minimumFractionDigits: 2});
        $('#challan_id').val(id);
        $('#supplier_id').val(supplier_id);
        $('#due').val(nFormat.format(deu));
        $('#exampleModalLabel').empty();
        $('#exampleModalLabel').append('Challan#'+id); 
    })
</script>

 
    <script>
        function challanDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonChallan: "#3085d6",
                cancelButtonChallan: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteChallanForm' + id).submit();
                }
            });
        }
    </script>
@endpush
