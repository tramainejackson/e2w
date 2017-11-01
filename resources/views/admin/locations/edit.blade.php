@extends('layouts.app')
	@section('styles')
		@include('function.bootstrap_css')
	@endsection
	
	@section('scripts')
		@include('function.bootstrap_js')
	@endsection

	@section('content')
		<div class="" id="admin_page">
			<h1 id="admin_page_header">Eastcoast to Westcoast Travel</h1>
			
			@include('layouts.admin_nav')

			<div class="adminDiv" id="">
				<form id="" class="" action="location_update.php" method="POST" onsubmit="locationCheck();" enctype="multipart/form-data"> 
					<div id="location_page_header" class="">
						<h1 class="pageTopicHeader text-light">Trip Locations</h1>
					</div>
					<div class="trip_location_div" style="background-image:url(../public/images/{{ $showLocations->trip_photo != "" ? $showLocations->trip_photo : 'skyline.jpg' }} );">
						<div class="trip_location_header">
							<h3>{{ $showLocations->trip_location }}</h3>
							<input type="submit" name="submit" value="Update" />
						</div>
						<div class="trip_edit_div">
							<div class="trip_location_photo editTripInfo">
								<span>Change Photo</span>
								<input type="file" name="trip_photo" class="tripPhotoChange" value="" />
							</div>
							<div class="trip_flyer editTripInfo">
								@if($showLocations->flyer_name == "")
									<span>Add Flyer</span>
									<input type="file" name="flyer_name" class="tripFlyerAdd" value="" />
								@else
									<span>Change Flyer</span>
									<input type="file" name="flyer_name" class="tripFlyerChange" value="" />
									<a href="../files/{{ $showLocations->flyer_name }}"> - See flyer</a>
								@endif
							</div>
							<div class="trip_name editTripInfo">
								<span>Trip Location</span>
								<input name="trip_name" value="{{ $showLocations->trip_location }}"/>
							</div>
							<div class="trip_description editTripInfo">
								<span>Trip Description</span>
								<textarea name="description" class="px-2" placeholder="Trip Description">{{ $showLocations->description }}</textarea>
							</div>
							<div class="trip_location_month editTripInfo">
								<span>Trip Month</span>
								<select name="trip_month">
									@foreach($getMonth as $showMonth)
										@if($showMonth->month_name == $showLocations->trip_month)
											<option class="" value="{{ $showMonth->month_name }}" selected>{{ $showMonth->month_name }}</option>
										@else
											<option class="" value="{{ $showMonth->month_name }}">{{ $showMonth->month_name }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="trip_location_year editTripInfo">
								<span>Trip Year</span>
								<select name="trip_year">
									@foreach($getYear as $showYear)
										<option class="" value="{{ $showYear->year_num }}">{{ $showYear->year_num }}</option>
									@endforeach
								</select>
							</div>
							<div class="trip_completed_div editTripInfo">
								<span>Trip Completed</span>
								<select name="trip_completed">
									@if($showLocations->trip_complete == "Y")
										<option value="Y" selected>Yes</option>
										<option value="N">No</option>
									@else
										<option value="Y">Yes</option>
										<option value="N" selected>No</option>
									@endif
								</select>
							</div>
							<div class="show_trip_div editTripInfo">
								<span>Show Trip</span>
								<select name="show_trip">
									@if($showLocations->show_trip == "Y")
										<option value="Y" selected>Yes</option>
										<option value="N">No</option>
									@else
										<option value="Y">Yes</option>
										<option value="N" selected>No</option>
									@endif
								</select>
							</div>
							<div class="deposit_date_div editTripInfo">
								<span>First Deposit Date</span>
								@if($showLocations->deposit_date == null)
									<input type="date" name="deposit_date" id="datetimepicker" class="" />
								@else
									<input type="text" name="deposit_date" class="" id="datetimepicker" value="{{ $showLocations->deposit_date }}" />
								@endif
							</div>
							<div class="balance_due_div editTripInfo">
								<span>Total Balance Due</span>
								@if($showLocations->deposit_date == null)
									<input type="date" name="due_date" class="" />
								@else
									<input type="date" name="due_date" class="" value="{{ $showLocations->due_date }}" />
								@endif
							</div>
							<div class="terms_cost_div editTripInfo">
								<span>Trip Cost</span>
								<input type="text" name="cost" class="" value="{{ $showLocations->cost }}" placeholder="Trip Cost" />
							</div>
							<div class="terms_payment_div editTripInfo">
								<span>Trip Payment</span>
								<input type="text" name="payments" class="" value="{{ $showLocations->payments }}" placeholder="Trip Payment Options" />
							</div>
							<div class="terms_inclusions_div editTripInfo">
								<span>Trip Includes</span>
								<input type="text" name="inclusions" class="" value="{{ $showLocations->inclusions }}" placeholder="Trip Inclusions" />
							</div>
							<div class="terms_conditions_div editTripInfo">
								<span>Terms and Conditions</span>
								<input type="text" name="conditions" class="" value="{{ $showLocations->conditions }}" placeholder="Terms and Conditions" />
							</div>
							<input hidden name="trip_id" value="{{ $showLocations->trip_id }}" />
						</div>
						<div class="trip_edit_div">
							<div class="" id="">
								<form name="add_activity" class="addActivity" action="location_addActivity.php" method="POST" onsubmit="locationCheck();">
									<div id="location_page_header" class="">
										<h1 class="pageTopicHeader text-white">Trip Activities</h1>
										<button type="button" class="btn btn-primary">Add New Activity<button/>
									</div>
								</form>
							
								<div class="tripEvents">
									<form name="edit_activity" class="editActivity" action="location_editActivity.php" method="POST" onsubmit="locationCheck();">
										<table>
											<tr class="text-white">
												<th>Show Activity</th>
												<th>Activity Name</th>
												<th>Activity Location</th>
												<th>Activity Date</th>
											</tr>
											@foreach($getCurrentEvents as $activity)
												<tr>
													<td>
														<select name="show_activity[]" class="" id="">
															@if($activity->show_activity == "Y")
																<option value="Y" selected>Y</option>
																<option value="N">N</option>
															@else
																<option value="Y">Y</option>
																<option value="N" selected>N</option>
															@endif
														</select>
													</td>
													<td>
														<input type="text" name="trip_event[]" class="" value="{{ $activity->trip_event }}" placeholder="Event Description" />
														<input type="text" name="activity_id[]" class="" value="{{ $activity->activity_id }}" hidden />
														<input type="text" name="trip_id" class="" value="{{ $activity->trip_id }}" hidden />
													</td>
													<td>
														<input type="text" name="activity_location[]" class="" value="{{ $activity->activity_location }}" placeholder="Event Location" />
													</td>
													<td>
														<input type="date" name="activity_date[]" class="" value="{{ $activity->activity_date }}" />
													</td>
												</tr>
											@endforeach
										</table>
									</form>
								</div>
							</div>
						</div>
						<div class="trip_edit_div">
							<form name="edit_user" class="editUser" action="location_editPerson.php" method="POST" onsubmit="locationCheck();">
								<table class="mw-100">
									<tr class="firstTableRow text-white">
										<th colspan="2">Name</th>
										<th colspan="2">Contact Info</th>
										<th colspan="1"></th>
										<th colspan="1"></th>
									</tr>
									<tr class="text-white">
										<th>First</th>
										<th>Last</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Notes</th>
										<th>PIF</th>
									</tr>
									@foreach($getEventUsers as $user)
										<tr>
											<td>
												<input type="text" name="first_name[]" class="" value="{{ $user->first_name }}" />
												<input type="number" name="user_id[]" class="" value="{{ $user->user_id }}" hidden />
												<input type="number" name="event_id" class="" value="{{ $user->trip_location }}" hidden />
											</td>
											<td>
												<input type="text" name="last_name[]" class="" value="{{ $user->last_name }}" />
											</td>
											<td>
												<input type="text" name="email[]" class="" value="{{ $user->email_address }}" />
											</td>
											<td>
												<input type="text" name="phone[]" class="" value="{{ $user->phone }}" maxlength="10" />
											</td>
											<td>
												<textarea name="notes[]" class="" maxlength="495" rows="1">{{ $user->notes }}</textarea>
											</td>
											<td>
												<?php if($user["paid_in_full"] == "Y") { ?>
													<input type="checkbox" name="paid_in_full[]" class="pifSwitch" value="Y" checked />
												<?php } else { ?>
													<input type="checkbox" name="paid_in_full[]" class="pifSwitch" value="N" />
												<?php } ?>
											</td>
										</tr>
									@endforeach
								</table>
								<input type="submit" name="submit" class="" value="Edit Users" />
							</form>
						</div>
						<div class="modal">
							<div class="adminDiv" id="">
								<div class="newUserHeader">
									<h1 class="pageTopicHeader">Trip Users</h1>
								</div>
								<div class="newUser">
									<div class="newUserFirst">
										<input type="text" name="first_name" class="" placeholder="Firstname" />
									</div>
									<div class="newUserLast">
										<input type="text" name="last_name" class="" placeholder="Lastname" />
									</div>
									<div class="newUserEmail">
										<input type="text" name="email" class="" placeholder="Email" />
									</div>
									<div class="newUserPhone">
										<input type="text" name="phone[]" class="profileInput profileInputPhone1" placeholder="###" maxlength="3" />
										<span class="phone_par_span">-</span>
										<input type="text" name="phone[]" class="profileInput profileInputPhone2"  placeholder="###" maxlength="3" />
										<span class="phone_par_span">-</span>
										<input type="text" name="phone[]" class="profileInput profileInputPhone3"  placeholder="####" maxlength="4" />
									</div>
									<div class="newUserNotes">
										<textarea type="text" name="notes" class="" placeholder="Notes"></textarea>
									</div>
								</div>
								<input type="submit" name="submit" class="" value="Add Person" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	@endsection