<?php
/**
 * Post Block for Resource Library content.
 *
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

 $classes = 'post-block post-block--resource-library';

 if ( get_field( 'is_essential_reading' ) == 1 ) {
	$classes .= ' is-essential-reading';
 }

 if ( get_field( 'is_just_transition_initiative_content' ) == 1 ) {
	 $classes .= ' is-jti-content';
 }

?>

<article <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">

	<?php
		csisjti_resource_format();
	?>

	<?php

	the_field( 'publication_date' );

	$url = get_field( 'url' );

	if ( !$url ) {
		the_title( '<h2 class="post-block__title">', '</h2>' );
	} else {
		the_title( '<h2 class="post-block__title"><a href="' . esc_url( $url ) . '">', '</a></h2>' );
	}


	csisjti_resource_authors();

	csisjti_resource_organization();

	the_field( 'description' );

	the_field( 'summary' );

	?>

	<p class="post-block__excerpt"> <?php echo get_the_excerpt(); ?></p>

</article>
