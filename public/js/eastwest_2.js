$(document).ready(function() {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
	// Commonly user variables
	var errors;
	var passwordAttempts = 0;
	var adminDivs = $(".adminDiv");
	var counter = 0;
	var mobileNavHeight = $('.mobileNavBar').outerHeight();
	var documentHeight = $(document).height();
	var winHeight = window.innerHeight;
	var winWidth = window.innerWidth;
	var screenHeight = screen.availHeight;
	var screenWidth = screen.availWidth;
	
	$('.carousel-item > div').css({'minHeight': (documentHeight - mobileNavHeight)});

	$('.location_photos').each(function() {
		$(this).magnificPopup({
			gallery: {
			  enabled: true
			},
			type: 'image',
			delegate: 'a'
		});
	});
	
	if($('.flashMessage').length == 1) {
		$('.flashMessage').animate({top:'5%'});
		setTimeout(function(){
			$('.flashMessage').animate({top:'-150px'}, function(){
				$('.flashMessage').remove();
			});
		}, 8000);
	}
	
	// Change input button when input has been changed
	$("body").on('change', '.locationEditForm input, .locationEditForm textarea, .locationEditForm select, #add_picture_form input', function() {
		$('.locationEditForm input[type="submit"], #add_picture_form input[type="submit"]').addClass('btn-success btn-lg').removeClass('btn-secondary');
	});
	
	// Initialize the datetimepicker
	$('.datetimepicker').datetimepicker({
		timepicker:false,
		format:'m/d/Y'
	});
	
	// Add an additional input row when plus sign selected
	$("body").on("click", ".oi-plus", function() {
		var inputField = $(this).next().clone();
		$(inputField).addClass("addInput").val("").appendTo($(this).parent());
	});
	
	// Add a blank activity row to the current location edit form
	$("body").on("click", ".newActivityBtn", function() {
		var newActivityRow = $(".newActivityRow").clone();
		$(".blankActivity").remove();
		$(newActivityRow)
			.find(".datetimepicker")
			.datetimepicker({
				timepicker:false,
				format:'m/d/Y'
			});
		$(newActivityRow)
			.removeClass("newActivityRow")
			.appendTo($(".tripEvents table"))
			.fadeIn()
			.find("input").focus();
	});
	
	// Add an blank participant row to the current location edit form
	$("body").on("click", ".newParticipantBtn", function() {
		var newParticipantRow = $(".newParticipantRow").clone();
		$(".blankParticipant").remove();
		$(newParticipantRow)
			.find(".datetimepicker")
			.datetimepicker({
				timepicker:false,
				format:'m/d/Y'
			});
		$(newParticipantRow)
			.removeClass("newParticipantRow")
			.appendTo($(".tripUsers table"))
			.fadeIn()
			.find("input").focus();
	});
		//Toggle mobile menubar	$("body").on("click", ".mobileMenuBtn a", function(e){		e.preventDefault();		$(".mobileBtns").slideToggle();	});	
	//Bring up already signed up users for specific trip
	$("body").on("change", "#select_trip_for_new_user, #select_trip_for_new_activity, #select_trip_for_edit", function(e) {
		var newValue = $(this).val();
		console.log($(this).attr("class"));
		if($(this).hasClass("personSelect")) {
			// window.open("locations.php?add_person=true&event_users="+newValue, "_self");	
		} else if($(this).hasClass("activitySelect")) {
			// window.open("locations.php?trip_activities=true&all_activities="+newValue, "_self");
		} else {
			// window.open("locations.php?edit_trip="+newValue, "_self");
		}
	});
	
	//Toggle value for checked item
	$("body").on("change", ".pifSwitch", function(e) {
		console.log($(this).val());
		if($(this).val() == "Y") {
			$(this).val("N");
		} else {
			$(this).val("Y");
		}
	});
	
	//Bring up pictures to see before deleting or bring up all pictures
	$("body").on("change", "#select_trip_for_remove_pictures, #select_trip_for_new_pictures, #select_trip_for_pictures", function(e) {
		var newValue = $(this).val();
		if($(this).attr("id") == "select_trip_for_remove_pictures") {
			// window.open("pictures.php?remove_pictures=true&location="+newValue, "_self");	
		} else if($(this).attr("id") == "select_trip_for_new_pictures") {
			// window.open("pictures.php?add_pictures=&location="+newValue, "_self");
		} else {
			// window.open("pictures.php?location="+newValue, "_self");
		}
	});
	
	//Something with the mobile buttons	
	$("body").on("click", "#mobile_menu_btn", function() {
		var actionBtns = $(".actionBtns");
		var checkExist = $("#mobile_menu").has(".actionBtns").length ? "Yes" : "No";
		
		if(checkExist === "No")
		{
			$("#mobile_menu").append(actionBtns).insertAfter("#container").animate({width:"55.1%"});
			$("#container").css({width:"180%", fontSize:"165%"}).animate({left:"55%"});
		}
		else
		{
			$("#action_btns").append(actionBtns);
			$("#mobile_menu").animate({width:"0%"}).insertAfter("#action_btns");
			$("#container").css({width:"initial", fontSize:"initial"}).animate({left:"0%"});
		}
	});
	
	//Remove message from screen after 10 seconds
	if($(".errors").length > 0 || $(".message").length > 0) {
		setTimeout(function() {
			$(".errors").fadeOut();
			$(".message").fadeOut();
		}, 10000)
	}

	// Button toggle for PIF switch
	$('body').on("click", "button", function(e) {
		if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
			if($(this).children().val() == "Y") {
				$(this).addClass('active btn-success').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-danger').children().removeAttr("checked");
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-success').children().removeAttr("checked");
			}
		}	
	});
	
	//Suggestion display box
	$("body").on("click", ".nextLocation, #other_option", function(e){
		if($(e.target).attr("id") == 'other_option') {
			$("#other_location2").removeAttr("disabled");
		} else {
			$("#other_location2").attr("disabled", true).val("");
		}
	});
	
	//Close modal and remove overlay
	$(".closeBtn, .maine_overlay, #delete_modal_no_btn").click(function()
	{
		$(".maine_overlay, .maine_modal_confirmation_box, .maine_modal, .maine_modal_error, .maine_modal_delete").fadeOut(function(){
			$(".delete_modal_content").empty();
			$(".disney_page_additions, .maine_modal .comingSoon, .maine_modal .termsInclusions").remove();
			$(registrationForm).detach();
			$(".maine_modal .modal_title").text("");
			$(".navContent").each(function(){
				$(this).hide();
			});
		});
		$("#question_form1 input").removeClass("errorBorder").val("");
		$("#question_form1 textarea").removeClass("errorBorder").val("");
		$(".maine_modal").removeClass("addModalPic");
			
		if($("#price_is_right").length > 0)
		{
			$("#price_is_right").remove();
		}
	});
	
	//Add loading GIF when form is submitted. Will remove once form is submitted to next pageX
	$("body").on("submit", "#add_picture_form", function(e) {
		if($(".pictureSelect option:selected").val() != "blank") {
			$("#loading_image").fadeIn("slow");
			console.log("Form Submission Started");
		}
	});
	
	//Add and remove loading gif when making ajax call
	$(document).ajaxStart(function(){
		$("#loading_image").fadeIn("slow");
		console.log("AJAX Started");
	});
	$(document).ajaxComplete(function(){
		$("#loading_image").fadeOut("slow");
		console.log("AJAX Finished");
	});
	
	// Call function for file preview when uploading new images
	$("#upload_photo_input, #trip_photo").change(function () {
		filePreview(this);
	});
	
	// Call function for file preview when uploading new photo for a current trip
	$(".tripPhotoChange").change(function () {
		filePreview2(this);
	});
});

// Ajax request for photos of selected trip
function getPictures(id) {
	$.ajax({
	  method: "GET",
	  url: "/pictures/" + id
	})
	
	.fail(function() {
		alert( "Error: nothing returned");		
	})
	.done(function(data) {
		$(data).appendTo($("#app"));

		if($('.tripPictures').length > 0) {
			$('.tripPictures').magnificPopup({
				callbacks: {
					open: function() {
					  // Will fire when this exact popup is opened
					  // this - is Magnific Popup object
					},
					close: function() {
					  $('.picture_modal_content').remove();
					}
				},
				gallery: {
				  enabled: true
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title');
					}
				},
				type: 'image'
			}).magnificPopup('open');
		} else if($('.noContentReturned').length > 0) {
			$('.noContentReturned').modal('show');
			
			$('.noContentReturned').on('hidden.bs.modal', function (e) {
			  $(this).remove();
			});
		}
	});
}

// Send question form
function sendQuestion() {
	var errors = 0;
	var form = $('#question_form1');
	var inputs = $('#question_form1 input');
	var textarea = $('#question_form1 textarea');
	
	// Check for empty fields
	$(inputs).each(function(e) {
		if($(this).val() == "") {
			$(this).prop('placeholder', 'Field Cannot be Empty');
			errors++;
		}
	});
	
	if($(textarea).val() == "") {
		$(textarea).prop('placeholder', 'Field Cannot be Empty');
		errors++;
	}
	
	if(errors < 1) {
		return true;
	} else {
		return false;
	}
}

// Send suggestion form
function sendSuggestion() {
	var errors = 0;
	
	if($('#suggestion_form1 input:checked').length < 1) {
		event.preventDefault();
	}
}

// Preview images before being uploaded on images page and new location page
function filePreview(input) {
    if (input.files && input.files[0]) {
		if(input.files.length > 1) {
			var imgCount = input.files.length
			$('.imgPreview').remove();
			
			for(x=0; x < imgCount; x++) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('<img class="imgPreview img-thumbnail m-1" src="' + e.target.result + '" width="350" height="200"/>').appendTo('.uploadsView');
				}
				reader.readAsDataURL(input.files[x]);
			}			
		} else {
			var reader = new FileReader();
			$('.imgPreview').remove();
			
			reader.onload = function (e) {
				$('<img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/>').appendTo('.uploadsView');
			}
			reader.readAsDataURL(input.files[0]);
		}
    }
}

// Preview images before being uploaded on edit location page
function filePreview2(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();		
		reader.onload = function (e) {
			$('.newTripPhoto').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
    }
}
// Remove individual image via ajax request
function removePicture(id) {
	$.ajax({
	  method: "DELETE",
	  url: "/pictures/" + id
	})
	
	.fail(function() {	
		alert("Fail");
	})
	
	.done(function(data) {
		var newData = $(data).find(".adminDiv");
		$(".adminDiv").fadeOut(1500, function(e){ 
			$(".adminDiv").remove();
			$(newData).hide().appendTo("#admin_page")
			.fadeIn(1500);
		});
	});
}

//Check for missing information or errors on question form
function checkErrors() {
	var firstname = $("input#first_name");
	var lastname = $("input#last_name");
	var email = $("input#email_address");
	var question =  $("textarea#question_text");
	var errorMsg = "";
	errors = 0;
	$("input").removeClass("errorBorder");
	$("textarea").removeClass("errorBorder");
	if((firstname.val() == "") || (firstname.val() == null)){
		errors++;
		$(firstname).addClass("errorBorder");
		errorMsg += errors + ". First name cannot be blank.<br/>";
	}
	if((lastname.val() == "") || (lastname.val() == null)){
		errors++;
		$(lastname).addClass("errorBorder");
		errorMsg += errors + ". Last name cannot be blank.<br/>";
	}
	if((email.val() == "") || (email.val() == null)){
		errors++;
		$(email).addClass("errorBorder");
		errorMsg += errors + ". Email address cannot be blank.<br/>";
	}
	if((question.val() == "") || (question.val() == null)){
		errors++;
		$(question).addClass("errorBorder");
		errorMsg += errors + ". Question cannot be blank.<br/>"; 
	}
	$(".error_modal_content").append(errorMsg);
return errors;	
}
	
//Check for errors on sign up form
function checkRegistration() {
	var firstname = $("input.first_name_input");
	var lastname = $("input.last_name_input");
	var email = $("input.email_input");
	var errorMsg = "";
	errors = 0;
	$("input").removeClass("errorBorder");
	if((firstname.val() == "") || (firstname.val() == null)){
		errors++;
		$(firstname).addClass("errorBorder");
		errorMsg += "First name cannot be blank.<br/>";
	}
	if((lastname.val() == "") || (lastname.val() == null)){
		errors++;
		$(lastname).addClass("errorBorder");
		errorMsg += "Last name cannot be blank.<br/>";
	}
	if((email.val() == "") || (email.val() == null)){
		errors++;
		$(email).addClass("errorBorder");
		errorMsg += "Email address cannot be blank.<br/>";
	}
	$(".error_modal_content").append(errorMsg);
return errors;	
}
	
//Caitalize each word
function capitalizeWords(stringToCapitalize) {
	var $strToArray = stringToCapitalize.split("_");
	var newString = "";
	$($strToArray).each(function(){
		var capitalizeLetter = this.charAt(0).toUpperCase();
		var resWord = this.substring(1);
		newString += capitalizeLetter + resWord + "%20";
	});
	var newStringLength = newString.length;
	newString = newString.substring(0, newStringLength);
	return newString;
}