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
										
									<div class="custom-controls-stacked">
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="niagra_falls" type="radio" name="next_location" value="Niagra Falls" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Niagra Falls</span>
										</label>
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="Toronto" type="radio" name="next_location" value="Toronto" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Toronto</span>
										</label>
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="DC" type="radio" name="next_location" value="DC" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Washington D.C.</span>
										</label>
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="Miami" type="radio" name="next_location" value="Miami" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Miami</span>
										</label>
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="Houston" type="radio" name="next_location" value="Houston" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Houston</span>
										</label>
										<label class="custom-control custom-radio">
											<input class="nextLocation custom-control-input" id="other_option" type="radio" name="next_location" value="Other" />
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">Other</span>
											
										</label>
										<div class="">
											<input type="text" name="other_location" class="d-block rounded ml-3 mb-3 p-1" id="other_location2" placeholder="Example: Disney Land" disabled />
										</div>
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