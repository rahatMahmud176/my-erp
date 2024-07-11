{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

 {{-- <script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.js"></script> 
<script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.min.js"></script>  --}}

{{-- ize toast  --}}
<script src="{{ asset('js/iziToast.js') }}"></script>
{{-- sweetalert2  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
<script src="{{ asset('/') }}backend/assets/js/main.js"></script>
{{-- // toster  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



@include('vendor.lara-izitoast.toast')



@stack('script')

 