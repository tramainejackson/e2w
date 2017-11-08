@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="admin_page">
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			
			@include('layouts.admin_nav')
			
			<?php if(isset($_GET["view_gallery"])) { ?>
				<div class="maine_overlay_pictures">
					<button class="closeBtn">X</button>
				</div>
				<div class="maine_modal_picture">
					<?php $getLocation = find_event_by_name(str_ireplace("_", " ", $_GET["view_gallery"])); ?>
					<?php $getPictures = find_all_pictures_by_id($getLocation["trip_id"]); ?>
					@if($getPictures->count() > 0)
						<div class="picture_modal_content">
							<div id="<?php echo str_ireplace(" ", "_", strtolower($getLocation["trip_location"])); ?>_pictures">
								<?php while($showPicture = mysqli_fetch_assoc($getPictures)) { ?>
									<h2 class="pictureCaption"><?php echo $showPicture["picture_caption"] ?></h2>
									<img  src="images/<?php echo $showPicture["picture_name"] ?>" id="<?php echo $showPicture["picture_id"] ?>" class="<?php echo str_ireplace(" ", "_", strtolower($getLocation["trip_location"])); ?>_picture" />
								<?php } ?>
							</div>
							<button class="prevLeft"><span class="spanArrow">&#8672;</span>Prev</button>
							<button class="nextRight">Next<span class="spanArrow">&#8674;</span></button>
							<p class="additionalPictures">If you have any pictures or videos that you want posted, please send them to <a class="mailToLink" href="mailto:administrator@eastcoast2westcoast.com?subject=<?php echo str_ireplace(" ", "_", ucwords($getLocation["trip_location"])); ?>_Pictures">administrator@eastcoast2westcoast.com</a></p>
						</div>
					<?php } else { ?>
						<div class="pictureModalNoContent">
							<div id="<?php echo str_ireplace(" ", "_", strtolower($getLocation["trip_location"])); ?>_pictures">
								<h2>No pictures have been added yet for this trip</h2>
							</div>
							<p class="additionalPictures">If you have any pictures or videos that you want posted, please send them to <a class="mailToLink" href="mailto:administrator@eastcoast2westcoast.com?subject=<?php echo str_ireplace(" ", "_", ucwords($getLocation["trip_location"])); ?>_Pictures">administrator@eastcoast2westcoast.com</a></p>
						</div>	
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	@endsection