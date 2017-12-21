@extends('admin.layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<form id="" class="locationEditForm" action="/location/{{ $showLocation->id }}" method="POST" enctype="multipart/form-data">
		
			{{ method_field('PATCH') }}
			{{ csrf_field() }}
				
			<div id="location_page_header" class="">
				<h1 class="pageTopicHeader text-light">Trip Locations</h1>
			</div>
			<div class="trip_location_div">
				<div class="trip_location_header">
					<h3>{{ $showLocation->trip_location }}</h3>
				</div>
				<div class="trip_edit_div">
					<div class="trip_location_photo editTripInfo">
						<span>Trip Photo</span>
						<img src="{{ $showLocation->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $showLocation->trip_photo)) : '/images/skyline.jpg' }}" class="rounded newTripPhoto" height="300" width="41.5%" />
						<label class="custom-file addInput mt-1">
							<span class="custom-file-control" style="width:90%;"></span>
							<input type="file" name="trip_photo" class="tripPhotoChange custom-file-input" />
						</label>
					</div>
					<div class="trip_name editTripInfo">
						<span>Trip Location</span>
						<input name="trip_location" value="{{ $showLocation->trip_location }}"/>
					</div>
					<div class="trip_description editTripInfo">
						<span>Trip Description</span>
						<textarea name="description" class="px-2" placeholder="Trip Description">{{ $showLocation->description }}</textarea>
					</div>
					<div class="trip_location_month editTripInfo">
						<span>Trip Month</span>
						<select name="trip_month">
							@foreach($getMonth as $showMonth)
								<option class="" value="{{ $showMonth->month_name }}" {{ $showMonth->month_name == $showLocation->trip_month ? 'selected' : ''}}>{{ $showMonth->month_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="trip_location_year editTripInfo">
						<span>Trip Year</span>
						<select name="trip_year">
							@foreach($getYear as $showYear)
								<option class="" value="{{ $showYear->year_num }}" {{ $showYear->year_num == $showLocation->trip_year ? 'selected' : ''}}>{{ $showYear->year_num }}</option>
							@endforeach
						</select>
					</div>
					<div class="trip_flyer editTripInfo">
						<span>Change Flyer</span>
						<label class="custom-file">
							<span class="custom-file-control" style="width:90%;"></span>
							<input type="file" name="flyer_name" class="tripFlyerChange custom-file-input" />
						</label>
						@if($showLocation->flyer_name != null)
							<a href="{{ asset('storage/' . str_ireplace('public/', '', $showLocation->flyer_name)) }}" class="btn btn-primary addInput" download="{{ str_ireplace(' ', '_', ucwords($showLocation->trip_location)) . '_Flyer' }}">View Current Flyer</a>
						@endif
					</div>
					<div class="trip_completed_div editTripInfo">
						<span>Trip Completed</span>
						<div class="btn-group">
							<button type="button" class="btn{{ $showLocation->trip_complete == 'Y' ? ' btn-success active' : '' }}" style="">
								<input type="checkbox" name="trip_completed" value="Y" {{ $showLocation->trip_complete == 'Y' ? 'checked' : '' }} hidden />Yes
							</button>
							<button type="button" class="btn{{ $showLocation->trip_complete == 'N' ? ' btn-danger active' : '' }}" style="">
								<input type="checkbox" name="trip_completed" value="N" {{ $showLocation->trip_complete == 'N' ? 'checked' : '' }} hidden />No
							</button>
						</div>
					</div>
					<div class="show_trip_div editTripInfo">
						<span>Show Trip</span>
						<div class="btn-group">
							<button type="button" class="btn{{ $showLocation->show_trip == 'Y' ? ' btn-success active' : '' }}" style="">
								<input type="checkbox" name="show_trip" value="Y" {{ $showLocation->show_trip == 'Y' ? 'checked' : '' }} hidden />Yes
							</button>
							<button type="button" class="btn{{ $showLocation->show_trip == 'N' ? ' btn-danger active' : '' }}" style="">
								<input type="checkbox" name="show_trip" value="N" {{ $showLocation->show_trip == 'N' ? 'checked' : '' }} hidden />No
							</button>
						</div>
					</div>
					<div class="deposit_date_div editTripInfo">
						@php 
							$depositDate = explode('-', $showLocation->deposit_date);
						@endphp
						<span>First Deposit Date</span>
						<input type="text" name="deposit_date" class="datetimepicker" id="" value="{{ $showLocation->deposit_date!= null ? $depositDate[1] . "/" . $depositDate[2] . "/" . $depositDate[0] : '' }}" placeholder="Deposit Date" />
					</div>
					<div class="balance_due_div editTripInfo">
						@php
							$dueDate = explode('-', $showLocation->due_date);
						@endphp
						<span>Total Balance Due</span>
						<input type="text" name="due_date" class="datetimepicker" id="" value="{{ $showLocation->due_date != null ? $dueDate[1] . "/" . $dueDate[2] . "/" . $dueDate[0] : '' }}" placeholder="Due Date" />
					</div>
					<div class="terms_cost_div editTripInfo">
						@php $costs = explode('; ', $showLocation->cost); @endphp
						<span>Trip Cost</span>
						<span class="oi oi-plus text-success rounded-circle" title="io-plus" aria-hidden="true"></span>
						
						@foreach($costs as $cost)
							<div class="{{ $loop->iteration <= 2 ? 'd-inline' : '' }}{{ !$loop->first ? ' addInput' : '' }}{{ $loop->iteration > 2 ? ' w-100' : '' }}">
								@if(!$loop->first )
									<span class="oi oi-minus text-danger rounded-circle" title="io-minus" aria-hidden="true"></span>
								@endif
								<input type="text" name="cost[]" class="" value="{{ $cost }}" placeholder="Trip Cost" />
							</div>
						@endforeach
					</div>
					<div class="terms_payment_div editTripInfo">
						@php $payments = explode('; ', $showLocation->payments); @endphp
						<span>Trip Payment</span>
						<span class="oi oi-plus text-success rounded-circle" title="io-plus" aria-hidden="true"></span>
						
						@foreach($payments as $payment)
							<div class="{{ $loop->iteration <= 2 ? 'd-inline' : '' }}{{ !$loop->first ? ' addInput' : '' }}{{ $loop->iteration > 2 ? ' w-100' : '' }}">
								@if(!$loop->first )
									<span class="oi oi-minus text-danger rounded-circle" title="io-minus" aria-hidden="true"></span>
								@endif
								<input type="text" name="payments[]" class="" value="{{ $payment }}" placeholder="Trip Payment Option" />
							</div>
						@endforeach
					</div>
					<div class="terms_inclusions_div editTripInfo">
						@php $inclusions = explode('; ', $showLocation->inclusions); @endphp
						<span>Trip Includes</span>
						<span class="oi oi-plus text-success rounded-circle" title="io-plus" aria-hidden="true"></span>
						
						@foreach($inclusions as $inclusion)
							<div class="{{ $loop->iteration <= 2 ? 'd-inline' : '' }}{{ !$loop->first ? ' addInput' : '' }}{{ $loop->iteration > 2 ? ' w-100' : '' }}">
								@if(!$loop->first )
									<span class="oi oi-minus text-danger rounded-circle" title="io-minus" aria-hidden="true"></span>
								@endif
								<input type="text" name="inclusions[]" class="" value="{{ $inclusion }}" placeholder="Trip Inclusions" />
							</div>
						@endforeach
					</div>
					<div class="terms_conditions_div editTripInfo">
						@php $conditions = explode('; ', $showLocation->conditions); @endphp
						<span>Terms and Conditions</span>
						<span class="oi oi-plus text-success rounded-circle" title="io-plus" aria-hidden="true"></span>
						
						@foreach($conditions as $condition)
							<div class="{{ $loop->iteration <= 2 ? 'd-inline' : '' }}{{ !$loop->first ? ' addInput' : '' }}{{ $loop->iteration > 2 ? ' w-100' : '' }}">
								@if(!$loop->first )
									<span class="oi oi-minus text-danger rounded-circle" title="io-minus" aria-hidden="true"></span>
								@endif
								<input type="text" name="conditions[]" class="" value="{{ $condition }}" placeholder="Terms and Conditions" />
							</div>
						@endforeach
					</div>
				</div>
				
				<!-- Trip Events -->
				<div class="trip_edit_div">
					<div id="location_page_header" class="">
						<h1 class="pageTopicHeader text-white">Trip Activities</h1>
						<button type="button" class="btn btn-primary newActivityBtn">Add New Activity</button>
					</div>
				
					<div class="tripEvents">
						<table class="table">
							<tr class="text-white">
								<th scope="col">Show Activity</th>
								<th scope="col">Activity Name</th>
								<th scope="col">Activity Location</th>
								<th scope="col">Activity Date</th>
							</tr>
							@if($getCurrentEvents->count() > 0)
								@foreach($getCurrentEvents as $activity)
									<tr>
										<td>
											<div class="btn-group">
												<button type="button" class="btn{{ $activity->show_activity == 'Y' ? ' btn-success active' : '' }}" style="">
													<input type="checkbox" name="show_activity[]" value="Y" {{ $activity->show_activity == 'Y' ? 'checked' : '' }} hidden />Yes
												</button>
												<button type="button" class="btn{{ $activity->show_activity == 'N' ? ' btn-danger active' : '' }}" style="">
													<input type="checkbox" name="show_activity[]" value="N" {{ $activity->show_activity == 'N' ? 'checked' : '' }} hidden />No
												</button>
											</div>
										</td>
										<td>
											<input type="text" name="trip_event[]" class="mw-100" value="{{ $activity->trip_event }}" placeholder="Event Description" />
										</td>
										<td>
											<input type="text" name="activity_location[]" class="mw-100" value="{{ $activity->activity_location }}" placeholder="Event Location" />
										</td>
										<td>
											@php
												$activityDate = explode('-', $activity->activity_date);
											@endphp
											<input type="text" name="activity_date[]" class="datetimepicker mw-100" value="{{ $activityDate[1] . "/" . $activityDate[2] . "/" . $activityDate[0] }}" />
											<input type="text" name="activity_id[]" value="{{ $activity->id }}" hidden />
										</td>
									</tr>
								@endforeach
							@else
								<tr class="blankActivity">
									<td colspan="4" rowspan="2" class="text-light">No Activities Added Yet</td>
								</tr>
							@endif
							<tr class="newActivityRow" style="display:none;">
								<td>
									<div class="btn-group">
										<button type="button" class="btn" style="">
											<input type="checkbox" name="show_activity[]" value="Y" hidden />Yes
										</button>
										<button type="button" class="btn btn-danger active" style="">
											<input type="checkbox" name="show_activity[]" value="N" checked hidden />No
										</button>
									</div>
								</td>
								<td>
									<input type="text" name="trip_event[]" class="mw-100" value="" placeholder="Event Description" />
								</td>
								<td>
									<input type="text" name="activity_location[]" class="mw-100" value="" placeholder="Event Location" />
								</td>
								<td>
									<input type="text" name="activity_date[]" class="datetimepicker mw-100" placeholder="Event Date" />
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<!-- Trip Participants -->
				<div class="trip_edit_div">
					<div id="location_page_header" class="">
						<h1 class="pageTopicHeader text-white">Trip Participants</h1>
						<button type="button" class="btn btn-primary newParticipantBtn">Add New Participant</button>
					</div>
					
					<div class="tripUsers">
						<table class="table mw-100">
							<tr class="firstTableRow text-white">
								<th colspan="2">Name</th>
								<th colspan="4">Contact Info</th>
							</tr>
							<tr class="text-white">
								<th>First</th>
								<th>Last</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Notes</th>
								<th>PIF</th>
							</tr>
							@if($getEventUsers->count() > 0)
								@foreach($getEventUsers as $user)
									<tr>
										<td>
											<input type="text" name="first_name[]" class="mw-100" value="{{ $user->first_name }}"placeholder="Enter First Name" />
										</td>
										<td>
											<input type="text" name="last_name[]" class="mw-100" value="{{ $user->last_name }}" placeholder="Enter Last Name" />
										</td>
										<td>
											<input type="text" name="email[]" class="mw-100" value="{{ $user->email }}"placeholder="Enter Email Address"  />
										</td>
										<td>
											<input type="text" name="phone[]" class="mw-100" value="{{ $user->phone }}" maxlength="10" placeholder="Enter Phone Number" />
										</td>
										<td>
											<textarea name="notes[]" class="mw-100" maxlength="495" rows="1" placeholder="Enter Notes">{{ $user->notes }}</textarea>
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn{{ $user->paid_in_full == 'Y' ? ' btn-success active' : '' }}" style="">
													<input type="checkbox" name="pif[]" value="Y" {{ $user->paid_in_full == 'Y' ? 'checked' : '' }} hidden />Yes
												</button>
												<button type="button" class="btn{{ $user->paid_in_full == 'N' ? ' btn-danger active' : '' }}" style="">
													<input type="checkbox" name="pif[]" value="N" {{ $user->paid_in_full == 'N' ? 'checked' : '' }} hidden />No
												</button>
											</div>
											<input type="text" name="participant_id[]" value="{{ $user->id }}" hidden />
										</td>
									</tr>
								@endforeach
							@else
								<tr class="blankParticipant">
									<td colspan="6" rowspan="2" class="text-light">No Participants Added Yet</td>
								</tr>
							@endif
							<tr class="newParticipantRow" style="display:none">
								<td>
									<input type="text" name="first_name[]" class="mw-100" placeholder="Enter First Name" />
								</td>
								<td>
									<input type="text" name="last_name[]" class="mw-100" placeholder="Enter Last Name" />
								</td>
								<td>
									<input type="text" name="email[]" class="mw-100" placeholder="Enter Email" />
								</td>
								<td>
									<input type="text" name="phone[]" class="mw-100" placeholder="Enter Phone Number" maxlength="10" />
								</td>
								<td>
									<textarea name="notes[]" class="mw-100" maxlength="495" rows="1"placeholder="Enter Notes" ></textarea>
								</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn" style="">
											<input type="checkbox" name="pif[]" value="Y" hidden />Yes
										</button>
										<button type="button" class="btn btn-danger active" style="">
											<input type="checkbox" name="pif[]" value="N" checked hidden />No
										</button>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<input type="submit" name="submit" class="btn btn-secondary" value="Update" />
			</div>
		</form>
	@endsection