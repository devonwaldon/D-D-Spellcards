<?php



?>


<html>

<head>
	<title>Spell Card Generator | DevonWaldon</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="background-image" style="background-image: url('img/background.jpg');"></div>

	<div id="page-content" class="container">

		<div class="row">
			<div class="col-xs-12">

				<div class="title">
					<h1>
						Spellcard Generator
					</h1>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

				<div class="dice">
					<img src="img/title-dice.svg" alt="">
				</div>

				<div id="main-content" class="content-wrapper">
					<p>Use this page to generate spellcards for tabletop roleplaying games. Select your class, level, and source material, and either print all available spells or hand-pick just the spells you want.</p>

					<form action="generate-cards.php" id="deck__settings" target="_blank">

						<div class="row">
							<div class="col-sm-6">
								<label for="deck__class">Spell Class</label>
								<div class="select-wrapper">
									<select name="deck__class" id="deck__class" class="field--half">
										<option value="any">-- Any --</option>
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
								<label for="deck__level">Spell Level</label>
								<div class="select-wrapper">
									<select name="deck__level" id="deck__level" class="field--half">
										<option value="any">-- All --</option>
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

						<label for="deck__source">Source Material</label>
						<fieldset id="deck__source">
							<input type="checkbox" name="deck__use-phb" id="phb" value="phb" checked>
							<label for="phb">Player's Handbook</label>

							<input type="checkbox" name="deck__use-ee" id="ee" value="ee pc">
							<label for="ee">Elemental Evil Player's Companion</label>

							<input type="checkbox" name="deck__use-scag" id="scag" value="scag">
							<label for="scag">Sword Coast Adventurer's Guide</label>

							<input type="checkbox" name="deck__use-trot" id="trot" value="trot spells">
							<label for="trot">The Rise of Tiamat</label>
						</fieldset>

						<div class="form-actions">
							<button type="submit" form="deck__settings" value="Generate Cards" class="btn">Generate Cards</button>
							or
							<button type="submit" form="deck__settings" value="Select Spells" class="btn">Select Spells</button>
						</div>

					</form>

					<p>Don't see the spell you need? Got a great idea for a spell that doesn't exist yet? <a href="#" data-toggle="modal" data-target="#modal--add-spell">Add a custom spell</a> or <a href="#" data-toggle="modal" data-target="#modal--add-source">upload your own spell source file</a>*.</p>
					<p class="small">* See our <a href="#" target="_blank">GitHub documentation</a> for necessary formatting.</p>

				</div>

				<?php include 'custom-spell-modal.php'; ?>
				<?php include 'custom-deck-source-modal.php'; ?>

			</div>
		</div>
	</div>


</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery.fittext.js"></script>
<script src="js/main.js"></script>

</html>