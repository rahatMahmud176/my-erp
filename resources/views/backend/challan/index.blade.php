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
                    <a href="{{ route('admin.challans.index') }}" class="btn btn-sm btn-secondary  float-end">
                        <i class="bi bi-plus-circle"></i>
                        Add Challan</a>
                </div>

                <div class="row"> 

                    <div class="col-md-12">
                        <table class="table table-bordered ">
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
                                           todo 
                                            @if ($challan->deletable == true)
                                                <a href="#" onclick="challanDelete({{ $challan->id }})"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                    View</a>

                                                    <a href="{{ route('admin.challans.edit', $challan) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Edit
                                                </a>

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



@push('script')
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
