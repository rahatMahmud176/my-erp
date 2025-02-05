@extends('backend.master')
@section('title')
    Supplier Transitions
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Transitions (Supplier)</h3>
                    <div class="form-check float-end">

                        <input type="date" name="" id="date" class="me-5">


                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="" id="full-month"
                                value="checkedValue">
                            Full month?
                        </label>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <table class="table table-bordered ">
                            <thead class="">
                                <tr>
                                    <th class="text-center" scope="col">Date</th>
                                    {{-- <th class="text-center" scope="col">Challan ID</th> --}}
                                    <th class="text-center" scope="col">Supplier</th>
                                    <th class="text-center" scope="col">Deposit</th>
                                    <th class="text-center" scope="col">Due</th>
                                </tr>
                            </thead>
                            <tbody class="transition-supplier-body">

                                @include('backend.transition-supplier.ajax-body')


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


    <script>
        $('#date').on('change', function() {
            let date = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ url('admin/get-supplier-transition-by-date') }}",
                data: {
                    date: date
                },
                success: function(res) {
                    $('.transition-supplier-body').empty();
                    $('.transition-supplier-body').html(res);
                }
            });

        })
    </script>


    <script>
        $('#full-month').on('click', function() {
            if (this.checked) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-this-month-supplier-transition') }}",
                    data: '',
                    success: function(res) {
                        // console.log(res); 
                        $('.transition-supplier-body').empty();
                        $('.transition-supplier-body').html(res);
                    }
                });
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-today-supplier-transition') }}",
                    data: '',
                    success: function(res) {
                        // console.log(res); 
                        $('.transition-supplier-body').empty();
                        $('.transition-supplier-body').html(res);
                    }
                });
            }
        });
    </script>
@endpush
