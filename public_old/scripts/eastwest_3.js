/**********************************/
/*********Picture Page*************/
$(document).on("pagecreate", "#pictures_page", function()
{		

//Add active class to clicked link
	$("#pictures_div a").on("tap", function(e){
		e.preventDefault();
		collapsePics($(this).parent().parent().attr("id"));
	});
//Add pictures to the modal div	and show in modal with overlay
	$("body").on("tap", ".new_orleans_picture, .bermuda_picture, .bahamas_picture, .cali_picture, .st_louis_picture, .new_york_picture, .jam_picture, .las_vegas_picture", function(){
		$("#pictures_page .mobile_overlay, #pictures_page .mobile_modal, .mobile_modal_swipes").show();
		var getClass = $(this).attr("class");
		var allGroupPics = $("."+getClass);
		collapsePics();
		$(allGroupPics).each(function(){
			var clonedPic = $(this).clone();
			$(clonedPic).css({margin:"0%", width:"100%", height:"100%"});
			$(clonedPic).appendTo("#pictures_page .mobile_modal").hide();
		});
		$("#pictures_page .mobile_modal img:first-of-type").show();
	});	

//Move pictures to the left
	$("body").on("swipeleft", ".mobile_modal img", function(){
		var maxLength = $("#pictures_page .mobile_modal img").length;
		var images = $("#pictures_page .mobile_modal img");
		if(this == images[0])
		{
			$(this).hide();
			$(images[maxLength-1]).show();
		}
		else
		{
			$(this).hide();
			$(this).prev().show();
		}
	});

//Move pictures to the right
	$("body").on("swiperight", ".mobile_modal img", function(){
		var maxLength = $("#pictures_page .mobile_modal img").length;
		var images = $("#pictures_page .mobile_modal img");
		if(this == images[maxLength-1])
		{
			$(this).hide();
			$(images[0]).show();
		}
		else
		{
			$(this).hide();
			$(this).next().show();
		}
	});
	
//Close modal and reset images variabled
	$("body").on("tap", ".mobile_overlay", function(){
		$("#pictures_page .mobile_overlay, #pictures_page .mobile_modal, .mobile_modal_swipes").fadeOut(function(){});
			$("#pictures_page .mobile_modal img").each(function(){
				$(this).remove();
			});
	});
});


/**********************************/
/*********Suggestion Page*************/
$(document).on("pagecreate", "#suggestion_page", function()
{
//Show option for other suggestion
	$("body").on("tap", ".submitSuggestion, .submitOtherSuggestion", function(e){
		e.preventDefault();
		$(this).attr("disabled", true);
		
		if($(this).hasClass("submitSuggestion"))
		{
			if($(".next_location option:selected").val() == "Other")
			{
				$("#suggestion_other").popup("open");
				$(".submitSuggestion").removeAttr("disabled");
				$(".submitOtherSuggestion").removeAttr("disabled");
			}
			else
			{
				$.post("m.confirm_question_suggestion_form2.php", 
					$("#suggestion_form1").serialize(), 
					function(data){
						$.ajax({url: "e2w.suggestions.php",
							cache: false,
							success: function(data){
								var suggestionResults = $(data).find(".suggestion_results_load");
								var suggestionResults2 = $(data).find("#suggestion_results");
								$("#suggestion_data_content").append("<p>Thanks for the suggestion. See the updated results below.</p>").append(suggestionResults2);
								$("#suggestion_page_content").html(suggestionResults).enhanceWithin();
								$("#suggestion_data").popup("open");
								$(".submitSuggestion").removeAttr("disabled");
								$(".submitOtherSuggestion").removeAttr("disabled");
							}
						});
				});
			}
		}
		else
		{
			var otherValue = $(".otherInputOption").val();
			if(otherValue == "")
			{
				$("#suggestion_error_content .returned_error_content").text("Please enter a suggestion");
				$("#suggestion_other").popup("close");
				setTimeout(function(){
					$("#suggestion_errors").popup("open");
					$(".submitSuggestion").removeAttr("disabled");
					$(".submitOtherSuggestion").removeAttr("disabled");
				}, 500);
			}
			else
			{
				$("#suggestion_other").popup("close");
				$.post("m.confirm_question_suggestion_form2.php", 
					{next_location:"Other", other_location:otherValue},
					function(){
						$.ajax({url: "e2w.suggestions.php",
							cache: false,
							success: function(data){
								var suggestionResults = $(data).find(".suggestion_results_load");
								var suggestionResults2 = $(data).find("#suggestion_results");
								$("#suggestion_data_content").append("<p>Thanks for the suggestion. See the updated results below.</p>").append(suggestionResults2);
								$("#suggestion_page_content").html(suggestionResults).enhanceWithin();
								$(".otherInputOption").val("");
								setTimeout(function(){
									$("#suggestion_data").popup("open");
									$(".submitSuggestion").removeAttr("disabled");
									$(".submitOtherSuggestion").removeAttr("disabled");
								}, 500);
							}
						});
					}
				);
			}	
		}
	});

	$("#suggestion_data").on("popupafterclose", function(){
		$("#suggestion_data_content").empty();
		$("#suggestion_data").popup("close");
		$(".submitSuggestion").removeAttr("disabled");
		$(".submitOtherSuggestion").removeAttr("disabled");
	});

	$("#suggestion_errors").on("popupafterclose", function(){
		$("#suggestion_other").popup("open");
		$(".submitSuggestion").removeAttr("disabled");
		$(".submitOtherSuggestion").removeAttr("disabled");
	});
});	


/**********************************/
/*********Question Page*************/
$(document).on("pagecreate", "#question_page", function()
{
	$("#submit_question").on("tap", function(e){
		e.preventDefault();
		$(this).attr("disabled", true);
		var firstName = $("#question_page #first_name").val();
		var lastName = $("#question_page #last_name").val();
		var email = $("#question_page #email_address").val();
		var question = $("#question_page #question_text").val();
		var questionPage = "#question_page";
		var errors = checkErrors(questionPage, firstName, lastName, email, question);
		
		if(errors > 0)
		{
			$("#question_errors").popup("open");
		}
		else
		{
			$.post("m.question_form.php", 
				$("#question_form1").serialize(),
				function(data){
					$("#question_page .returned_data_content").append(data);
					$("#question_confirmation").popup("open");
					$("#question_page #question_form1 input, #question_page #question_form1 textarea").val("");
					$("#submit_question").removeAttr("disabled");
			});
		}
	});

	$("#question_confirmation, #question_errors").on("popupafterclose", function(){
		$("#question_page .returned_data_content").empty();
		$(".returned_error_content").empty();
		$("#submit_question").removeAttr("disabled");
	});

});

/****************************************************/
/****************Video Page*************************/
$(document).on("pagecreate", "#video_page", function(){
	setTimeout(function(){
		var videoHeight = $("#the_price_is_right").height();
		$("#diva_contest").css({
			minHeight:videoHeight+"px", 
			height:(videoHeight)+"px",
			maxHeight:(videoHeight+50)+"px"
		});
	}, 500);
});

/********************************************************/
/*************************Disney Page*******************/
$(document).on("pagecreate", "#disney_page", function(){
	$("#disney_page").on("tap", "#disney_page_submit", function(e){
		e.preventDefault();
		$(this).attr("disabled", true);
		var firstName = $("#disney_page #first_name").val();
		var lastName = $("#disney_page #last_name").val();
		var email = $("#disney_page #email_address").val();
		var disneyPage = "#disney_page";
		var errors = checkErrors(disneyPage, firstName, lastName, email, "empty");

		if(errors > 0){
			$("#disney_page_sign_up").popup("close");
			$("#disney_page_sign_up").on("popupafterclose", function(){
				if(errors > 0)
				{
					$("#disney_errors").popup("open");
					$("#disney_page_submit").removeAttr("disabled");
				}
			});
			$("#disney_errors").on("popupafterclose", function(){
				if(errors > 0)
				{
					$("#disney_page_sign_up").popup("open");
					errors = 0;
				}
			});
		}
		else
		{
			$("#disney_page_sign_up").popup("close");
			$("#disney_page_submit").removeAttr("disabled");
			$.post("m.disneyRegistration.php", 
				$("#m_disney_registration").serialize(), 
				function(data){
					$("#disney_page .returned_data_content").append(data);
					$("#disney_confirmation").popup("open");
					$("#m_disney_registration input").val("");
				}
			);
		}
	});

	$("#disney_confirmation, #disney_errors").on("popupafterclose", function(){
		$("#disney_page .returned_data_content").empty();
		$("#disney_page .returned_error_content").empty();
		$("#disney_page_submit").removeAttr("disabled");
	});
});


/*******************************/
/***********Functions**********/
function collapsePics(showingPics){
	var getAllPicsDivs = [$("#bahamas_pics"),
							$("#bermuda_pics"),
							$("#cali_pics"),
							$("#cruise_pics"),
							$("#jamaica_pics"),
							$("#vegas_pics"),
							$("#no_pics"),
							$("#ny_pics"),
							$("#st_louis_pics")
						];
	var allLinks = $(".picsDiv a");
	var showingPicsDiv = showingPics != "" ? showingPics : "undefined";

	$(allLinks).each(function(){
		$(this).removeClass("activeLink");	
	});
	$(getAllPicsDivs).each(function(){
		if(!($(this).attr("id") == showingPics))
		{
			$(this).collapsible("collapse");			
		}
	});
	
	switch($("#"+showingPicsDiv).hasClass("ui-collapsible-collapsed"))
	{
		case false:
			$("#"+ showingPicsDiv).collapsible("collapse");
			break;
		case true: 
			$("#"+ showingPicsDiv).collapsible("expand");
			$("#"+ showingPicsDiv + " a").addClass("activeLink");
			break;
	}
}

$(function () 
{
  $("[data-role=panel]").enhanceWithin().panel();
});

$(function ()
{
	var getWindowHeight = window.innerHeight;
	var getWindowWidth = window.innerWidth;
	var topHeight = getWindowHeight * 0.25;
	var modalMinHeight = getWindowHeight * 0.50;
	var modalMaxHeight = getWindowHeight * 0.70;
	var modalHeight = getWindowHeight * 0.60;
	var leftWidth = getWindowWidth * 0.07;
	var modalMinWidth = getWindowWidth * 0.85;
	var modalMaxWidth = getWindowWidth * 0.86;
	var modalWidth = getWindowWidth * 0.85;
	var picsWidth = ((getWindowWidth - 64)/2) - 4;
	
	$(".mobilePageContent").each(function(){
		$(this).css({minHeight:getWindowHeight});
	});
	$("#pictures_page .mobile_modal").css(
		{
			top:topHeight+"px", 
			minHeight:modalMinHeight+"px", 
			maxHeight:modalMaxHeight+"px", 
			height:modalHeight+"px",
			left:leftWidth+"px",
			minWidth:modalMinWidth+"px",
			maxWidth:modalMaxWidth+"px",
			width:modalWidth+"px"
		}
	);
	$(".picsDiv img").each(function(){
		$(this).css({width:picsWidth+"px", height:picsWidth+"px"});
	});
});

function checkErrors(requestedPage, firstName, lastName, emailAddress, question)
{
	var firstName = firstName;
	var lastName = lastName;
	var email = emailAddress;
	var question = question;
	var requestedPage = requestedPage;
	var errors = 0;
	var errorMsg = "";
	if(firstName == "")
	{
		errors++;
		errorMsg += errors+". First name cannot be blank.<br/>";
	}
	if(lastName == "")
	{
		errors++;
		errorMsg += errors+". Last name cannot be blank.<br/>";
	}
	if(email == "")
	{
		errors++;
		errorMsg += errors+". Email cannot be blank.<br/>";
	}
	if(question == "")
	{
		errors++;
		errorMsg += errors+". Your question cannot be blank.<br/>";
	}
	$(requestedPage + " .returned_error_content").append(errorMsg);
return errors;
}
