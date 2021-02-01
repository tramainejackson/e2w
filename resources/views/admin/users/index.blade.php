@extends('layouts.app')

	@section('content')

		<div class="row">

			<div class="col">
				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">All Admins</h1>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col py-4">
				<a href="{{ route('admin.create') }}" class="btn btn-success">Create New User</a>
			</div>

		</div>

		<div class="row">

			<div class="col">

				<div id="all_users">

					@foreach($getAllusers as $user)

                        @php $user->active == 'Y' ? $user->active = 'Active' : $user->active = 'Inactive'; @endphp

						<div class="">
							<h2 class="">
                                <a href="/admin/{{ $user->id }}/edit" class="btn btn-primary mr-2">Edit</a>&nbsp;
                                <span class="">{{ $user->first_name . " " . $user->last_name }}</span>
                                <button class='btn {{ $user->active == 'Active' ? 'btn-success' : 'btn-danger' }}' type='button'>{{ $user->active }}</button>
                                <span class="grey-text font-italic font-small">{{ Auth::id() == $user->id ? ' - Currently Logged In' : '' }}</span>
                            </h2>
						</div>

					@endforeach

				</div>

			</div>

		</div>

	@endsection