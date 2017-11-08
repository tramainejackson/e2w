@if($getPictures->count() > 0)
	<div class="picture_modal_content" style="display:none">
		<div id="trip_location_pictures">
			@foreach($getPictures as $showPicture)
				<a href="images/{{ $showPicture->picture_name }}" id="{{ $showPicture->picture_id }}" class="tripPictures" title="{{ $showPicture->picture_caption }}"></a>
			@endforeach
		</div>
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