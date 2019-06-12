<nav class="navbar navbar-expand-xl navbar-dark primary-color mobileNavBar">

	<div class="d-flex flex-fill" id="">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</button>

		<a class="navbar-brand d-none d-xl-block" href="/"><img src="/images/EW-Logo-White.png" class="img-fluid mx-auto" width="50px" /></a>
		<a class="navbar-brand d-xl-none" href="/"><img src="/images/E2W_Header.png" class="img-fluid mx-auto" /></a>
	</div>

	<div class="collapse multi-collapse navbar-collapse" id="navbarToggler">

		@if(!Auth::check())

			<ul class="navbar-nav w-100 mt-2 mt-xl-0 text-center align-items-center justify-content-around">

				<li class="nav-item{{ strlen(request()->getPathInfo()) < 2 ? ' active' : '' }}">
					<a class="nav-link" href="/">Home</a>
				</li>

				<li class="nav-item d-xl-none{{ strlen(request()->getPathInfo()) < 2 ? ' active' : '' }}">
					<a class="nav-link" href="/">Upcoming Trips <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item d-xl-none{{ substr_count(request()->getPathInfo(), 'past') > 0 ? ' active' : '' }}">
					<a class="nav-link" href="/past">Past Trips</a>
				</li>

				<li class="nav-item{{ substr_count(request()->getPathInfo(), 'picture') > 0 || substr_count(request()->getPathInfo(), 'photo') > 0 ? ' active' : '' }}">
					<a class="nav-link" href="/photos">Photos</a>
				</li>

				<li class="nav-item{{ substr_count(request()->getPathInfo(), 'contact_us') > 0 ? ' active' : '' }}">
					<a class="nav-link" href="/contact_us">Contact Us</a>
				</li>

				<li class="nav-item{{ substr_count(request()->getPathInfo(), 'about_us') > 0 ? ' active' : '' }}">
					<a class="nav-link" href="/about_us">About Us</a>
				</li>

				{{--<li class="nav-item">--}}
					{{--<a class="nav-link" href="/suggestions">Suggestions</a>--}}
				{{--</li>--}}

				<li class="nav-item{{ substr_count(request()->getPathInfo(), 'login') > 0 ? ' active' : '' }}">
					<a class="nav-link" href="/login">Login</a>
				</li>

			</ul>

		@else

			<ul class="navbar-nav w-100 mt-2 mt-xl-0 text-center align-items-center justify-content-around">

				<li class="nav-item">
					<a href="{{ route('location.index') }}" id="" class="nav-link">Trip Locations</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('pictures.index') }}" id="" class="nav-link">Trip Pictures</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('admin.index') }}" id="" class="nav-link">Users</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('questions.index') }}" class="nav-link">Questions</a>
				</li>

				{{--<li class="nav-item">--}}
					{{--<a href="{{ route('suggestions.index') }}" id="" class="nav-link">Suggestions</a>--}}
				{{--</li>--}}

				<li class="nav-item">
					<a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
					
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>

				</li>

			</ul>

		@endif

	</div>

</nav>