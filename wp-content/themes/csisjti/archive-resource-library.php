<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
	This is the resource library.

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/block-post', get_post_type() );
		}
	}

	?>

</main><!-- #site-content -->

<?php get_footer(); ?>