$(document).ready(function() {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
	// Height of navigate
	
	
	// Collapse Button For Mobile
	$(".button-collapse").sideNav();
	
	// Full Width Carousel For Upcoming Trips
	$('.carousel.carousel-slider').carousel({
		fullWidth: true,
		duration: 0
	});
});