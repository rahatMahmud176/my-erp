@extends('backend.master')
@section('title')
    Suppliers
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Suppliers</h3>
                    <input type="text" class=" float-end search-supplier" placeholder="Search by Name">
                </div>

                <div class="row">
                    <div class="col-md-3">



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('admin.suppliers.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Mr."
                                    aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for=""></label>
                                <input type="number" name="phone_number" id="" class="form-control"
                                    placeholder="015********" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-secondary container-fluid mt-3">Submit </button>
                            </div>

                        </form>
                    </div>

                    <div class="col-md-9">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col"> Due </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($suppliers as $key => $supplier)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone_number }}</td>

                                        <td>
                                            {{ number_format($supplier->transitions->sum('due') - $supplier->transitions->sum('deposit'), 2) }}
                                            (new) <br>
                                            {{ number_format($supplier->challans->sum('total') - $supplier->challans->sum('pay'), 2) }}
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-success pay-button" data-id="{{ $supplier->id }}"
                                                data-bs-toggle="modal" data-bs-target="#payModal"> Pay</a>
                                            <a href="#" class="btn btn-sm btn-success adjust-button" data-id="{{ $supplier->id }}" data-bs-toggle="modal"
                                                data-bs-target="#adjustModal"> Adjust</a>
                                            <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                                Edit
                                            </a>

                                            <a href="{{ route('admin.suppliers.show', $supplier) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="bi bi-eye"></i>
                                                View
                                            </a>

                                            {{-- <a href="#" onclick="supplierDelete({{ $supplier->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3-fill"></i>
                                                    Delete</a>

                                                <form id="deleteSupplierForm{{ $supplier->id }}"
                                                    action="{{ route('admin.suppliers.destroy', $supplier) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                </form> --}}


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
    <!-- Pay Modal -->
    <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form action="{{ route('admin.direct-payment') }}" method="post"> 
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                      <label for="">Amount</label>
                      <input type="text" name="pay" id="" class="form-control" placeholder="0.00" aria-describedby="helpId">
                      <input type="hidden" name="supplier_id" id="supplier_id">
                     </div>

                    <div class="form-group mt-3">
                      <label for="">From A/c:</label>
                        <select class="form-control" name="account_id" id="">
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->ac_title }} </option>
                            @endforeach
                        </select>
                    </div>
 
                    <div class="form-group mt-3">
                      <label for="">Note</label>
                        <textarea class="form-control" placeholder="write note here......." name="note"></textarea>
                    </div>
 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pay</button>
                </div> 
            </form>

            </div>
        </div>
    </div>
    <!-- Adjust Modal -->
    <div class="modal fade" id="adjustModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.direct-due-increase') }}" method="post"> 
                    @csrf
                    <div class="modal-body">
    
                        <div class="form-group">
                          <label for="">Deu Increase</label>
                          <input type="text" name="due" id="" class="form-control" placeholder="0.00" aria-describedby="helpId">
                          <input type="hidden" name="supplier_id" class="supplier_id" >
                         </div> 
     
                        <div class="form-group mt-3">
                          <label for="">Note</label>
                            <textarea class="form-control" placeholder="write note here......." name="note"></textarea>
                        </div> 
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pay</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
@endpush




@push('script')

<script>
    $('.pay-button').on('click', function(){
        let id = $(this).attr('data-id');
        $('#supplier_id').val(id);
    })
</script>
<script>
    $('.adjust-button').on('click', function(){
        let id = $(this).attr('data-id');
        $('.supplier_id').val(id);
    })
</script>


    <script>
        function supplierDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonSupplier: "#3085d6",
                cancelButtonSupplier: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteSupplierForm' + id).submit();
                }
            });
        }
    </script>
@endpush
