<?php

	$deck_options = array();
	foreach ($_GET as $key => $value) {
		if (substr($key, 0, 10) === 'deck__use-') {
			$deck_options['use'][substr($key, 10)] = $value;
			continue;
		}
		if (substr($key, 0, 6) === 'deck__') {
			$deck_options[substr($key, 6)] = $value;
		}
	}

	// If any of the base selections is made...
	$spell_json = file_get_contents('spelldata.json');
	$spell_data = json_decode($spell_json)->jsonSpellData;

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
					<?php var_dump($deck_options); ?>
					<?php
					foreach ($spell_data as $spell) {
						// Check against source
						$spell_source = trim(preg_replace("/[0-9]/", "", $spell->page));
						if (!array_key_exists('use', $deck_options) || !in_array($spell_source, $deck_options['use'])) {
							continue;
						}

						// Check against class
						$card_class_options = explode(', ', strtolower($spell->class));
						if ($deck_options['class'] !== 'any' && !in_array($deck_options['class'], $card_class_options)) {
							continue;
						}

						// Check against level
						$spell_level = preg_replace("/[^0-9]/", "", $spell->level);
						if ($spell_level == '') {
							$spell_level = '0';
						}
						if ($deck_options['level'] !== 'any' && $deck_options['level'] !== $spell_level) {
							continue;
						}

						var_dump($spell);
					}
					?>
				</div>

			</div>
		</div>
	</div>


</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery.fittext.js"></script>
<script src="js/main.js"></script>

</html>