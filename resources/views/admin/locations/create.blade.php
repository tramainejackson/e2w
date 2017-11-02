@extends('layouts.app')	@section('styles')		@include('function.bootstrap_css')	@endsection		@section('scripts')		@include('function.bootstrap_js')	@endsection	@section('content')		<div id="admin_page">			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>						@include('layouts.admin_nav')						<div class="adminDiv" id="">				<div class="newUserHeader">					<h1 class="pageTopicHeader">Add New Trip</h1>				</div>				<div class="addNewTrip">					<form name="" id="" class="" action="/location" method="POST" enctype="multipart/form-data">											{{ method_field('POST') }}						{{ csrf_field() }}												<div class="">							<span>New Location</span>							<input type="text" name="trip_name"/>														@if ($errors->has('trip_name'))								<span class="text-danger">Location name already exist or is blank. Please enter a new location name.</span>							@endif						</div>						<div class="">							<span>Trip Month</span>							<select name="trip_month">								@foreach($getMonth as $showMonth)									<option class="" value="{{ $showMonth->month_name }}">{{ $showMonth->month_name }}</option>								@endforeach							</select>						</div>							<div class="">							<span>Trip Year</span>							<select name="trip_year">								@foreach($getYear as $showYear)									<option class="" value="{{ $showYear->year_num }}">{{ $showYear->year_num }}</option>								@endforeach							</select>						</div>							<div class="">							<span>Trip Photo</span>							<input type="file" name="trip_photo" />						</div>						<input type="submit" name="submit" value="Create Trip" class="" />					</form>				</div>				</div>		</div>	@endsection