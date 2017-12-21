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
				<div class="col px-0">
					<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
				</div>
			</div>
			
			@include('admin.layouts.nav')
			
			<div class="adminDiv container" id="" style="margin-left: 25%; margin-right: 0%;">
				@yield('content')
			</div>
		</div>
    </div>
</body>
</html>
