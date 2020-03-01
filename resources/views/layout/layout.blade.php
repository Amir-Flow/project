
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"class="no-js" dir="{{ app()->getLocale() === "en"  ? 'ltr' :'rtl' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <title>مغاسل الرهدن | Alrahden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="مغاسل الرهدن">
    <meta name="keywords" content="مغاسل الرهدن">
    <meta name="author" content="">
    <meta name="description" content="مغاسل الرهدن | Alrahden ">
    <meta property="og:title" content="مغاسل الرهدن | Alrahden" />
    <meta property="og:description" content="مغاسل الرهدن | Alrahden" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	
	@yield('aimeos_header')

    
{{-- here  --}}

<!-- here -->
<link rel="stylesheet" href="{{ asset('assets/fonts/font/stylesheet-font.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/daterangepicker.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css') -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
	@yield('aimeos_styles')

	<link type="text/css" rel="stylesheet" href='https://fonts.googleapis.com/css?family=Roboto:400,300'>
	<link type="text/css" rel="stylesheet" href="/css/app.css">

</head>
<body>

@include('partials.navbar')

	<div class="main-web">

        @include("partials.messages")
     

		@yield('aimeos_stage')
		@yield('aimeos_body')
		@yield('aimeos_aside')
		@yield('content')
	</div>
    @if (Auth::check())
    {{-- show logged in navbar --}}
  @else

        @include('partials.authenticate')

  @endif

@include('partials.contact')


 @include('partials.footer')

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/datepicker/moment.min.js')  }}"></script>
    <script src="{{ asset('assets/datepicker/daterangepicker.js')  }}"></script>
    <!-- <script src="{{ asset('assets/js/bootstrap-datepicker.min.js')  }}"></script> -->
    <script src="{{ asset('assets/js/wow.js')  }}"></script>
    <script src="{{ asset('assets/js/custom.js')  }}"></script>






	@yield('aimeos_scripts')

	</body>
</html>