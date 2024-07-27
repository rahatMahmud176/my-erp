<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('backend.includes.styles')
 
</head>

<body class="body">

  <!-- ======= Header ======= -->

  @include('backend.includes.header')
  
  
  <div class="mt-5 row">
    @yield('content')
  </div>

  <!-- ======= Footer ======= -->
@include('backend.includes.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


@include('backend.includes.scripts')


@stack('modal')
 

</body>

</html>