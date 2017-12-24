<nav class="navbar navbar-expand-md w-100 mobileNavBar d-md-block d-flex">
	<a class="navbar-brand w-100" href="/"><img src="/images/E2W_Header.png" class="img-fluid mx-auto d-inline-block d-md-block" /></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
	<span class="oi oi-menu"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarToggler">
		<ul class="navbar-nav w-100 mt-2 mt-md-0 text-center align-items-center justify-content-around d-none d-xl-block">
			<li class="nav-item active">
				<a class="nav-link" href="/">Upcoming Trips <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/past">Past Trips</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/photos">Photos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/contact_us">Contact Us</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/about_us">About Us</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/suggestion">Suggestions</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/login">Login</a>
			</li>
		</ul>
		<ul class="navbar-nav w-100 mt-2 mt-md-0 text-center align-items-center justify-content-around d-xl-none">
			<li>
				<a href="{{ route('location.index') }}" id="" class="navi_option" <?php echo isset($_GET["edit_trip"]) || isset($_GET["locations"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Locations</a>
			</li>
			<li>
				<a href="{{ route('pictures.index') }}" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/pictures.php" && !isset($_GET["add_pictures"]) && !isset($_GET["remove_pictures"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Trip Pictures</a>
			</li>
			<li>
				<a href="{{ route('admin.index') }}" id="" class="navi_option" <?php echo isset($_GET["admin"]) ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Users</a>
			</li>
			<li>
				<a href="{{ route('questions.index') }}" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/questions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Questions</a>
			</li>
			<li>
				<a href="{{ route('suggestions.index') }}" id="" class="navi_option" <?php echo $_SERVER["SCRIPT_NAME"] == "/e2w/admin/suggestions.php" ? "style='font-weight:700; color:#8fba82;'" : ""; ?> >Suggestions</a>
			</li>
			<li>
				<a href="{{ route('logout') }}" class="navi_option" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
				
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</div>
</nav>