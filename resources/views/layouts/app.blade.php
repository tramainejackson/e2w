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
    @yield('styles')
	
	<!-- Scripts -->
	@yield('scripts')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
