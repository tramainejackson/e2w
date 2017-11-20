@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="admin_page">
			@if(session('status'))
				<h2 class="flashMessage">{{ session('status') }}</h2>
			@endif
			
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			
			@include('layouts.admin_nav')
			
			<div class="adminDiv" id="">
				<form name="" id="add_picture_form" class="pictureForm" action="/pictures/{{ $trip->id }}" method="POST" enctype="multipart/form-data">
				
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<div class="text-white d-flex align-items-center">
									<h2 class="display-3">{{ $trip->trip_location }}</h2>
									<input type="submit" name="submit" class="btn btn-secondary btn-lg ml-3" value="Update All" />
								</div>
							</div>
						</div>
						<div class="row">
							@foreach($getPictures as $picture)
								@php $content = Storage::disk('local')->has($picture->picture_name); @endphp
								<div class="col-4">
									<div class="card my-2">
										<img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/skyline.jpg' }}" class="card-img-top" alt="{{ $picture->picture_caption }}" style="" />
										<div class="card-body">
											<h4 class="card-title">Pictrue Caption</h4>
											<input type="text" name="picture_caption[]" class="rounded d-block border-0" value="{{ $picture->picture_caption }}" placeholder="Enter Caption" />
											<input type="text" name="picture_id[]" class="" value="{{ $picture->id }}" hidden />
										</div>
										<div class="card-footer">
											<button class="btn btn-danger mx-auto d-block" onclick="event.preventDefault(); removePicture({{ $picture->id }});">Remove Picture</button>
										</div>
									</div>								
								</div>
							@endforeach
						</div>
					</div>
				</form>
			</div>
		</div>
	@endsection