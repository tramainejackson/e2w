<div class="actionBtnDiv d-flex flex-column justify-content-center">

	<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
		<a href="#" id="home_btn" class="btn btn-lg actionBtns text-dark py-3" disabled>Home</a>
	</div>

	<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
		<button id="question_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".questionModal">Ask A Question</button>
	</div>

	{{--<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">--}}
		{{--<a id="suggestion_btn" class="btn btn-lg actionBtns py-3" data-toggle="modal" data-target=".suggestionModal">Suggestions</a>--}}
	{{--</div>--}}

	<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
		<a href="{{ route('contact_us') }}" id="contact_us_btn" class="btn btn-lg actionBtns text-dark py-3">Contact Us</a>
	</div>

	<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
		<a href="{{ route('about_us') }}" id="about_us_btn" class="btn btn-lg actionBtns text-dark py-3">About Us</a>
	</div>

	<div class="col-12 col-sm-12 mx-sm-auto my-sm-3">
		<a href="{{ route('login') }}" id="admin_page_btn" class="btn btn-lg actionBtns text-dark py-3">Admin</a>
	</div>
</div>

<div id="mobile_action_btns">
	<div class="mobileMenuBtn">
		<a href="#" class="mobileMenuLink">Menu</a>
		<img src="images/menu.png" class="menuImg" />
	</div>
	<div class="mobileBtns">
		<button id="home_btn_mobile" class="">Home</button>
		<button id="question_btn_mobile" class="">Ask A Question</button>
		<button id="suggestion_btn_mobile" class="">Suggestion</button>
		<button id="contact_us_btn_mobile" class="">Contact Us</button>
		<button id="about_us_btn_mobile" class="">About Us</button>
		<button id="photos_btn_mobile" class="">Photos</button>
	</div>
</div>