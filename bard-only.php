<?php


?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
</head>


<!-- <h1>Spellcards</h1> -->

<?php
// Spell JSON modified from https://raw.githubusercontent.com/jcquinlan/dnd-spells/master/spells.json
$spell_json = file_get_contents('spelldata.json');
$spell_data = json_decode($spell_json)->jsonSpellData;

foreach ($spell_data as $spell) :
	$classes = explode(',',$spell->class);
	if (in_array('Bard', $classes)) :
	// var_dump($spell);
?>

	<div class="spellcard">

		<div class="spellcard__top">
			<h1><?php echo $spell->name; ?></h1>
			<h2><?php echo $spell->level.' '.$spell->school; ?><?php echo $spell->ritual == 'yes' ? ', Ritual' : ''; ?></h2>
			<h5><?php echo $spell->class; ?></h5>
			<!-- <div class="top__level-bubble"><?php echo substr($spell->level, 0, 1); ?></div> -->

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

		<?php //echo $spell->class; ?>


	</div>


<?php endif; endforeach; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

	var fitCard = function(card, buffer=0) {
		var card_height = card.outerHeight();
		var top_height = card.find('.spellcard__top').outerHeight();
		var bottom_height = card.find('.spellcard__bottom').outerHeight();

		var description_height = card.find('.spellcard__description').outerHeight() + buffer;
		var description_offset = card.find('.spellcard__description').position().top;
		var available_height = card_height - (top_height + bottom_height) - description_offset;

		if (description_height > available_height) {
			buffer = 30;
			card.addClass('truncated');
			card.find('.spellcard__count').text('1/1');

			// @todo currently destroys formatting. fixy fix?
			var spellDesc = card.find('.spellcard__description').text();
			card.find('.spellcard__description').text(spellDesc.substring(0,spellDesc.length-4) + '...');
			fitCard(card, buffer);
		};
	}

	$('.spellcard:nth-child(1)').each(function(){
		fitCard($(this));
	});

});

</script>

</html>