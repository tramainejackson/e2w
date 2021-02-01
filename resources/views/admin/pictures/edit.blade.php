@extends('layouts.app')

	@section('content')

		<div id="" class="row">

			<div class="col-12">
				<div class="">
					<h2 class="display-3">{{ $trip->trip_location }}</h2>
				</div>
			</div>

			<div class="col-12" id="">

				<form name="" id="edit_picture_form" class="pictureForm" action="/pictures/{{ $trip->id }}" method="POST" enctype="multipart/form-data">

					{{ method_field('PATCH') }}
					{{ csrf_field() }}

					<div class="md-row">
						<button type="submit" class="btn btn-secondary btn-lg ml-3">Update All</button>

						<div class="container-fluid" id="">

							<div class="row" id="">

								@foreach($getPictures as $picture)

									@php $content = Storage::disk('local')->has($picture->picture_name); @endphp

									<div class="col-4 animated">

										<div class="card my-2">

											<img src="{{ $content == true ? asset('storage/' . str_ireplace('public/', '', $picture->picture_name)) : '/images/skyline.jpg' }}" class="card-img-top" alt="{{ $picture->picture_caption }}" style="" />

											<div class="card-body">

												<div class="md-form" id="">
													<input type="text" name="picture_caption[]" class="form-control" value="{{ $picture->picture_caption }}" placeholder="Enter Caption" />
													<label class="card-title">Picture Caption</label>
												</div>

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

					</div>

				</form>

			</div>

		</div>

	@endsection