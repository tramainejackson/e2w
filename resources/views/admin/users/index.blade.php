@extends('admin.layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div class="row">
			<div class="col">
				<div id="pictures_page_header" class="">
					<h1 class="pageTopicHeader">Admin Page</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">All Admins</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div id="all_users">
					@foreach($getAllusers as $user)
						<div class="">
							<h2 class="text-light"><a href="/admin/{{ $user->id }}/edit" class="btn btn-primary mr-2">Edit</a>&nbsp;{{ $user->first_name . " " . $user->last_name }}{{ Auth::id() == $user->id ? ' - currently logged in' : '' }}</h2>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@endsection