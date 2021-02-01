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

<body class="{{ Auth::check() ? 'fixed-sn cyan-skin' : '' }}">

	@if(session('status'))
		<h2 class="flashMessage d-none">{{ session('status') }}</h2>

		@section('scripts')
			<script type="text/javascript">
				// Display a success toast
				toastr.success($('h2.flashMessage').text());
			</script>
		@endsection
	@endif

	@if(session('error'))
		<h2 class="errorMessage d-none">{{ session('error') }}</h2>

		@section('scripts')
			<script type="text/javascript">
				// Display a error toast
				toastr.error($('h2.errorMessage').text());
			</script>
		@endsection
	@endif

	@include('modals.loading')

	<div id="app">

		@if(Auth::check())

			<!--Navigation-->
			@include('content_parts.admin_nav')

			<!--Main Layout-->
			<main id="admin_page">

				<div class="container-fluid">

					{{-- Page Content--}}
					@yield('content')

				</div>
			</main>

		@else

			<div id="main_content" class="container-fluid">

				<div class="row">

					<div class="col-12 px-0">

						<!--Navigation-->
						@include('content_parts.nav')
					</div>

					{{-- Page Content--}}
					@yield('content')

				</div>
			</div>

		@endif

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

	@yield('scripts')

</body>
</html>
