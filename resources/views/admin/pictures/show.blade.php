@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')		
		<div class="maine_overlay_pictures">
			<button class="closeBtn">X</button>
		</div>
		<div class="maine_modal_picture">
			@if($getPictures->count() > 0)
				<div class="picture_modal_content">
					<div id="trip_location_pictures">
						@foreach($getPictures as $showPicture)
							<h2 class="pictureCaption">{{ $showPicture->picture_caption }}</h2>
							<img  src="images/{{ $showPicture->picture_name }}" id="{{ $showPicture->picture_id }}" class="" />
						@endforeach
					</div>
					<button class="prevLeft"><span class="spanArrow">&#8672;</span>Prev</button>
					<button class="nextRight">Next<span class="spanArrow">&#8674;</span></button>
					<p class="additionalPictures">If you have any pictures or videos that you want posted, please send them to <a class="mailToLink" href="mailto:administrator@eastcoast2westcoast.com?subject=<?php echo str_ireplace(" ", "_", ucwords($showPicture->trip_id)); ?>_Pictures">administrator@eastcoast2westcoast.com</a></p>
				</div>
			@else
				<div class="pictureModalNoContent">
					<div id="trip_location_pictures">
						<h2>No pictures have been added yet for this trip</h2>
					</div>
					<p class="additionalPictures">If you have any pictures or videos that you want posted, please send them to <a class="mailToLink" href="mailto:administrator@eastcoast2westcoast.com?subject=Trip_Location_Pictures">administrator@eastcoast2westcoast.com</a></p>
				</div>	
			@endif
		</div>
	@endsection