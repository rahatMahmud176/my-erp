@extends('backend.master')
@section('title')
    Transitions
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Transitions</h3>
                    <a href="{{ route('admin.transitions.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Transition</a>
                </div>

                <div class="row"> 

                    <div class="col-md-12">
                        <table class="table table-bordered ">
                            <thead class="">
                                <tr> 
                                    <th class="text-center" scope="col">Date</th> 
                                    <th class="text-center" scope="col">A/C</th> 
                                    <th class="text-center" scope="col">Challan ID</th> 
                                    <th class="text-center" scope="col">Supplier</th> 
                                    <th class="text-center" scope="col">Deposit</th>
                                    <th class="text-center" scope="col">Pay</th> 
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($transitions as $key => $transition)
                                    <tr>
                                        <td>{{ date("d-M-y" , strtotime($transition->created_at)) }}</td> 
                                        <td class="text-center"><a href="#">{{ $transition->account->ac_title }}</a></td>
                                        <td class="text-center"><a href="#">#Challan:{{ $transition->challan_id }}</a></td>
                                        <td class="text-center"><a href="#">{{ $transition->challan->supplier->name }}</a></td>
                                        <td class="text-success text-center">{{ number_format($transition->deposit, 2) }}</td>
                                        <td class="text-success text-center">{{ number_format($transition->pay, 2) }}</td> 
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



@push('script')
    <script>
        function transitionDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonTransition: "#3085d6",
                cancelButtonTransition: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteTransitionForm' + id).submit();
                }
            });
        }
    </script>
@endpush
