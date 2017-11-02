$(document).ready(function() {
//Commonly user variables
	var errors;
	var passwordAttempts = 0;
	var adminDivs = $(".adminDiv");
	var counter = 0;
	var registrationForm = $("#disney_registration_form").detach();
	var cruiseForm = $(".cruise_page_additions").detach();
	var disneyForm = $(".disney_page_additions").detach();
	var winHeight = window.innerHeight;
	var winWidth = window.innerWidth;
	var screenHeight = screen.availHeight;
	var screenWidth = screen.availWidth;

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
	
//Make Disney page min height equal to screen height
	$('#disney_world.content_class .content_info').css({minHeight:screenHeight});
	//Toggle mobile menubar	$("body").on("click", ".mobileMenuBtn a", function(e){		e.preventDefault();		$(".mobileBtns").slideToggle();	});	
//Bring up already signed up users for specific trip
	$("body").on("change", "#select_trip_for_new_user, #select_trip_for_new_activity, #select_trip_for_edit", function(e) {
		var newValue = $(this).val();
		console.log($(this).attr("class"));
		if($(this).hasClass("personSelect")) {
			window.open("locations.php?add_person=true&event_users="+newValue, "_self");	
		} else if($(this).hasClass("activitySelect")) {
			window.open("locations.php?trip_activities=true&all_activities="+newValue, "_self");
		} else {
			window.open("locations.php?edit_trip="+newValue, "_self");
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
			window.open("pictures.php?remove_pictures=true&location="+newValue, "_self");	
		} else if($(this).attr("id") == "select_trip_for_new_pictures") {
			window.open("pictures.php?add_pictures=&location="+newValue, "_self");
		} else {
			window.open("pictures.php?location="+newValue, "_self");
		}
	});
	
//Bring up admin user for editing
	$("body").on("change", "#select_user_for_edit", function(e) {
		var newValue = $(this).val();
		var usersName = $("#select_user_for_edit option:selected").text();
		var getName = usersName.slice(0, usersName.indexOf("("));
		var returnName = getName.replace(/\s/, "");
		window.open("e2w_admin.php?edit_users=true&user="+returnName+"&id="+newValue, "_self");
	});	
	
//Transitions once once page loads
	$("#suggestion_form, #question_form, #contact, #home_content").appendTo(".maine_modal");
	
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
	
//Suggestion display box
	$("body").on("click", ".nextLocation, #other_option", function(e){
		if($(this).attr("class") == "nextLocation")
		{
			$("#other_location2").attr("disabled", true).val("");
		}
		else
		{
			$("#other_location2").removeAttr("disabled");
		}
	});
	$("body").on("click", "#suggestion_btn", function(e)
	{
		$("p.modal_title").text("Give us a Suggestion");
		$("#suggestion_form, #question_form, #contact, #home_content").hide();
		$("#suggestion_form").show("fast", function()
		{ 
			$(".maine_overlay, .maine_modal").fadeIn(); 
		});
	});	
	
//Question display box
	$("body").on("click", "#question_btn", function(e)
	{
		$("p.modal_title").text("Ask us a Question");
		$("#suggestion_form, #question_form, #contact, #home_content").hide();
		$("#question_form").show("fast", function()
		{ 
			$(".maine_overlay, .maine_modal").fadeIn(); 
		});
	});		
	
//Bring up about us information	
	$("body").on("click", "#about_us_btn", function(e)	{
		$("p.modal_title").text("A Little Bit About Us");
		$("#suggestion_form, #question_form, #contact, #home_content").hide();
		$("#home_content").show("fast",	function()
		{ 
			if(window.outerWidth < 768)
			{
				$(".maine_overlay").css({margin:"0% 0% 0% -35%"}).fadeIn();
				$(".maine_modal").fadeIn();
			}
			else
			{
				$(".maine_overlay, .maine_modal").fadeIn(); 
			}
		});
	});
	
	//Bring up contact information	
	$("body").on("click", "#contact_us_btn", function(e)
	{
		$("p.modal_title").text("Contact Us");
		$("#suggestion_form, #question_form, #contact, #home_content").hide();
		$("#contact").show("fast", function()
		{ 
			$(".maine_modal").css({"max-height":"65%"});
			$(".maine_overlay, .maine_modal").fadeIn();
		});
	});		
	
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
	
//Home page redirect
	// $("body").on("click", "#home_btn", function(e) {
		// window.open("index.php", "_self");
	// });
	
//Admin page redirect	
	// $("body").on("click", "#admin_page_btn", function(e) {
		// window.open("../admin/index.php", "_self");
	// });

//Send suggestion form 
	$("body").on("click", "#submit_suggestion", function(e)
	{
		e.preventDefault();
		$(".confirm_modal_title").text("Suggestion Confirmation");
		$("#submit_suggestion").attr("disabled", true);
		$.post("confirm_question_suggestion_form2.php",
			$("#suggestion_form1").serialize(),
			function(data)
			{					
				$(".maine_modal").hide("slow");				
				setTimeout(function()
				{
					$(".maine_modal_confirmation_box").append(data).fadeIn();
					$("#other_location2").attr("disabled", true).val("");
					$("#suggestion_form #niagra_falls").prop("checked", true);
				}, "500");		
				setTimeout(function()
				{
					$(".maine_modal_confirmation_box, .maine_overlay, #suggestion_form").fadeOut("slow", function(){
						$(".maine_modal_confirmation_box *:not(.confirm_modal_title)").remove();
						$("#submit_suggestion").removeAttr("disabled");
					});
				}, "10000");				
			});	
	});	
//Send question form
	$("body").on("click", "#submit_question", function(e)
	{
		e.preventDefault();
		errors = 0;
		checkErrors();
		
		if(errors < 1)
		{
			$(".confirm_modal_title").text("Question Confirmation");
			$("#submit_question").attr("disabled", true);
			$.post(	"confirm_question_suggestion_form.php",	$("#question_form1").serialize(), function(data) {
				$(".maine_modal").hide("slow");
				setTimeout(function()
				{
					$(".maine_modal_confirmation_box").append(data).fadeIn();
				}, "500");		
				setTimeout(function()
				{
					$(".maine_modal_confirmation_box, .maine_overlay, #question_form").fadeOut("slow", function(){
						$(".maine_modal_confirmation_box *:not(.confirm_modal_title)").remove();
						$("#submit_question").removeAttr("disabled");
						$("#question_form1 input, #question_form1 textarea").val("");
					});
				}, "12000");	
			});
		}
		else 
		{
			$(".maine_modal_error").show();
		}
	});
//Bring up pictures
	if($(".maine_modal_picture").length > 0) {
		var $getPictures = $(".maine_modal_picture img");
		var $getCaptions = $(".maine_modal_picture .pictureCaption");
		$getPictures.not($getPictures[0]).hide();
		$getCaptions.not($getCaptions[0]).hide();
	}
	
//Scroll through pictures
	$("body").on("click", ".prevLeft, .nextRight", function(e){
		var movePicture = $(this).attr("class");
		scrollPics(movePicture);
	});
	
//User Registration
	/*$(".signupForm").submit(function(e) {
		e.preventDefault();
		var userFirstName = $(".first_name_input").val();
		var userLastName = $(".last_name_input").val();
		var userEmail = $(".email_input").val();
		
		if(userFirstName == "" || userLastName == "" || userEmail == "") {
			var errors = "<div class=\"errors\"><ul>";
			errors += "<li class='errorItem'>All fields must be filled in.</li>";
			errors += "</ul></div>";
			$(errors).appendTo("#return_messages");
		} else {
			$.post("user_signup.php", $(".signupForm").serialize(), function(data) {					
				var r			
			})
			.done(function() {
				var complete = "<div class=\"message\"><ul>";
				complete += "<li class='okItem'>Thanks you for your interest. Please check your email. We will send you additional information regarding the trip.</li>";
				complete += "</ul></div>";
				$(complete).appendTo("#return_messages");
			});
		}
		setTimeout(function() {
			$(".errors, .message").fadeOut();
		}, 7000);
	});*/
//Cancel current update and enable button
	$("body").on("click", ".name_data_rows_disney .cancelSave", function(e){
		$(this).parent().prev().find(".save_disney_user").replaceWith("<button class='edit_disney_user'>Edit</button>");
		$(this).parent().parent().find("input, textarea").css({backgroundColor:"transparent"}).attr("disabled", true);
		$("button").removeAttr("disabled");
		$(".edit_disney_user").css({backgroundColor:"darkred"});
		$(".navScrollBtn").css({backgroundColor:"buttonface"});
		$(this).replaceWith("<button class='delete_disney_user'>Delete</button>");
	});
	$("body").on("click", ".name_data_rows_cruise .cancelSave", function(e){
		$(this).parent().prev().find(".save_cruise_user").replaceWith("<button class='edit_cruise_user'>Edit</button>");
		$(this).parent().parent().find("input, textarea").css({backgroundColor:"transparent"}).attr("disabled", true);
		$("button").removeAttr("disabled");
		$(".edit_cruise_user").css({backgroundColor:"darkred"});
		$(".navScrollBtn").css({backgroundColor:"buttonface"});
		$(this).replaceWith("<button class='delete_cruise_user'>Delete</button>");
	});
	
//Bring up warning modal before deleting users
	$("body").on("click", ".delete_disney_user, .delete_cruise_user", function(e){
		e.preventDefault();
		var firstName = $(this).parent().parent().find(".eFirstname").val();
		var lastName = $(this).parent().parent().find(".eLastname").val();
		var userID = $(this).parent().parent().find(".eUser_id").val();
		var deleteMsg = "Are you sure you want to delete " + firstName + " " + lastName + " from the list of people going? <input type='number' value='"+userID+"'hidden/>";
		$(".maine_overlay, .maine_modal_delete").fadeIn();
		$(".delete_modal_content").append(deleteMsg);
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
	
//Remove error modal
	/*$("body").on("focus", ".first_name_input, .last_name_input, .email_input, #first_name, #last_name, #email_address, #question_text", function(e){
		$("input, textarea").removeClass("errorBorder");
		$(".maine_modal_error").fadeIn(function(){
			$(".error_modal_content").empty();
		});
	});*/
//Bring up trip inclusions
	$("body").on("click", ".inclusionsBtn", function(){
		var inclusions = $(".termsInclusions").clone();
		$(inclusions).insertAfter(".maine_modal .modal_title");
		$(".modal_title").text("Also Includes");
		$(".maine_modal").addClass("addModalPic");
		$(".maine_modal .termsInclusions").show(function(){ 
			$(".maine_overlay, .maine_modal").fadeIn();
		});
	});
	
//Remove pictures modal
	$("body").on("click", ".maine_overlay_pictures, .maine_overlay_pictures .closeBtn", function(){
		var showingPics = $(".maine_modal_picture img");
		var picsHomeDiv = $("#"+showingPics.attr("class")+"s");
		$(".maine_overlay_pictures, .maine_modal_picture, .maine_modal_videos").fadeOut(function(){
			$(showingPics).each(function(){
				$(this).css({display:"none"}).appendTo(picsHomeDiv);
			});
		});
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
	
//Move pictures left and right
function scrollPics(direction) {
	var getAllPics = $(".maine_modal_picture img");
	var picsLength = $(".maine_modal_picture img").length;
	var currentPic = $(".maine_modal_picture img")[counter];
	var currentCaption = $(".maine_modal_picture .pictureCaption")[counter];
	var scrollDirection = direction;
	if(scrollDirection == "prevLeft") {
		if(counter >= 1) {
			$(currentCaption).hide();
			$(currentPic).fadeOut(function() {
				counter--;
				currentPic = $(".maine_modal_picture img")[counter];
				currentCaption = $(".maine_modal_picture .pictureCaption")[counter];
				$(currentPic).fadeIn();
				$(currentCaption).show();
			});
		} else {
			$(currentCaption).hide();
			$(currentPic).fadeOut(function() {
				counter = picsLength - 1;
				currentPic = $(".maine_modal_picture img")[counter];
				currentCaption = $(".maine_modal_picture .pictureCaption")[counter];
				$(currentPic).fadeIn();
				$(currentCaption).show();
			});
		}
	} else {
		if(counter < (picsLength - 1)) {
			$(currentCaption).hide();
			$(currentPic).fadeOut(function() {
				counter++;
				currentPic = $(".maine_modal_picture img")[counter];
				currentCaption = $(".maine_modal_picture .pictureCaption")[counter];
				$(currentCaption).show();
				$(currentPic).fadeIn();
			});
		} else	{
			$(currentCaption).hide();
			$(currentPic).fadeOut(function() {
				counter = 0;
				currentPic = $(".maine_modal_picture img")[counter];
				currentCaption = $(".maine_modal_picture .pictureCaption")[counter];
				$(currentCaption).show();
				$(currentPic).fadeIn();
			});
		}
	}
}
});