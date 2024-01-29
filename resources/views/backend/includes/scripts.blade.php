<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

 {{-- <script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.js"></script> 
<script src="{{ asset('/') }}backend/assets/vendor/bootstrap/js/bootstrap.min.js"></script>  --}}

{{-- ize toast  --}}
<script src="{{ asset('js/iziToast.js') }}"></script>
{{-- sweetalert2  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
<script src="{{ asset('/') }}backend/assets/js/main.js"></script>

@include('vendor.lara-izitoast.toast')

@stack('script')

 