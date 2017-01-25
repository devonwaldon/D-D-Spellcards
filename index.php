<?php


?>

<link type="text/css" rel="stylesheet" href="style.css">

<!-- <h1>Spellcards</h1> -->

<?php
// Spell JSON modified from https://raw.githubusercontent.com/jcquinlan/dnd-spells/master/spells.json
$spell_json = file_get_contents('spelldata.json');
$spell_data = json_decode($spell_json)->jsonSpellData;

foreach ($spell_data as $spell) :
	// var_dump($spell);
?>

	<div class="spellcard">

		<div class="spellcard__top">
			<h1><?php echo $spell->name; ?></h1>
			<h2><?php echo $spell->level.' '.$spell->school; ?><?php echo $spell->ritual == 'yes' ? ', Ritual' : ''; ?></h2>
			<div class="top__level-bubble"><?php echo substr($spell->level, 0, 1); ?></div>

		</div>

		<div class="spellcard__body">
			<div class="spellcard__meta"><label>Range: </label><?php echo $spell->range; ?></div>
			<div class="spellcard__meta"><label>Cast Time: </label><?php echo $spell->casting_time; ?></div>
			<div class="spellcard__meta"><label>Duration: </label><?php echo $spell->duration; ?><?php echo $spell->concentration == 'yes' ? ', Concentration' : ''; ?></div>
			<div class="spellcard__meta"><label>Components: </label><?php echo $spell->components; ?></div>
			<?php if (isset($spell->material)) : ?><div class="spellcard__meta"><label>Material: </label><?php echo $spell->material; ?></div><?php endif; ?>

			<p><?php echo $spell->desc; ?></p>

		</div>

		<div class="spellcard__bottom">
			<?php echo $spell->page; ?>

		</div>

		<?php //echo $spell->class; ?>


	</div>


<?php endforeach; ?>
