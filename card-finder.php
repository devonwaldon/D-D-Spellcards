<?php

$selected_spell = false;
if (array_key_exists('spell', $_GET)) {
	$selected_spell = $_GET['spell'];
}

?>
<html>

<!-- <h1>Spellcards</h1> -->

<?php
// Spell JSON modified from https://raw.githubusercontent.com/jcquinlan/dnd-spells/master/spells.json
$spell_json = file_get_contents('spelldata.json');
$spell_data = json_decode($spell_json)->jsonSpellData;?>


<form action="generate-svg.php">
	<select name="spell" id="spell">
		<?php foreach ($spell_data as $key=>$spell) :
			$name = $spell->name; ?>
			<option value="<?php echo $key; ?>" <?php echo $selected_spell == $key ? 'selected' : ''; ?>><?php echo $name; ?></option>
		<?php endforeach; ?>
	</select>

	<input type="submit">
</form>

<?php if ($selected_spell):
	$spell = $spell_data[$selected_spell];


	?>
	<div class="spellcard">

		<div class="spellcard__top">
			<h1><?php echo $spell->name; ?></h1>
			<h2><?php echo $spell->level.' '.$spell->school; ?><?php echo $spell->ritual == 'yes' ? ', Ritual' : ''; ?></h2>
			<h5><?php echo $spell->class; ?></h5>
		</div>

		<div class="spellcard__body">
			<div class="spellcard__meta"><label>Range: </label><?php echo $spell->range; ?></div>
			<div class="spellcard__meta"><label>Cast Time: </label><?php echo $spell->casting_time; ?></div>
			<div class="spellcard__meta"><label>Duration: </label><?php echo $spell->duration; ?><?php echo $spell->concentration == 'yes' ? ', Concentration' : ''; ?></div>
			<div class="spellcard__meta"><label>Components: </label><?php echo $spell->components; ?></div>
			<?php if (isset($spell->material)) : ?><div class="spellcard__meta"><label>Material: </label><?php echo $spell->material; ?></div><?php endif; ?>

			<div class="spellcard__description">
				<?php echo $spell->desc; ?>
				<?php echo isset($spell->higher_level) ? $spell->higher_level : '' ; ?>
			</div>

		</div>

		<div class="spellcard__bottom">
			<?php echo $spell->page; ?>
			<span class="spellcard__count"></span>

		</div>

	</div>
<?php endif ?>




</html>