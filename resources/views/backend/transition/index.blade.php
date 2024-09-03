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
                    <div class="form-check float-end">

                        <input type="date" name="" id="date" class=""> 
                        
                        <label class="form-check-label ms-4">
                            <input type="checkbox" class="form-check-input" name="" id="full-month"
                                value="checkedValue">
                            Full Month?
                        </label>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <table class="table table-bordered ">
                            <thead class="">
                                <tr>
                                    <th class="text-center" scope="col">Date</th>
                                    <th class="text-center " scope="col">A/C</th>
                                    <th class="text-center" scope="col">Challan / <br> Invoice ID</th>
                                    <th class="text-center" scope="col">Supplier /<br> Customer</th>
                                    <th class="text-center" scope="col">Deposit</th>
                                    <th class="text-center" scope="col">Pay</th>
                                </tr>
                            </thead>
                            <tbody class="transition-body-ajax">

                                @include('backend.transition.body-ajax')
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
                url: "{{ url('admin/get-transitions-by-date') }}",
                data: {date:date},
                success: function(res) {
                    $('.transition-body-ajax').empty();
                    $('.transition-body-ajax').html(res);
                }
            });
        })
    </script>
 

<script>
    $('#full-month').on('click', function(){
    
         if (this.checked) {
            $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-this-month-transition') }}",
                    data: '',
                    success: function(res) {
                        $('.transition-body-ajax').empty();
                        $('.transition-body-ajax').html(res);
                    }
                });
         } else {
            $.ajax({
                    type: "GET",
                    url: "{{ url('admin/get-today-transitions') }}",
                    data: '',
                    success: function(res) {
                        $('.transition-body-ajax').empty();
                        $('.transition-body-ajax').html(res);
                    }
                });
         }
    
    })
</script>


@endpush
