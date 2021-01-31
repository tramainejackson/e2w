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
	<link href="https://fonts.googleapis.com/css?family=Felipa" rel="stylesheet">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="/css/e2w_2.css" rel="stylesheet">

	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="/css/myIEcss.css" rel="stylesheet">
	@endif

	@yield('styles')

</head>

<body class="fixed-sn cyan-skin">

	<div id="app">

		<!--Navigation-->
		@include('admin.layouts.nav')

		<!--Main Layout-->
		<main id="admin_page">

			@if(session('status'))
				<h2 class="flashMessage d-none">{{ session('status') }}</h2>
			@endif

			@if(session('error'))
				<h2 class="errorMessage d-none">{{ session('error') }}</h2>
			@endif

			<div class="container-fluid">

				@yield('content')

			</div>

		</main>
		<!--Main Layout-->

		<div class="modal fade loadingSpinner">

			<div class="loader"></div>

			<div class="">
				<p class="text-white d-table mx-auto"></p>
			</div>

		</div>

	</div>

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

	@yield('scripts')

</body>
</html>
