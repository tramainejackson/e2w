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
			
			<div class="adminDiv" id="all_users">
				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">All Admins</h1>
				</div>
				<div id="all_users">
					<ul>
						@foreach($getAllusers as $user)
							<li class=""><a href="/admin/{{ $user->id }}/edit" class="btn">Edit</a>&nbsp;{{ $user->first_name . " " . $user->last_name }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	@endsection