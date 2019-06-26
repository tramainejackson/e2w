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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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

<body>

    <div id="app">

		{{--@include('modals.questions')--}}
		{{--@include('modals.suggestions')--}}

		@if(session('status'))
			<h2 class="flashMessage text-center">{{ session('status') }}</h2>
		@endif

		@if(session('error'))
			<h2 class="errorMessage text-center">{{ session('error') }}</h2>
		@endif

		<div class="modal fade loadingSpinner">

			<div class="loader"></div>

			<div class="">
				<p class="text-white d-table mx-auto"></p>
			</div>

		</div>

		<div id="main_content" class="container-fluid">

			<div class="row">

				<div class="col-12 px-0">

					@include('layouts.mobile_nav')

				</div>

				{{-- Page Content--}}
				@yield('content')

			</div>

		</div>

	</div>

	<footer class="page-footer">

		<!-- Copyright -->
		<div class="footer-copyright text-center py-3">© 2014 Copyright:
			<a href="https://tramaine.atstmpllc.com"> ATSTMPLLC.com</a>
		</div>
		<!-- Copyright -->

	</footer>

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>

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
