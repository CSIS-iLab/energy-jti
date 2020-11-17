<?php
/**
 * A template partial to output modals for the CSISJTI default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

/**
 * Translators:
 * This text contains HTML to allow the text to be shorter on small screens.
 * The text inside the span with the class nav-short will be hidden on small screens.
 */

// Needed to get ACF from Archive.
$object = get_queried_object();
$object_name = $object->name;

// ['field name', 'Label']
$definitions = array(
	'essential_reading_description' => 'Essential Reading',
	'analysis_type_description' => 'Analysis Type',
	'sectors_description' => 'Sectors',
	'focus_areas_description' => 'Focus Areas',
	'keywords_description' => 'Keywords'
);

?>
<div class="classification-modal">
  <h2 class="classification-modal__heading">Classifications</h2>

  <div class="classification-modal__desc"><?php the_field( 'overall_description', $object_name ); ?></div>

  <dl class="classification-modal__list">
		<?php
			foreach ($definitions as $key => $label) {
				$desc = get_field( $key, $object_name );
				if ( $desc ) {
					echo '<dt class="list-items__name">' . $label . '</dt>';
					echo '<dd class="list-items__desc">' . $desc . '</dd>';
				}
			}
		?>
  </dl>
</div>

