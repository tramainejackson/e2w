@extends('admin.layouts.app')

	@section('title', 'Edit Trip - Eastcoast2Westcoast')

	@if(session('status'))
		@section('scripts')
			<script type="text/javascript">
				// Display a success toast
				toastr.success($('h2.flashMessage').text());
			</script>
		@endsection
	@endif

	@if(session('error'))
		@section('scripts')
			<script type="text/javascript">
				// Display a success toast
				toastr.error($('h2.errorMessage').text());
			</script>
		@endsection
	@endif

	@section('scripts')
		<script type="text/javascript">
            var $BTN = $('.table-save');
            var $EXPORT = $('<span></span>');
            var trip_id = $('body').find('input[name="trip"]').val();

            // If trip payment occurrence checkbox is selected, remove checkbox from
			// other checkbox option
			$('body').on('click', '.oneTimeCheckBox, .reoccuringCheckBox', function() {
				$(this).parent().siblings().find('input').attr('checked', false);
			});

            $('.table-add').click(function () {
                var table = $(this).parent().parent();
                var $clone = table.find('tr.hide').clone(true).removeClass('hide table-line');

                // Remove blank placeholder row if one available
                table.find('table tr[class^="blank"]').remove();

                // Add id attribute to input checkboxes and for attribute to label if trip payment table
                $clone.find('.reoccuringCheckBox').attr('id', 'materialInline' + (table.find('tr').length * 2));
                $clone.find('.reoccuringCheckBox').next().attr('for', 'materialInline' + (table.find('tr').length * 2));
                $clone.find('.oneTimeCheckBox').attr('id', 'materialInline' + ((table.find('tr').length * 2) + 1));
                $clone.find('.oneTimeCheckBox').next().attr('for', 'materialInline' + ((table.find('tr').length * 2) +1));

                // Initialize the new date field
				$clone.removeClass('newActivityRow').find('.new_activity_date').addClass('date_picker_1');

                // Append the cloned row to the table
                table.find('table').append($clone).find('.date_picker_1').pickadate({
                    format: 'mm/dd/yyyy',
                    formatSubmit: 'yyyy/mm/dd',
                });
            });

            $('.table-remove').click(function () {
                $(this).parents('tr').detach();
            });

            // Save new rows
            $BTN.on('click', function () {
                var row = $(this).parents('tr');
                var $values = $(row).find('input, textarea').serialize();
                var $parsedValues = $values.split('&');
                var updateDiv = '#';

				$.ajax({
                    method: "POST",
					url: "/locations/ajax_add",
					data: {trip_id:trip_id, trip_additions:$values}
                }).done(function(data) {

                    for(var i=0; i < $parsedValues.length; i++) {
                        if($parsedValues[i].indexOf('trip_') > -1) {
                            var parseValue = $parsedValues[i].split('=');
                            updateDiv += parseValue[0];
                            // console.log(updateDiv);
                        }
                    }
				});
            });

            // Update current rows
            $('tr input, tr textarea').on('change', function() {
                var $values = $(this).parents('tr').find('input, textarea').serialize();

                $.ajax({
                    method: "PATCH",
                    url: "/locations/ajax_update",
                    data: {trip_id:trip_id, trip_updates:$values}
                }).done(function(data) {
                    toastr.success(data);
                });
			});

            // Update current rows
            $('.md-form input, .md-form select, .md-form textarea').on('change', function() {
                var $values = $(this).serialize().replace(/%.{2}/g, ' ');
                var skipAjax = false;

                if($values.search('deposit_date') > -1) {
                    var deposit_date = $('.md-form input[name="deposit_date"]');
					$values = 'deposit_date=' + deposit_date.val();
				} else if($values.search('due_date') > -1) {
                    var due_date = $('.md-form input[name="due_date"]');
                    $values = 'due_date=' + due_date.val();
				} else if($(this).parents('.terms_cost_div').length > 0) {
                    $values = 'trip_cost_' + $(this).attr('name') + '=' + $(this).val();
				} else if($(this).hasClass('tripPhotoChange') || $(this).hasClass('flyerChange')) {
                    skipAjax = true;

                    if($(this).hasClass('tripPhotoChange')) {
                        $('.saveNewPhotoBtn').fadeIn();
					} else {
                        $('.saveNewFlyerBtn').fadeIn();
					}
                }

				if(skipAjax == false) {
                    $.ajax({
                        method: "PATCH",
                        url: "/locations/ajax_update",
                        data: {trip_id:trip_id, trip_updates:$values}
                    }).done(function(data) {
                        toastr.success(data);
                    });
				}

            });

            $('input[name="trip_complete"], input[name="show_trip"]').parent().on('click', function(e) {
                var $values = $(e.target.children)[0].name + "=" + $(e.target.children)[0].value;

                $.ajax({
                    method: "PATCH",
                    url: "/locations/ajax_update",
                    data: {trip_id:trip_id, trip_updates:$values}
                }).done(function(data) {
                    toastr.success(data);
                });
			});


		</script>

	@endsection

	@section('content')

		<div class="row">

			<div class="col" id="">

				<form id="" class="locationEditForm" action="/location/{{ $showLocation->id }}" method="POST" enctype="multipart/form-data">

					{{ method_field('PATCH') }}
					{{ csrf_field() }}

					<div class="">

						<div class="">
							<h3 class="display-2">{{ $showLocation->trip_location }}</h3>
						</div>

						<div class="trip_edit_div">

							{{--Trip Image--}}
							<img src="{{ $showLocation->trip_photo != null ? asset('storage/' . str_ireplace('public/', '', $showLocation->trip_photo)) : '/images/skyline.jpg' }}" class="rounded newTripPhoto" height="300" width="41.5%" />

							{{--Change trip image--}}
							<div class="md-form input-group">
								<div class="file-field" id="">
									<div class="btn btn-primary btn-sm float-left ml-0">
										<span class="">Change Image</span>
										<input type="file" name="trip_photo" class="tripPhotoChange custom-file-input" />
									</div>

									<div class="file-path-wrapper">
										<input type="text" class="tripPhotoChange file-path validate" placeholder="New Trip Photo" />
									</div>
								</div>
								<div class="input-group-append" id="" style="margin-bottom: 3px;">
									<button type="submit" class="btn btn-md btn-outline-info m-0 px-3 py-2 z-depth-0 waves-effect saveNewPhotoBtn" style="display: none;">Save New Image</button>
								</div>
							</div>

							{{--Change trip location--}}
							<div class="md-form">
								<input type="text" name="trip_location" id="trip_location" value="{{ $showLocation->trip_location }}" class="form-control" placeholder="Enter Destination Name" />

								<label for="trip_location">Trip Location</label>
							</div>

							<div class="md-form">
								<textarea type="text" name="description" id="trip_description" class="md-textarea form-control" placeholder="Enter Trip Description">{{ $showLocation->description }}</textarea>

								<label for="trip_description" class="">Trip Description</label>
							</div>

                            <div class="form-row" id="">

                                <div class="md-form col-6">
                                    <select name="trip_month" id="trip_month" class="md-form mdb-select">
                                        @foreach($getMonth as $showMonth)
                                            <option class="" value="{{ $showMonth->month_id }}" {{ $showMonth->month_id == $showLocation->trip_month ? 'selected' : ''}}>{{ $showMonth->month_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="trip_month" class="select-label active">Trip Month</label>
                                </div>

                                <div class="md-form col-6">
                                    <select name="trip_year" id="trip_year" class="md-form mdb-select">
                                        @foreach($getYear as $showYear)
                                            <option class="" value="{{ $showYear->year_num }}" {{ $showYear->year_num == $showLocation->trip_year ? 'selected' : ''}}>{{ $showYear->year_num }}</option>
                                        @endforeach
                                    </select>

                                    <label for="trip_year" class="select-label active">Trip Year</label>
                                </div>

                            </div>

                            <div class="form-row" id="">

                                <div class="md-form col-6">
                                    <input type="text" name="deposit_date" class="form-control datepicker" id="deposit_date" data-value="{{ $showLocation->deposit_date != null ? $showLocation->deposit_date->format('Y/m/d') : '' }}" placeholder="Enter Deposit Date" />

                                    <label for="deposit_date">First Deposit Date</label>
                                </div>

                                <div class="md-form col-6">
                                    <input type="text" name="due_date" class="form-control datepicker" id="due_date" data-value="{{ $showLocation->due_date != null ? $showLocation->due_date->format('Y/m/d') : '' }}" placeholder="Enter Due Date" />

                                    <label for="due_date">Total Balance Due</label>
                                </div>

                            </div>

                            <div class="md-form">
                                <div class="btn-group mt-2">
                                    <button type="button" class="btn yesBtn{{ $showLocation->trip_complete == 'Y' ? ' btn-success active' : ' stylish-color' }}" style="">
                                        <input type="checkbox" name="trip_complete" value="Y" {{ $showLocation->trip_complete == 'Y' ? 'checked' : '' }} hidden />Yes
                                    </button>
                                    <button type="button" class="btn noBtn{{ $showLocation->trip_complete == 'N' ? ' btn-danger active' : ' stylish-color' }}" style="">
                                        <input type="checkbox" name="trip_complete" value="N" {{ $showLocation->trip_complete == 'N' ? 'checked' : '' }} hidden />No
                                    </button>
                                </div>

                                <label for="" class="active">Trip Completed</label>
                            </div>

                            <div class="md-form">
                                <div class="btn-group mt-2">
                                    <button type="button" class="btn yesBtn{{ $showLocation->show_trip == 'Y' ? ' btn-success active' : ' stylish-color' }}" style="">
                                        <input type="checkbox" name="show_trip" value="Y" {{ $showLocation->show_trip == 'Y' ? 'checked' : '' }} hidden />Yes
                                    </button>
                                    <button type="button" class="btn noBtn{{ $showLocation->show_trip == 'N' ? ' btn-danger active' : ' stylish-color' }}" style="">
                                        <input type="checkbox" name="show_trip" value="N" {{ $showLocation->show_trip == 'N' ? 'checked' : '' }} hidden />No
                                    </button>
                                </div>

                                <label for="" class="active">Show Trip</label>
                            </div>

							<div class="md-form" id="">
								<div class="input-group pb-4">
									<div class="file-field">
										<div class="btn btn-sm btn-primary waves-effect float-left ml-0">
											<span>Choose Document</span>
											<input type="file" name="flyer_name" class="flyerChange">
										</div>
										<div class="file-path-wrapper">
											<input class="file-path validate flyerChange" type="text" placeholder="Change Trip Flyer">
										</div>
									</div>

									<div class="input-group-append" id="" style="margin-bottom: 3px;">
										<button type="submit" class="btn btn-md btn-outline-info m-0 px-3 py-2 z-depth-0 waves-effect saveNewFlyerBtn" style="display: none;">Save New Flyer</button>
									</div>

									@if($showLocation->flyer_name != null)
										<a href="{{ asset('storage/' . str_ireplace('public/', '', $showLocation->flyer_name)) }}" class="btn btn-primary addInput" download="{{ str_ireplace(' ', '_', ucwords($showLocation->trip_location)) . '_Flyer' }}">View Current Flyer</a>
									@endif

									<label class="active">Trip Flyer</label>
								</div>
							</div>

							{{-- Trip Cost--}}
							<div class="terms_cost_div trip_edit_div">

								<!-- Editable table -->
								<div class="card">
									<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow darken-4">Trip Cost</h3>
									<div class="card-body">
										<div id="table" class="table-editable">

											<table class="table table-bordered table-responsive-md text-center">

												<tr>

													{{-- Cost: Price Per Adult--}}
													<div class="md-form input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text md-addon" id="addon1">$</span>
														</div>

														<input type="number" step="0.01" name="per_adult" class="form-control" value="{{ $costs->per_adult }}" placeholder="Price Per Adult" aria-label="Price Per Adult" aria-describedby="addon1">

													</div>

													{{-- Cost: Price Per Child--}}
													<div class="md-form input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text md-addon" id="addon2">$</span>
														</div>

														<input type="number" step="0.01" name="per_child" class="form-control" value="{{ $costs->per_child }}" placeholder="Price Per Child" aria-label="Price Per Child" aria-describedby="addon2">

														<div class="input-group-append">
															<span class="input-group-text md-addon">price per child</span>
														</div>
													</div>

													{{-- Cost: Single Occupancy--}}
													<div class="md-form input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text md-addon" id="addon3">$</span>
														</div>

														<input type="number" step="0.01" name="single_occupancy" class="form-control" value="{{ $costs->single_occupancy }}" placeholder="Price For Single Occupancy" aria-label="Price For Single Occupancy" aria-describedby="addon3">

														<div class="input-group-append">
															<span class="input-group-text md-addon">single occupancy</span>
														</div>
													</div>

													{{-- Cost: Double Occupancy--}}
													<div class="md-form input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text md-addon" id="addon4">$</span>
														</div>

														<input type="number" step="0.01" name="double_occupancy" class="form-control" value="{{ $costs->double_occupancy }}" placeholder="Price For Double Occupancy" aria-label="Price For Double Occupancy" aria-describedby="addon4">

														<div class="input-group-append">
															<span class="input-group-text md-addon">double occupancy</span>
														</div>
													</div>

													{{-- Cost: Triple Occupancy--}}
													<div class="md-form input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text md-addon" id="addon5">$</span>
														</div>

														<input type="number" step="0.01" name="triple_occupancy" class="form-control" value="{{ $costs->triple_occupancy }}" placeholder="Price For Triple Occupancy" aria-label="Price For Triple Occupancy" aria-describedby="addon5">

														<div class="input-group-append">
															<span class="input-group-text md-addon">triple occupancy</span>
														</div>
													</div>

												</tr>

											</table>
										</div>
									</div>
								</div>
								<!-- Editable table -->

							</div>

							{{-- Trip Payments--}}
							<div class="trip_edit_div" id="trip_payment">

								<!-- Editable table -->
								<div class="card">
									<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow darken-3">Trip Payment</h3>
									<div class="card-body">
										<div id="table_wrapper_1" class="table-editable">

											<span class="table-add float-right mb-3 mr-2">
												<a href="#!" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
											</span>

											<table class="table table-bordered table-responsive-md text-center">

												<tr>
													<th class="text-center">Description</th>
													<th class="text-center">Occurrence</th>
													<th class="text-center">Remove</th>
												</tr>

												@if($getPaymentOptions->count() > 0)

													@foreach($getPaymentOptions as $payment)

														<tr>
															<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description">{{ $payment->payment_description }}</textarea></td>
															<td class="pt-3-half">
																<div class="" id="">
																	<!-- Material inline 1 -->
																	<div class="form-check form-check-inline col-auto">
																		<input type="radio" name="occurrence{{($loop->iteration*2)}}" class="form-check-input reoccuringCheckBox" value="reoccurring" id="materialInline{{($loop->iteration*2)}}"{{$payment->occurrence == "reoccurring" ? ' checked' : ''}}>
																		<label class="form-check-label" for="materialInline{{($loop->iteration*2)}}">Reoccurring</label>
																	</div>

																	<!-- Material inline 2 -->
																	<div class="form-check form-check-inline col-auto">
																		<input type="radio" name="occurrence{{($loop->iteration*2)}}" class="form-check-input oneTimeCheckBox" value="one_time" id="materialInline{{($loop->iteration*2) +1}}"{{$payment->occurrence == "one_time" ? ' checked' : ''}}>
																		<label class="form-check-label" for="materialInline{{($loop->iteration*2) +1}}">One Time</label>
																	</div>
																</div>
															</td>

															<td>
																<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
															</td>
															<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
															<td class="pt-3-half" hidden><input type="text" name="trip_payments" value="true"></td>
															<td class="pt-3-half" hidden><input type="text" name="payment_option" value="{{ $payment->id }}" /></td>
														</tr>

													@endforeach

												@else

													<tr class="blankActivity">
														<td colspan="3" rowspan="1" class="">No Payment Options Added Yet</td>
													</tr>

												@endif

												<!-- This is our clonable table line -->
												<tr class="hide">
													<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description"></textarea></td>
													<td class="pt-3-half">
														<!-- Material inline 1 -->
														<div class="form-check form-check-inline col-auto">
															<input type="radio" class="form-check-input reoccuringCheckBox" name="occurrence" value="reoccurring" id="">
															<label class="form-check-label" for="">Reoccurring</label>
														</div>

														<!-- Material inline 2 -->
														<div class="form-check form-check-inline col-auto">
															<input type="radio" class="form-check-input oneTimeCheckBox" name="occurrence" value="one_time" id="">
															<label class="form-check-label" for="">One Time</label>
														</div>
													</td>
													<td>
														<span class="table-save"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Save</button></span>
														<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
													</td>
													<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
													<td class="pt-3-half" hidden><input type="text" name="trip_payments" value="true"></td>
												</tr>

											</table>
										</div>
									</div>
								</div>
								<!-- Editable table -->

							</div>

							{{-- Trip Inclusions --}}
							<div class="trip_edit_div" id="trip_inclusions">

								<!-- Editable table -->
								<div class="card">
									<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow darken-2">Trip Includes</h3>
									<div class="card-body">
										<div id="table_wrapper_2" class="">

											<span class="table-add float-right mb-3 mr-2">
												<a href="#!" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
											</span>

											<table class="table table-bordered table-responsive-md text-center">

												<tr>
													<th class="text-center">Description</th>
													<th class="text-center">Remove</th>
												</tr>

												@if($getInclusions->count() > 0)

													@foreach($getInclusions as $inclusion)

														<tr>
															<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description">{{ $inclusion->description }}</textarea></td>
															<td>
																<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
															</td>

															<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
															<td class="pt-3-half" hidden><input type="text" name="trip_includes" value="true"></td>
															<td class="pt-3-half" hidden><input type="text" name="inclusion_option" value="{{ $inclusion->id }}"></td>
														</tr>

													@endforeach

												@else

													<tr class="blankActivity">
														<td colspan="2" rowspan="1" class="">No Inclusions Added Yet</td>
													</tr>

												@endif

												<!-- This is our clonable table line -->
												<tr class="hide">
													<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description"></textarea></td>
													<td>
														<span class="table-save"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Save</button></span>
														<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
													</td>
													<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
													<td class="pt-3-half" hidden><input type="text" name="trip_includes" value="true"></td>
												</tr>

											</table>
										</div>
									</div>
								</div>
								<!-- Editable table -->

							</div>

							{{-- Terms and Conditions --}}
							<div class="trip_edit_div" id="terms_conditions_div">

								<!-- Editable table -->
								<div class="card">
									<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow darken-1">Terms and Conditions</h3>
									<div class="card-body">
										<div id="table_wrapper_3" class="table-editable">

											<span class="table-add float-right mb-3 mr-2">
												<a href="#!" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
											</span>

											<table class="table table-bordered table-responsive-md text-center">

												<tr>
													<th class="text-center">Description</th>
													<th class="text-center">Remove</th>
												</tr>

												@if($getConditions->count() > 0)

													@foreach($getConditions as $condition)

														<tr>
															<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description">{{ $condition->description }}</textarea></td>
															<td>
																<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
															</td>
															<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
															<td class="pt-3-half" hidden><input type="text" name="trip_conditions" value="true"></td>
															<td class="pt-3-half" hidden><input type="text" name="condition_option" value="{{ $condition->id }}"></td>
														</tr>

													@endforeach

												@else

													<tr class="blankActivity">
														<td colspan="2" rowspan="1" class="">No Conditions Added Yet</td>
													</tr>

												@endif

												<!-- This is our clonable table line -->
												<tr class="hide">
													<td class="pt-3-half"><textarea class="bg-transparent border-0 h-auto md-textarea text-center w-100" name="description" placeholder="Enter Description"></textarea></td>
													<td>
														<span class="table-save"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Save</button></span>
														<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
													</td>
													<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
													<td class="pt-3-half" hidden><input type="text" name="trip_conditions" value="true"></td>
												</tr>

											</table>
										</div>
									</div>
								</div>
								<!-- Editable table -->

							</div>
						</div>

						<!-- Trip Events -->
						<div class="trip_edit_div" id="trip_events">

							<!-- Editable table -->
							<div class="card">
								<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow">Trip Activities</h3>
								<div class="card-body">
									<div id="table_wrapper_4" class="table-editable">

										<span class="table-add float-right mb-3 mr-2">
											<a href="#!" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
										</span>

										<table class="table table-bordered table-responsive-md text-center">

											<tr class="">
												<th scope="col">Activity Name</th>
												<th scope="col">Activity Location</th>
												{{--<th scope="col">Activity Date</th>--}}
												<th scope="col">Show Activity</th>
												<th scope="col" class="text-center">Remove</th>
												<th class="" hidden>trip</th>
												<th class="" hidden>trip_activities</th>
											</tr>

											@if($getCurrentEvents->count() > 0)

												@foreach($getCurrentEvents as $activity)
													<tr>

														<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="trip_event" value="{{ $activity->trip_event }}" /></td>
														<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="activity_location" value="{{ $activity->activity_location }}" /></td>
														{{--<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100 datepicker" data-value="{{ $activity->activity_date->format('Y/m/d') }}" name="activity_date" /></td>--}}
														<td>
															<div class="btn-group">
																<button type="button" class="btn yesBtn{{ $activity->show_activity == 'Y' ? ' btn-success active' : ' stylish-color' }}">
																	<input type="checkbox" name="show_activity" value="Y" {{ $activity->show_activity == 'Y' ? 'checked' : '' }} hidden />Yes
																</button>
																<button type="button" class="btn noBtn{{ $activity->show_activity == 'N' ? ' btn-danger active' : ' stylish-color' }}">
																	<input type="checkbox" name="show_activity" value="N" {{ $activity->show_activity == 'N' ? 'checked' : '' }} hidden />No
																</button>
															</div>
														</td>
														<td>
															<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
														</td>
														<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
														<td class="pt-3-half" hidden><input type="text" name="trip_activities" value="true"></td>
														<td class="pt-3-half" hidden><input type="text" name="activity_option" value="{{ $activity->id }}"></td>
													</tr>
												@endforeach

											@else

												<tr class="blankActivity">
													<td colspan="5" rowspan="1" class="">No Activities Added Yet</td>
												</tr>

											@endif

											<!-- This is our clonable table line -->
											<tr class="newActivityRow hide">

												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="trip_event" placeholder="Enter Activity Name" /></td>
												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="activity_location" placeholder="Enter Activity Location" /></td>
												{{--<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100 new_activity_date" id="" name="activity_date" placeholder="Select A Date" /></td>--}}
												<td>
													<div class="btn-group">
														<button type="button" class="btn yesBtn stylish-color" style="">
															<input type="checkbox" name="show_activity" value="Y" hidden />Yes
														</button>
														<button type="button" class="btn noBtn btn-danger active" style="">
															<input type="checkbox" name="show_activity" value="N" checked hidden />No
														</button>
													</div>
												</td>
												<td>
													<span class="table-save"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Save</button></span>
													<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
												</td>
												<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
												<td class="pt-3-half" hidden><input type="text" name="trip_activities" value="true"></td>
											</tr>

										</table>
									</div>
								</div>
							</div>
							<!-- Editable table -->

						</div>

						<!-- Trip Participants -->
						<div class="trip_edit_div" id="trip_participants">

							<!-- Editable table -->
							<div class="card">
								<h3 class="card-header text-center font-weight-bold text-uppercase py-4 yellow lighten-1">Trip Participants</h3>
								<div class="card-body">
									<div id="table_wrapper_5" class="table-editable">

										<span class="table-add float-right mb-3 mr-2">
											<a href="#!" class="text-success"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
										</span>

										<table class="table table-bordered table-responsive-md text-center">

											<tr class="firstTableRow">
												<th colspan="2">Name</th>
												<th colspan="4">Contact Info</th>
											</tr>

											<tr class="">
												<th>First</th>
												<th>Last</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Notes</th>
												<th>PIF</th>
												<th>Remove</th>
											</tr>

											@if($getEventUsers->count() > 0)

												@foreach($getEventUsers as $user)
													<tr>
														<td><input type="text" name="first_name" class="bg-transparent border-0 h-auto text-center w-100" value="{{ $user->first_name }}" /></td>
														<td><input type="text" name="last_name" class="bg-transparent border-0 h-auto text-center w-100" value="{{ $user->last_name }}" /></td>
														<td><input type="text" name="email" class="bg-transparent border-0 h-auto text-center w-100" value="{{ $user->email }}" /></td>
														<td><input type="text" name="phone" class="bg-transparent border-0 h-auto text-center w-100" value="{{ $user->phone }}" /></td>
														<td><input type="text" name="notes" class="bg-transparent border-0 h-auto text-center w-100" value="{{ $user->notes }}" /></td>
														<td>
															<div class="btn-group">
																<button type="button" class="btn yesBtn{{ $user->paid_in_full == 'Y' ? ' btn-success active' : ' stylish-color' }}" style="">
																	<input type="checkbox" name="pif" value="Y" {{ $user->paid_in_full == 'Y' ? 'checked' : '' }} hidden />Yes
																</button>
																<button type="button" class="btn noBtn{{ $user->paid_in_full == 'N' ? ' btn-danger active' : ' stylish-color' }}" style="">
																	<input type="checkbox" name="pif" value="N" {{ $user->paid_in_full == 'N' ? 'checked' : '' }} hidden />No
																</button>
															</div>
														<td>
															<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
														</td>
														<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
														<td class="pt-3-half" hidden><input type="text" name="trip_participants" value="true"></td>
														<td class="pt-3-half" hidden><input type="text" name="participant_option" value="{{ $user->id }}"></td>
													</tr>

												@endforeach

											@else

												<tr class="blankParticipant">
													<td colspan="6" rowspan="1" class="">No Participants Added Yet</td>
												</tr>

											@endif

											<!-- This is our clonable table line -->
											<tr class="newParticipantRow hide">

												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="first_name" placeholder="Enter First Name" /></td>
												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="last_name" placeholder="Enter Last Name" /></td>
												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="email" placeholder="Enter Email" /></td>
												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="phone" placeholder="Enter Phone Number" /></td>
												<td><input type="text" class="bg-transparent border-0 h-auto text-center w-100" name="notes" placeholder="Enter Notes" /></td>

												<td>
													<div class="btn-group">
														<button type="button" class="btn stylish-color yesBtn" style="">
															<input type="checkbox" name="pif" value="Y" hidden />Yes
														</button>
														<button type="button" class="btn btn-danger active noBtn" style="">
															<input type="checkbox" name="pif" value="N" checked hidden />No
														</button>
													</div>
												</td>
												<td>
													<span class="table-save"><button type="button" class="btn btn-info btn-rounded btn-sm my-0">Save</button></span>
													<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
												</td>
												<td class="pt-3-half" hidden><input type="text" name="trip" value="{{ $showLocation->id }}" /></td>
												<td class="pt-3-half" hidden><input type="text" name="trip_participants" value="true"></td>
											</tr>

										</table>
									</div>
								</div>
							</div>
							<!-- Editable table -->

						</div>

					</div>

				</form>

			</div>

		</div>

	@endsection