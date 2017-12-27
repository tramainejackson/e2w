@php $agent = new Jenssegers\Agent\Agent(); @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('Title', 'E<>W')</title>

    <!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Felipa" rel="stylesheet">
    @yield('styles')
	<style>
		@media only screen and (max-width: 575px) {
			div#app:after {
				content: "";
				position: fixed;
				background-image: url(/images/Jacksonville_Skyline_Night_Panorama_Digon3.jpg);
				background-size: cover;
				background-position: center center;
				background-repeat: no-repeat;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				z-index: -1;
			}
		}
	</style>
	
	@if(substr_count(request()->server('HTTP_USER_AGENT'), 'rv:') > 0)
		<link href="/css/myIEcss.css" rel="stylesheet">
	@endif
	
	<!-- Scripts -->
	@yield('scripts')
</head>
<body>
    <div id="app">
		<div class="modal fade loadingSpinner">
			<div class="loader"></div>
			<div class="">
				<p class="text-white d-table mx-auto"></p>
			</div>
		</div>
		
		<div id="admin_page" class="container-fluid">
			@if(session('status'))
				<h2 class="flashMessage text-center">{{ session('status') }}</h2>
			@endif
			@if(session('error'))
				<h2 class="errorMessage text-center">{{ session('error') }}</h2>
			@endif
			
			<div class="row">
				<div class="col px-0 d-none d-xl-block">
					<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
				</div>
				<div class="d-xl-none">
					@include('layouts.mobile_nav')
				</div>
			</div>
			
			
			<div class="adminDiv container" id="">
				<div class="row" style="">
					<div class="col-3 d-none d-xl-block">
						@include('admin.layouts.nav')
					</div>
					<div class="col-12 col-xl-9" style="overflow:hidden;">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
    </div>
</body>
</html>
