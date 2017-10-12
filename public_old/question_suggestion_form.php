<div id="question_form" class="navContent">		
	<p>Got a question? Fill in your email address and your question and we&rsquo;ll get back to you as soon as possible.</p>
	<form id="question_form1" method="POST">
		<table id="question_form_table">
			<tr><td><label for="first_name"><strong>First Name:</strong></label></td><td><input class="questionFormInput" type="text" id="first_name" name="first_name"></input></td></tr>
			<tr><td><label for="last_name"><strong>Last Name:</strong></label></td><td><input class="questionFormInput" type="text" id="last_name" name="last_name"></input></td></tr>
			<tr><td><label for="email_address"><strong>Email Address:</strong></label></td><td><input class="questionFormInput" type="email" id="email_address" name="email_address"></input></td></tr>
			<tr><td><label for="question_text"><strong>Question:</strong></label></td><td><textarea class="questionFormInput" id="question_text" name="question_text" rows="5" cols="18"></textarea></td></tr>
		</table>
		<button id="submit_question">Submit Question</button>
	</form>		
</div>
<div id="suggestion_form" class="navContent">
	<p>Where to Next? Help us decide where our next travel location should be!</p>
	<form id="suggestion_form1" method="POST">
		<ul>
			<li><input class="nextLocation" id="niagra_falls" type="radio" name="next_location" value="Niagra Falls" checked /><span>Niagra Falls</span></li>
			<li><input class="nextLocation" type="radio" name="next_location" value="Toronto" /><span>Toronto</span></li>
			<li><input class="nextLocation" type="radio" name="next_location" value="DC" /><span>Washington D.C</span></li>
			<li><input class="nextLocation" type="radio" name="next_location" value="Miami" /><span>Miami</span></li>
			<li><input class="nextLocation" type="radio" name="next_location" value="Houston" /><span>Houston</span></li>
			<li>
				<input type="radio" name="next_location" id="other_option" value="Other" /><span>Other</span>
				<input type="text" name="other_location" id="other_location2" placeholder="Example: Disney Land" disabled />
			</li>
		</ul>
		<button id="submit_suggestion">Submit Suggestion</button>
	</form>
</div>