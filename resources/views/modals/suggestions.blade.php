<div class="modal fade" id="suggestionModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p>Where to Next? Help us decide where our next travel location should be!</p>
			</div>
			<div class="modal-body">
				<form id="suggestion_form1" method="POST">
					<div class="custom-controls-stacked">
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="niagra_falls" type="radio" name="next_location" value="Niagra Falls" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Niagra Falls</span>
						</label>
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="Toronto" type="radio" name="next_location" value="Toronto" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Toronto</span>
						</label>
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="DC" type="radio" name="next_location" value="DC" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Washington D.C.</span>
						</label>
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="Miami" type="radio" name="next_location" value="Miami" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Miami</span>
						</label>
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="Houston" type="radio" name="next_location" value="Houston" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Houston</span>
						</label>
						<label class="custom-control custom-radio">
							<input class="nextLocation custom-control-input" id="other_option" type="radio" name="next_location" value="Houston" />
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Other</span>
							<input type="text" name="other_location" id="other_location2" placeholder="Example: Disney Land" disabled />
						</label>
					</div>
					</ul>
					<button id="submit_suggestion" class="btn w-100">Send Suggestion</button>
				</form>
			</div>
		</div>
	</div>
</div>