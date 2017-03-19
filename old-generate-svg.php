<?php

$spell_json = file_get_contents('spelldata.json');
$spell_data = json_decode($spell_json)->jsonSpellData;

if (array_key_exists('spell', $_GET)) {
  $spell = $spell_data[$_GET['spell']];
  $original_spell = array_key_exists('spell', $_GET) ? $_GET['spell'] : '';

  $spell_name = $spell->name;

  $spell_type = $spell->school;
  if ($spell->ritual == 'yes') {
    $spell_type .= ', Ritual';
  }

  $spell_level = preg_replace("/[^0-9]/", "", $spell->level);
  if ($spell_level == '') {
    $spell_level = 'C';
  }

  $spell_description = $spell->desc;

  $spell_range = $spell->range;

  $spell_cast_time = $spell->casting_time;

  $spell_duration = $spell->duration;
  if ($spell->concentration == 'yes') {
    $spell_duration .= ', Concentration';
  }

  $spell_requirements = str_replace(array('V','S','M'),array('Visual','Speech','Material'),$spell->components);

  $spell_materials = isset($spell->material) ? $spell->material : '';

  $spell_dice = isset($spell->dice) ? $spell->dice : ''; //4d6, +1d6 per level above 6th

  $phb_page = $spell->page;

  $card_class_options = explode(', ', strtolower($spell->class));
  $card_class = $card_class_options[0];

} else {
  $original_spell = array_key_exists('original_spell', $_GET) ? $_GET['original_spell'] : '';
  $spell_name = array_key_exists('spell_name', $_GET) ? $_GET['spell_name'] : 'Spell Name';
  $spell_type = array_key_exists('spell_type', $_GET) ? $_GET['spell_type'] : 'Spell Type';
  $spell_level = array_key_exists('spell_level', $_GET) ? $_GET['spell_level'] : '0';
  $spell_description = array_key_exists('spell_description', $_GET) ? $_GET['spell_description'] : "<p>A quick description of the spell</p>";
  $spell_range = array_key_exists('spell_range', $_GET) ? $_GET['spell_range'] : 'Range of the spell';
  $spell_cast_time = array_key_exists('spell_cast_time', $_GET) ? $_GET['spell_cast_time'] : 'Cast time for the spell';
  $spell_duration = array_key_exists('spell_duration', $_GET) ? $_GET['spell_duration'] : 'How long does it last?';
  $spell_requirements = array_key_exists('spell_requirements', $_GET) ? $_GET['spell_requirements'] : 'Visual, Speech, Material?';
  $spell_materials = array_key_exists('spell_materials', $_GET) ? $_GET['spell_materials'] : 'what does the spell use up?';
  $spell_dice = array_key_exists('spell_dice', $_GET) ? $_GET['spell_dice'] : 'Oooooo what do I roll?';
  $phb_page = array_key_exists('phb_page', $_GET) ? $_GET['phb_page'] : 'phb 211';

  $card_class = array_key_exists('card_class', $_GET) ? $_GET['card_class'] : 'generic';
}

$card_colors = array(
  'generic'   => '999999',
  'bard'      => '800080',
  'paladin'   => '48a8c3',
  'druid'     => '64a04a',
  'ranger'    => '624a21',
  'cleric'    => 'd89f11',
  'sorcerer'  => 'c63b2f',
  'warlock'   => 'c63b2f',
  'wizard'    => 'c63b2f',
);

$card_color = $card_colors[$card_class];

?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Arsenal:400,700|Lato:400,400i,700,700i" rel="stylesheet">
  </head>

  <style>
    p {
      font-family: inherit;
      font-size: inherit;
      margin: 0 0 10px;
    }
    input,
    textarea,
    select {
      display: block;
      width: auto;
      margin-bottom: 1rem;
    }
    textarea {
      width: 500px;
      max-width: 100%;
    }
    label {
      font-weight: bold;
      font-size: 0.8rem;
      margin-bottom: 0.5rem;
    }
  </style>

  <a href="index.php">Choose another spell</a>

  <h1>Spell Card Preview</h1>

  <svg id="spell-card"
    xmlns="http://www.w3.org/2000/svg"
    width="450"
    height="270"
    viewbox="0 0 450 270">


    <!-- ==================================================================== -->
    <!-- CARD BACKGROUND BITS -->
    <!-- ==================================================================== -->
    <g id="card_structure">
      <rect id="structure__background--black"
        style="fill:#000000;"
        width="450"
        height="270"
        x="0"
        y="0" />
      <rect id="structure__background--color"
        style="fill:#<?php echo $card_color; ?>;"
        width="430"
        height="250"
        x="10"
        y="10" />
      <path id="structure__background--white-top"
        style="fill:#ffffff"
        d="m 17.330353,16 414.241067,0 c 0,0 4,5.88108 4,18.92857 0,13.04749 -4,18.92857 -4,18.92857 l -414.241067,0 c 0,0 -3.33035,-7.58392 -3.33035,-18.92857 C 14.000003,23.58392 17.330353,16 17.330353,16 z" />
      <path id="structure__background--white-main"
        style="fill:#ffffff;"
        d="M 18.000003,56 432,56 l 0,196.00002 -413.999997,0 z" />
    </g>


    <!-- ==================================================================== -->
    <!-- PLAYER HANDBOOK NUMBER -->
    <!-- ==================================================================== -->
    <text id="phb-page"
      x="405"
      y="267.3"
      style="font-size:7px;fill:#ffffff;font-family:Lato;">
      <?php echo $phb_page; ?></text>


    <!-- ==================================================================== -->
    <!-- TOP BAR -->
    <!-- ==================================================================== -->
    <text id="spell_name"
      x="25.460144"
      y="36.396687"
      style="font-size:18.85394669px;font-family:Arsenal;">
      <?php echo $spell_name; ?></text>

    <text id="spell_type"
       x="25.460144"
       y="48.94788"
       style="font-size:10px;font-style:italic;font-family:Lato;">
       <?php echo $spell_type; ?></text>

    <g id="level-indicator"
      transform="matrix(0.37775189,0,0,0.37775189,397.34927,16.44961)">
      <g id="level-indicator__background"
        transform="translate(0,-952.36216)"
        style="fill:#<?php echo $card_color; ?>;fill-opacity:1">
        <path
          id="path4646-1-1"
          d="m 49.999999,957.36216 -38.971335,22.4997 0,45.00064 1.290604,0.7457 37.680731,21.754 38.971337,-22.4997 0,-45.00064 z" />
      </g>
      <text id="level-indicator__level"
          x="49"
          y="72"
          font-family="Arsenal"
          font-size="65px"
          style="font-weight:bold;text-align:center;text-anchor:middle;fill:#ffffff;">
          <?php echo $spell_level; ?>
        </text>
    </g>


    <!-- ==================================================================== -->
    <!-- SPELL DETAILS -->
    <!-- ==================================================================== -->
    <g id="spell-details"
      style="font-size:9px;font-family:Lato;fill:000000;">
      <?php $detail_top=66; ?>

      <svg class="icon"
        x="25"
        y="<?php echo $detail_top; ?>"
        width="12px"
        height="12px"><use xlink:href="#icon-range"></use></svg>
      <text id="spell_range"
        width="159"
        height="0"
        x="43"
        y="<?php echo $detail_top+9; $detail_top+=18; ?>">
        <?php echo $spell_range; ?>
      </text>
      <path class="spacer"
        style="fill:#<?php echo $card_color; ?>;"
        d="m 16.428573,<?php echo $detail_top; $detail_top+=9; ?> 179.642847,1.4285 -179.642847,1.4286 z" />

      <svg class="icon"
        x="25"
        y="<?php echo $detail_top; ?>"
        width="12px"
        height="12px"><use xlink:href="#icon-cast-time"></use></svg>
      <text id="spell_cast-time"
        width="159"
        height="0"
        x="43"
        y="<?php echo $detail_top+9; $detail_top+=18; ?>">
        <?php echo $spell_cast_time; ?>
      </text>
      <path class="spacer"
        style="fill:#<?php echo $card_color; ?>;"
        d="m 16.428573,<?php echo $detail_top; $detail_top+=9; ?> 179.642847,1.4285 -179.642847,1.4286 z" />

      <svg class="icon"
        x="25"
        y="<?php echo $detail_top; ?>"
        width="12px"
        height="12px"><use xlink:href="#icon-duration"></use></svg>
      <text id="spell_duration"
        width="159"
        height="0"
        x="43"
        y="<?php echo $detail_top+9; $detail_top+=18; ?>">
        <?php echo $spell_duration; ?>
      </text>
      <path class="spacer"
        style="fill:#<?php echo $card_color; ?>;"
        d="m 16.428573,<?php echo $detail_top; $detail_top+=9; ?> 179.642847,1.4285 -179.642847,1.4286 z" />

      <?php if ($spell_dice): ?>
        <svg class="icon"
          x="25"
          y="<?php echo $detail_top; ?>"
          width="12px"
          height="12px"><use xlink:href="#icon-dice"></use></svg>
        <text id="spell_dice"

          width="159"
          height="0"
          x="43"
          y="<?php echo $detail_top+9; $detail_top+=18; ?>">
          <?php echo $spell_dice; ?>
        </text>
        <path class="spacer"
          style="fill:#<?php echo $card_color; ?>;"
          d="m 16.428573,<?php echo $detail_top; $detail_top+=9; ?> 179.642847,1.4285 -179.642847,1.4286 z" />
      <?php endif; ?>

      <svg class="icon"
        x="25"
        y="<?php echo $detail_top; ?>"
        width="12px"
        height="12px"><use xlink:href="#icon-requirements"></use></svg>
      <text id="spell_requirements"
        width="159"
        height="0"
        x="43"
        y="<?php echo $detail_top+9; $detail_top+=18; ?>">
        <?php echo $spell_requirements; ?>
      </text>

      <?php if ($spell_materials): ?>
        <path class="spacer"
          style="fill:#<?php echo $card_color; ?>;"
          d="m 16.428573,<?php echo $detail_top; $detail_top+=9; ?> 179.642847,1.4285 -179.642847,1.4286 z" />
        <svg class="icon"
          x="25"
          y="<?php echo $detail_top; ?>"
          width="12px"
          height="12px"><use xlink:href="#icon-materials"></use></svg>
        <foreignObject id="spell_materials"
          width="159"
          height="0"
          x="43"
          y="<?php echo $detail_top; $detail_top+=27; ?>">
          <?php echo $spell_materials; ?>
        </foreignObject>
        <flowRoot>
          <flowRegion><rect width="159" x="43" y="<?php echo $detail_top-27; ?>" fill="#ffffff"></rect></flowRegion>
          <flowPara><?php echo $spell_materials; ?></flowPara>
        </flowRoot>
      <?php endif; ?>

    </g>


    <!-- ==================================================================== -->
    <!-- SPELL DESCRIPTION -->
    <!-- ==================================================================== -->
    <foreignObject id="spell-description"
      width="210"
      height="176"
      x="212"
      y="66"
      style="font-size:11px;font-family:Lato;fill:000000;overflow:hidden;">
      <?php echo $spell_description; ?>
    </foreignObject>
    <flowRoot>
      <flowRegion><rect width="210" height="176" x="212" y="66" fill="#ffffff"></rect></flowRegion>
      <?php echo str_replace('p>', 'flowPara>', $spell_description); ?>
    </flowRoot>


    <!-- ==================================================================== -->
    <!-- ICON SYMBOLS -->
    <!-- ==================================================================== -->
    <defs>
      <symbol id="icon-range" viewBox="0 0 22 28">
      <path d="M22 24c0 2.75-5.703 4-11 4s-11-1.25-11-4c0-2.125 3.172-3.125 5.828-3.578 0.547-0.094 1.062 0.266 1.156 0.812s-0.266 1.062-0.812 1.156c-3.219 0.562-4.125 1.437-4.172 1.625 0.156 0.531 3.156 1.984 9 1.984s8.844-1.453 9-2.016c-0.047-0.156-0.953-1.031-4.172-1.594-0.547-0.094-0.906-0.609-0.812-1.156s0.609-0.906 1.156-0.812c2.656 0.453 5.828 1.453 5.828 3.578zM16 10v6c0 0.547-0.453 1-1 1h-1v6c0 0.547-0.453 1-1 1h-4c-0.547 0-1-0.453-1-1v-6h-1c-0.547 0-1-0.453-1-1v-6c0-1.109 0.891-2 2-2h6c1.109 0 2 0.891 2 2zM14.5 4c0 1.937-1.563 3.5-3.5 3.5s-3.5-1.563-3.5-3.5 1.563-3.5 3.5-3.5 3.5 1.563 3.5 3.5z"></path>
      </symbol>

      <symbol id="icon-cast-time-alt" viewBox="0 0 24 24">
      <path d="M6.984 2.016h10.031l-4.031 7.969h4.031l-7.031 12v-9h-3v-10.969z"></path>
      </symbol>
      <symbol id="icon-cast-time" viewBox="0 0 14 28">
      <path d="M13.828 8.844c0.172 0.187 0.219 0.453 0.109 0.688l-8.437 18.078c-0.125 0.234-0.375 0.391-0.656 0.391-0.063 0-0.141-0.016-0.219-0.031-0.344-0.109-0.547-0.438-0.469-0.766l3.078-12.625-6.344 1.578c-0.063 0.016-0.125 0.016-0.187 0.016-0.172 0-0.359-0.063-0.484-0.172-0.187-0.156-0.25-0.391-0.203-0.609l3.141-12.891c0.078-0.297 0.359-0.5 0.688-0.5h5.125c0.391 0 0.703 0.297 0.703 0.656 0 0.094-0.031 0.187-0.078 0.281l-2.672 7.234 6.188-1.531c0.063-0.016 0.125-0.031 0.187-0.031 0.203 0 0.391 0.094 0.531 0.234z"></path>
      </symbol>

      <symbol id="icon-duration" viewBox="0 0 24 24">
      <path d="M12.516 8.016v4.219l3.469 2.109-0.703 1.219-4.266-2.578v-4.969h1.5zM21 10.125h-6.797l2.766-2.813c-2.719-2.719-7.172-2.813-9.891-0.094s-2.719 7.031 0 9.75 7.172 2.719 9.891 0c1.359-1.359 2.016-2.906 2.016-4.875h2.016c0 1.969-0.844 4.547-2.625 6.281-3.516 3.469-9.234 3.469-12.75 0s-3.516-9.094 0-12.563 9.141-3.469 12.656 0l2.719-2.813v7.125z"></path>
      </symbol>

      <symbol id="icon-requirements" viewBox="0 0 26 28">
      <path d="M18.594 9.078l4.578-4.578-1.672-1.672-4.578 4.578zM25.578 4.5c0 0.266-0.094 0.516-0.281 0.703l-20.094 20.094c-0.187 0.187-0.438 0.281-0.703 0.281s-0.516-0.094-0.703-0.281l-3.094-3.094c-0.187-0.187-0.281-0.438-0.281-0.703s0.094-0.516 0.281-0.703l20.094-20.094c0.187-0.187 0.438-0.281 0.703-0.281s0.516 0.094 0.703 0.281l3.094 3.094c0.187 0.187 0.281 0.438 0.281 0.703zM4.469 1.531l1.531 0.469-1.531 0.469-0.469 1.531-0.469-1.531-1.531-0.469 1.531-0.469 0.469-1.531zM9.938 4.062l3.063 0.938-3.063 0.938-0.938 3.063-0.938-3.063-3.063-0.938 3.063-0.938 0.938-3.063zM24.469 11.531l1.531 0.469-1.531 0.469-0.469 1.531-0.469-1.531-1.531-0.469 1.531-0.469 0.469-1.531zM14.469 1.531l1.531 0.469-1.531 0.469-0.469 1.531-0.469-1.531-1.531-0.469 1.531-0.469 0.469-1.531z"></path>
      </symbol>

      <symbol id="icon-materials" viewBox="0 0 32 28">
      <path d="M3.313 12l9.734 10.391-4.688-10.391h-5.047zM16 24.063l5.453-12.063h-10.906zM8.406 10l3.187-6h-4.094l-4.5 6h5.406zM18.953 22.391l9.734-10.391h-5.047zM10.672 10h10.656l-3.187-6h-4.281zM23.594 10h5.406l-4.5-6h-4.094zM25.797 2.406l6 8c0.297 0.375 0.266 0.922-0.063 1.281l-15 16c-0.187 0.203-0.453 0.313-0.734 0.313s-0.547-0.109-0.734-0.313l-15-16c-0.328-0.359-0.359-0.906-0.063-1.281l6-8c0.187-0.266 0.484-0.406 0.797-0.406h18c0.313 0 0.609 0.141 0.797 0.406z"></path>
      </symbol>

      <symbol id="icon-dice-alt" viewBox="0 0 24 24">
      <path d="M12.984 12.984v-6h-1.969v6h1.969zM12.984 17.016v-2.016h-1.969v2.016h1.969zM23.016 12l-2.438 2.766 0.328 3.703-3.609 0.797-1.875 3.188-3.422-1.453-3.422 1.453-1.875-3.141-3.609-0.844 0.328-3.703-2.438-2.766 2.438-2.813-0.328-3.656 3.609-0.797 1.875-3.188 3.422 1.453 3.422-1.453 1.875 3.188 3.609 0.797-0.328 3.703z"></path>
      </symbol>
      <symbol id="icon-dice" viewBox="0 0 31 32">
      <path d="M15.297 0l-13.856 8v16l13.856 8 13.856-8v-16l-13.856-8zM15.297 2.7l5.535 8.187h-11.069l5.535-8.187zM12.301 3.851l-4.551 6.731-3.554-2.052 8.105-4.68zM18.293 3.851l8.104 4.679-3.554 2.052-4.551-6.731zM3.278 10.121l3.555 2.052-3.555 7.307v-9.359zM27.316 10.121v9.36l-3.555-7.308 3.554-2.052zM9.624 12.724h11.346l-5.673 9.826-5.673-9.826zM8.102 13.763l5.535 9.586-9.857-0.7 4.322-8.886zM22.492 13.763l4.322 8.886-9.857 0.7 5.534-9.586zM6.272 24.668l8.106 0.576v4.104l-8.106-4.68zM24.322 24.668l-8.106 4.68v-4.104l8.106-0.576z"></path>
      </symbol>
    </defs>
  </svg>

  <h1>Customize Card</h1>
  <form action="">

    <label for="#spell_name">Name</label>
    <input type="text" id="spell_name" name="spell_name" value="<?php echo $spell_name; ?>">

    <label for="#spell_type">Type</label>
    <input type="text" id="spell_type" name="spell_type" value="<?php echo $spell_type; ?>">

    <label for="#spell_level">Level</label>
    <input type="text" id="spell_level" name="spell_level" value="<?php echo $spell_level; ?>">

    <label for="#spell_description">Description</label>
    <textarea id="spell_description" name="spell_description" rows="15"><?php echo $spell_description; ?></textarea>

    <label for="#spell_range">Range</label>
    <input type="text" id="spell_range" name="spell_range" value="<?php echo $spell_range; ?>">

    <label for="#spell_cast_time">Cast Time</label>
    <input type="text" id="spell_cast_time" name="spell_cast_time" value="<?php echo $spell_cast_time; ?>">

    <label for="#spell_duration">Duration</label>
    <input type="text" id="spell_duration" name="spell_duration" value="<?php echo $spell_duration; ?>">

    <label for="#spell_requirements">Requirements</label>
    <input type="text" id="spell_requirements" name="spell_requirements" value="<?php echo $spell_requirements; ?>">

    <label for="#spell_materials">Materials</label>
    <input type="text" id="spell_materials" name="spell_materials" value="<?php echo $spell_materials; ?>">

    <label for="#spell_dice">Dice</label>
    <input type="text" id="spell_dice" name="spell_dice" value="<?php echo $spell_dice; ?>">

    <label for="#phb_page">Player Handbook Page</label>
    <input type="text" id="phb_page" name="phb_page" value="<?php echo $phb_page; ?>">

    <label for="#card_class">Card Class</label>
    <select type="text" id="card_class" name="card_class" value="<?php echo $card_class; ?>">
      <?php $card_class_options = array('generic','bard','paladin','druid','ranger','cleric','sorcerer','warlock','wizard'); ?>
      <?php foreach ($card_class_options as $option): ?>
        <option value="<?php echo $option; ?>" <?php echo $card_class == $option ? 'selected' : ''; ?>><?php echo $option; ?></option>
      <?php endforeach ?>

    </select>

    <input type="hidden" name="original_spell" value="<?php echo $original_spell; ?>">

    <input type="submit" value="Customize">
  </form>

  <form action="">
    <input type="hidden" name="spell" value="<?php echo $original_spell; ?>">
    <input type="submit" value="Reset">
  </form>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>

  $(document).ready(function(){
    var svg_html = $('svg')[0].outerHTML
                    .replace('flowroot>','flowRoot>')
                    .replace('flowregion>','flowRegion>')
                    .replace('flowpara>','flowPara>');
    $('body').append(
      $('<a>')
        .attr('href-lang', 'image/svg+xml')
        .attr('href', 'data:image/svg+xml;utf8,' +  unescape($('svg')[0].outerHTML))
        .attr('download', 'generated-card')
        .text('Download')
    );
  });

  </script>

</html>