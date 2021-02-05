@extends('layouts.app')

	@section('content')

		<div class="col-12" id="">

			<div id="users_page_header" class="">
				<h1 class="pageTopicHeader">All Admins</h1>
			</div>

			<a href="{{ route('admin.create') }}" class="btn btn-success">Create New User</a>

			<div class="row mt-4">

				<div id="all_users" class="" style="margin-left: 1.2em;">

					@foreach($getAllusers as $user)

						@php $user->active == 'Y' ? $user->active = 'Active' : $user->active = 'Inactive'; @endphp

						<div class="d-flex flex-column justify-content-center align-items-center card z-depth-2 mb-4 py-3 px-2">
							<a href="/admin/{{ $user->id }}/edit" class="btn btn-primary">Edit</a>
							<h2 class="order-first text-center">{{ $user->first_name . " " . $user->last_name }}</h2>
							<button class='btn {{ $user->active == 'Active' ? 'btn-success' : 'btn-danger' }}' type='button'>{{ $user->active }}</button>
							<span class="grey-text font-italic font-small">{{ Auth::id() == $user->id ? ' - Currently Logged In' : '' }}</span>
						</div>
					@endforeach
				</div>
			</div>
		</div>

	@endsection