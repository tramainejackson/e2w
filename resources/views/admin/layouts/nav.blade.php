<!--Double navigation-->
<header>
	<!-- Sidebar navigation -->
	<div id="slide-out" class="side-nav sn-bg-4 fixed adminNav">
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