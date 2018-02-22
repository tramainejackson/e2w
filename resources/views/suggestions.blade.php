@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div id="home_page" class="container-fluid">	
			<div class="row d-xl-none">
				@include('layouts.mobile_nav')
				@if(session('status'))
					<h2 class="flashMessage">{{ session('status') }}</h2>
				@endif
				
				<div class="col-12 p-0">
					<h2 class="text-black text-center m-0 p-5" style="background:linear-gradient(#f2f2f2, #f2f2f2, #f2f2f2, rgba(0, 0, 0, 0)); font-family: 'Felipa', cursive; text-shadow: 2px 1px 5px #304e4e; font-size: 275%;"><b>Trip Suggestions</b></h2>
				</div>
				
				<div class="col-12">
					<div class="container-fluid">
						<div class="row suggestionMobile">
							<div class="col-12">
								<h2 class="text-center text-light">Where to next?</h2>
							</div>
							<div class="col-12">
								<form id="suggestion_form1" action="/suggestions" method="POST">
					
									{{ method_field('POST') }}
									{{ csrf_field() }}
										
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="niagra_falls" type="radio" name="next_location" value="Niagra Falls" />
										<label class="custom-control-label" for="niagra_falls">Niagra Falls</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="Toronto" type="radio" name="next_location" value="Toronto" />
										<label class="custom-control-label" for="Toronto">Toronto</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="DC" type="radio" name="next_location" value="DC" />
										<label class="custom-control-label" for="DC">Washington D.C.</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="Miami" type="radio" name="next_location" value="Miami" />
										<label class="custom-control-label" for="Miami">Miami</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="Houston" type="radio" name="next_location" value="Houston" />
										<label class="custom-control-label" for="Houston">Houston</label>
									</div>
									<div class="custom-control custom-radio">
										<input class="nextLocation custom-control-input" id="other_option" type="radio" name="next_location" value="Other" />
										<label class="custom-control-label" for="other_option">Other</label>
									</div>
									<input type="submit" id="submit_suggestion" class="btn w-100" value="Send Suggestion" onclick="sendSuggestion();" />
								</form>
							</div>
						</div>
						<div class="row">
							@php $date = date("m/d/Y"); @endphp
							@php $getLocations = DB::table('travel_suggestions')->distinct()->select('option_suggestion')->get()->pluck('option_suggestion'); @endphp
							@php $getTotalRows = $getSuggestionInfo->count(); @endphp
							<div id="suggestion_results_div">
								<div id="suggestion_results_header">
									<h2 class="text-center">Suggestion as of <span class="text-center">{{ $date }}</span></h2>
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
			</div>
		</div>
	@endsection