<div class="modal fade" id="questionModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p>Got a question? Fill in your email address and your question and we&rsquo;ll get back to you as soon as possible.</p>
			</div>
			<div class="modal-body">
				<form id="question_form1" method="POST">
					<div class="form-group">
						<label for="first_name">First Name:</label>
						<input class="form-control" type="text" id="first_name" name="first_name" />
					</div>
					<div class="form-group">
						<label for="last_name">Last Name:</label>
						<input class="form-control" type="text" id="last_name" name="last_name" />
					</div>
					<div class="form-group">
						<label for="email_address">Email Address:</label>
						<input class="form-control" type="email" id="email_address" name="email_address" />
					</div>
					<div class="form-group">
						<label for="question_text">Question:</label>
						<textarea class="form-control" id="question_text" name="question_text" rows="5" cols="18"></textarea>
					</div>
					<div class="form-group">
						<button id="submit_question" class="btn w-100">Send Question</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>