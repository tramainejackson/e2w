@extends('layouts.app')

	@section('styles')
		<style type="text/css">

			/*Smartphones portrait*/
			@media only screen and (max-width:575px) {
				div#app {
					background: initial;
				}

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
	@endsection

	@section('content')

		<div class="col-11 col-sm-8 mx-auto align-self-center">

			<h2 class="white-text text-center m-0 p-5 d-xl-none" style=" font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>About Us</b></h2>

			<h2 class="underline d-none d-xl-block p-5 display-3 text-center">About Us</h2>

			<p id="about_us_div" class="rounded d-none">
				Here at EastCoast to WestCoast Travel, we have the ultimate family oriented experience because that's how we got started.  A group of friends decided that we wanted to travel and see the world. And who better to do that with than the closest people to you. So tell a brother, sister, cousin, friend, co-worker or whoever you think you would have the most fun with. And we're never short of activities. Check out the upcoming trips we have on the East and West coast and see what activites we have planned for each trip. Don't forget to sign up for the one you would be most interested in. Hope you decide to come along for the ride.
			</p>

			<p id="" class="white text-black p-3 rounded">
				Here at EastCoast to WestCoast Travel, we have the ultimate family oriented experience because that's how we got started.  A group of friends decided that we wanted to travel and see the world. And who better to do that with than the closest people to you. So tell a brother, sister, cousin, friend, co-worker or whoever you think you would have the most fun with. And we're never short of activities. Check out the upcoming trips we have on the East and West coast and see what activites we have planned for each trip. Don't forget to sign up for the one you would be most interested in. Hope you decide to come along for the ride.
			</p>

		</div>

	@endsection