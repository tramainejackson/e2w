@php $agent = new Jenssegers\Agent\Agent(); @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="shortcut icon" href="/images/EW-Logo.ico" type="image/x-icon">
	<link rel="icon" href="/images/EW-Logo.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Eastcoast2Westcoast')</title>

    <!-- Styles -->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

	<!-- Bootstrap core CSS -->
	<link type="text/css" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link type="text/css" href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">

	@if(substr_count(request()->getPathInfo(), 'question') > 0 || substr_count(request()->getPathInfo(), 'contacts') > 0)
		<link type="text/css" src="/css/addons/datatables.min.css" rel="stylesheet">
	@endif

	<!-- Custom CSS -->
	<link type="text/css" href="/css/e2w_2.css" rel="stylesheet">

	@if(strlen(request()->getPathInfo()) > 1)
		<style type="text/css">
			 .navbar, .top-nav-collapse {
				background-color: #4285f4;
			}
		</style>
	@endif

	@yield('styles')
</head>

<body class="{{ Auth::check() ? 'fixed-sn cyan-skin' : '' }}">

	@if(session('status'))
		<h2 class="flashMessage d-none">{{ session('status') }}</h2>
	@endif

	@if(session('error'))
		<h2 class="errorMessage d-none">{{ session('error') }}</h2>
	@endif

	@include('modals.loading')

	<div id="app">

		<!--Navigation-->
		@include('content_parts.nav')

		<!--Main Layout-->
		<main id="main_content" class="container-fluid">

			<div class="row">

				@if(Auth::guest())
					<div class="col-12 mt-5 mb-n2" id="">
						<h1 class="font-weight-bold text-uppercase h1 text-center mt-5 coolText4 webHeader">Eastcoast Westcoast Travel</h1>
					</div>
				@endif

				{{-- Page Content--}}
				@yield('content')

			</div>
		</main>
	</div>

	@if(!Auth::check())
		@include('content_parts.footer')
	@endif

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="/js/jquery.min.js"></script>

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="/js/popper.min.js"></script>

	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>

	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="/js/mdb.min.js"></script>
	<script type="text/javascript" src="/js/eastwest_2.js"></script>

	@if(substr_count(request()->getPathInfo(), 'question') > 0 || substr_count(request()->getPathInfo(), 'contacts') > 0)
		<script type="text/javascript" src="/js/addons/datatables.min.js"></script>
	@endif

	@if(session('status'))
		<script type="text/javascript">
            // Display a success toast
            toastr.success($('h2.flashMessage').text());
		</script>
	@endif

	@if(session('error'))
		<script type="text/javascript">
            // Display a error toast
            toastr.error($('h2.errorMessage').text());
		</script>
	@endif

	@yield('scripts')

</body>
</html>
