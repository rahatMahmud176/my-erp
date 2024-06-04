@extends('backend.master')
@section('title')
    Setting Edit
@endsection
@section('content')
    <div class="row">
        <div class="card text-left">
            <div class="card-body">

                <div class="mt-3 clearfix">
                    <h3 class="float-start">#Setting Edit</h3>
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-sm btn-danger  float-end">
                        Cancel</a>
                </div>

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.setting.update',1) }}" method="post" class="row">
                            @csrf 
                            @method('PUT')

                            <div class="form-check form-switch col-6">
                                <input class="form-check-input" name="color" value="1" type="checkbox" role="switch" id="color"
                                    {{ $setting->color ?'checked':'' }}>
                                <label class="form-check-label" for="color">Use Color Variant</label>
                            </div>


                            <div class="form-check form-switch col-6">
                                <input class="form-check-input" name="size" value="1" type="checkbox" role="switch" id="size"
                                {{ $setting->size ?'checked':'' }}>
                                <label class="form-check-label" for="size">Use Size Variant</label>
                            </div>


                            <div class="form-check form-switch col-6">
                                <input class="form-check-input" name="country" value="1" type="checkbox" role="switch" id="country"
                                {{ $setting->country ?'checked':'' }}>
                                <label class="form-check-label" for="country">Use Country Variant</label>
                            </div> 

                            <div class="form-check form-switch col-6">
                                <input class="form-check-input" name="sub_unit" value="1" type="checkbox" role="switch" id="sub_unit"
                                {{ $setting->sub_unit ?'checked':'' }}>
                                <label class="form-check-label" for="sub_unit">Use Sub-Unit Variant</label>
                            </div>

                            <div class="form-check form-switch col-6">
                                <input class="form-check-input" name="serial_number" value="1" type="checkbox" role="switch" id="sl_number"
                                {{ $setting->serial_number ?'checked':'' }}>
                                <label class="form-check-label" for="sl_number">Use SL / IMEI No.</label>
                            </div>

                            <div class="form-check form-switch col-6 manage_qty_by_imei_div">
                                <input  class="form-check-input"  name="qty_manage_by_serial" value="1" type="checkbox" role="switch" id="manage_qty_by_imei"
                                {{ $setting->qty_manage_by_serial ?'checked':'' }}>
                                <label class="form-check-label" for="manage_qty_by_imei">Manage Quantity By SL / IMEI No.</label>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary container-fluid mt-3">Update </button>
                            </div>

                        </form>
                    </div>

                </div>



            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>  

        $(document).ready(function(){
            if ($('#sl_number').is(':checked')) {
               
            }else{
                $('#manage_qty_by_imei').prop('checked', false); 
                $('#manage_qty_by_imei').attr('disabled', true);
            }
        }) 
        $('#sl_number').on('change', function(){
            if(this.checked){
                $('.manage_qty_by_imei_div').show() 
                $('#manage_qty_by_imei').attr('disabled', false);
            }else{ 
                $('#manage_qty_by_imei').prop('checked', false); 
                $('.manage_qty_by_imei_div').hide();
            }
        })
    </script>
@endpush