<!-- Add Spell Modal -->
<div id="modal--add-spell" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button class="close" data-dismiss="modal"><span class="icon-close"></span></button>
				<div class="modal-title">Add Custom Spell</div>
			</div>

			<div class="modal-body">
				<p>Fill out the required fields below and click 'Add Spell'. The spell will be added in the <em>User Added Spells</em> source.</p>

				<form action="" id="custom-spell__settings">

					<label for="custom-spell__name">Spell Name <span class="required">*</span></label>
					<input type="text" name="custom-spell__name" id="custom-spell__name" required>

					<div class="row">
						<div class="col-sm-6">
							<label for="custom-spell__class">Spell Class <span class="required">*</span></label>
							<div class="select-wrapper">
								<select name="custom-spell__class" id="custom-spell__class" class="field--half" required>
									<option value="bard">Bard</option>
									<option value="paladin">Paladin</option>
									<option value="druid">Druid</option>
									<option value="ranger">Ranger</option>
									<option value="cleric">Cleric</option>
									<option value="sorcerer">Sorcerer</option>
									<option value="warlock">Warlock</option>
									<option value="wizard">Wizard</option>
								</select>
							</div>
						</div>

						<div class="col-sm-6">
							<label for="custom-spell__level">Spell Level <span class="required">*</span></label>
							<div class="select-wrapper">
								<select name="custom-spell__level" id="custom-spell__level" class="field--half" required>
									<option value="0">0 (Cantrip)</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<label for="custom-spell__type">Spell Type <span class="required">*</span></label>
							<input type="text" name="custom-spell__type" id="custom-spell__type" class="field--half" required>
						</div>

						<div class="col-sm-6">
							<label for="custom-spell__range">Spell Range <span class="required">*</span></label>
							<input type="text" name="custom-spell__range" id="custom-spell__range" class="field--half" required>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<label for="custom-spell__cast-time">Spell Cast Time <span class="required">*</span></label>
							<input type="text" name="custom-spell__cast-time" id="custom-spell__cast-time" class="field--half" required>
						</div>

						<div class="col-sm-6">
							<label for="custom-spell__duration">Spell Duration <span class="required">*</span></label>
							<input type="text" name="custom-spell__duration" id="custom-spell__duration" class="field--half" required>
						</div>
					</div>

					<label for="custom-spell__requirements">Spell Requirements</label>
					<fieldset id="custom-spell__requirements">
						<input type="checkbox" id="v" value="v">
						<label for="v">Visual</label>

						<input type="checkbox" id="s" value="s">
						<label for="s">Speech</label>

						<input type="checkbox" id="m" value="m">
						<label for="m">Materials</label>
					</fieldset>

					<label for="custom-spell__materials">Spell Materials</label>
					<input type="text" name="custom-spell__materials" id="custom-spell__materials">

					<label for="custom-spell__dice">Spell Dice</label>
					<input type="text" name="custom-spell__dice" id="custom-spell__dice">

					<label for="custom-spell__description">Spell Description <span class="required">*</span></label>
					<textarea name="custom-spell__description" id="custom-spell__description" required></textarea>

				</form>

			</div>

			<div class="modal-footer">
				<button type="submit" form="custom-spell__settings" value="Add Spell" class="btn">Add Spell</button>
			</div>

		</div>
	</div>
</div>