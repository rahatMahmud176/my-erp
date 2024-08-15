@extends('backend.master')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- @role('user')
        <h1>Hello User</h1>
    @endrole

    @role('super-admin')
        <h1>Hello Super Admin</h1>
    @endrole --}}

    <div class="row container">
        @foreach ($accounts as $account)
            <div class="col-md-3">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">{{ $account->ac_title }}</h4>
                        <p class="card-text">
                            {{ number_format($account->transitions->sum('deposit') - $account->transitions->sum('pay'), 2) }}
                            Tk</p>
                        <button class="btn btn-sm btn-secondary invest-btn"
                                data-id="{{ $account->id }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#exampleModal">
                            <i class="bi bi-coin"></i>
                            Invest</button>
                    </div>
                </div>
            </div>
        @endforeach

        <hr>

        @foreach ($branches as $branch)
            <div class="col-md-3">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">{{ $branch->name }}</h4>
                        <p class="card-text"> <b>Sale:</b> {{ $branch->invoices->sum('total') }} Tk</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection



@push('modal')
<form action="{{ route('admin.transitions.store') }}" method="post">
    @csrf 
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Invest</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">  
                <div class="form-group col-md-12">
                  <label for="">Pay Amount</label>
                  <input type="hidden" name="account_id" id="account-id" value="1" class="form-control"> 
                  <input type="hidden" name="invoice_id" id="invoice-id" value="1" class="form-control"> 
                  <input type="number" name="deposit" id="deposit" min="1" class="form-control"> 
                </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"> <i class="bi bi-coin"></i> Deposit </button>
            </div>
          </div>
        </div>
      </div>

</form>
@endpush


@push('script')
    <script>
        $('.invest-btn').on('click', function(){
            let acId = $(this).attr('data-id');
            $('#account-id').val(acId);
        })
    </script>
@endpush