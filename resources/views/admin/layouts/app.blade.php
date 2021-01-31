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

		<!--Double navigation-->
		<header>
			<!-- Sidebar navigation -->
			<div id="slide-out" class="side-nav sn-bg-4 fixed">
				<ul class="custom-scrollbar">
					<!-- Logo -->
					<li>
						<div class="logo-wrapper waves-light">
							<a href="#"><img src="/images/EW-Logo-White.png" class="img-fluid flex-center"></a>
						</div>
					</li>
					<!--/. Logo -->

					<!-- Side navigation links -->
					<li>
						<ul class="collapsible collapsible-accordion">
							<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-plane" aria-hidden="true"></i> Trip Locations<i class="fa fa-angle-down rotate-icon"></i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="{{ route('location.create') }}">Add Trips</a></li>
										<li><a href="{{ route('location.index') }}">Edit Trip Events</a></li>
									</ul>
								</div>
							</li>
							<li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-images"></i></i> Trip Pictures<i class="fa fa-angle-down rotate-icon"></i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="{{ route('pictures.create') }}">Add Pictures</a></li>
										<li><a href="{{ route('pictures.index') }}">Edit Pictures</a></li>
									</ul>
								</div>
							</li>
							<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-users"></i> Contacts<i class="fa fa-angle-down rotate-icon"></i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="{{ route('participants.create') }}">Add New Contact</a></li>
										<li><a href="{{ route('participants.index') }}">Edit Contact</a></li>
									</ul>
								</div>
							</li>
							<li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-user" aria-hidden="true"></i> Users<i class="fa fa-angle-down rotate-icon"></i></a>
								<div class="collapsible-body">
									<ul>
										<li><a href="{{ route('admin.create') }}">Add New Admin</a></li>
										<li><a href="{{ route('admin.index') }}">Edit Admin</a></li>
									</ul>
								</div>
							</li>
							<li>
								<a href="{{ route('questions.index') }}" class="navi_option" {{ $_SERVER["SCRIPT_NAME"] == "/e2w/admin/questions.php" ? "style='font-weight:700; color:#8fba82;'" : "" }} >Questions</a>
							</li>
							{{--<li>--}}
								{{--<a href="{{ route('suggestions.index') }}" id="" class="navi_option" {{ $_SERVER["SCRIPT_NAME"] == "/e2w/admin/suggestions.php" ? "style='font-weight:700; color:#8fba82;'" : "" }} >Suggestions</a>--}}
							{{--</li>--}}
							<li>
								<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
					<!--/. Side navigation links -->
				</ul>
				<div class="sidenav-bg mask-strong"></div>
			</div>
			<!--/. Sidebar navigation -->

			<!-- Navbar -->
			<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">

				<!-- SideNav slide-out button -->
				<div class="float-left">
					<a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
				</div>

				<!-- Breadcrumb-->
				<div class="breadcrumb-dn mr-auto">
					<p>Administrator</p>
				</div>

			</nav>
			<!-- /.Navbar -->

		</header>
		<!--/.Double navigation-->

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
