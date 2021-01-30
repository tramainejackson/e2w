@extends('layouts.app')

	@section('styles')
		<style type="text/css">
			#main_content > .row {
				min-height: 100vh;
			}
		</style>
	@endsection

	@section('content')
				
		<div class="col-12 white-text text-center m-0 p-5 d-xl-none">
			<h2 class="" style=" font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Trip Suggestions</b></h2>
		</div>

		<div class="col-12 underline d-none d-xl-block p-5 text-center">
			<h2 class="display-3">Trip Suggestions</h2>
		</div>

		<div class="col-12">

			<div class="container-fluid">

				<div class="row justify-content-around">

					<div class="col-12 col-md-10 col-lg-5 my-2 suggestionMobile">

						<div class="">
							<h2 class="text-center text-light">Where to next?</h2>
						</div>

						<form id="suggestion_form1" action="/suggestions" method="POST">

							{{ method_field('POST') }}
							{{ csrf_field() }}

							<div class="form-check">
								<input class="nextLocation form-check-input" id="niagra_falls" type="radio" name="next_location" value="Niagra Falls" />
								<label class="form-check-label" for="niagra_falls">Niagra Falls</label>
							</div>

							<div class="form-check">
								<input class="nextLocation form-check-input" id="toronto" type="radio" name="next_location" value="Toronto" />
								<label class="form-check-label" for="toronto">Toronto</label>
							</div>

							<div class="form-check">
								<input class="nextLocation form-check-input" id="dc" type="radio" name="next_location" value="DC" />
								<label class="form-check-label" for="dc">Washington D.C.</label>
							</div>

							<div class="form-check">
								<input class="nextLocation form-check-input" id="miami" type="radio" name="next_location" value="Miami" />
								<label class="form-check-label" for="miami">Miami</label>
							</div>

							<div class="form-check">
								<input class="nextLocation form-check-input" id="houston" type="radio" name="next_location" value="Houston" />
								<label class="form-check-label" for="houston">Houston</label>
							</div>

							<input type="submit" id="submit_suggestion" class="btn primary-color m-4" value="Send Suggestion" onclick="sendSuggestion();" />

						</form>

					</div>

					<div class="col-12 col-md-10 col-lg-5 my-2" id="suggestion_results_div">

						<div id="suggestion_results_header">
							<h2 class="text-center">Suggestions as of <span class="text-center">{{ $date->format('m/d/Y') }}</span></h2>
						</div>

						<div class="suggestionResultsPercent">
							@foreach($getLocations as $showLocations)

								@php $getRows = DB::table('travel_suggestions')->where('option_suggestion', '=', $showLocations)->count(); @endphp

								<div class="indResult">
									<span class="resultLocation">{{ str_ireplace('_', ' ', $showLocations) }}</span><span class="resultPercent">{{ ".............. " . round(($getRows/$getTotalRows) * 100) . "%" }}</span>
								</div>

							@endforeach
						</div>

					</div>

				</div>

			</div>

		</div>

	@endsection