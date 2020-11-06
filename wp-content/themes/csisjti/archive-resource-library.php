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
	<?php get_template_part( 'template-parts/entry-header' ); ?>

	<div class="resource-library__secondary">
		<h2>Search &amp; Filter</h2>
		<?php
			echo facetwp_display( 'facet', 'search_input' );
			echo facetwp_display( 'facet', 'analysis_type' );
			echo facetwp_display( 'facet', 'geographic_focus' );
			echo facetwp_display( 'facet', 'sectors' );
			echo facetwp_display( 'facet', 'focus_areas' );
			echo facetwp_display( 'facet', 'format' );
		?>
		More Filters<br />
		Clear All
	</div>

	<div class="resource-library__results">

	<?php

	echo facetwp_display( 'sort' );

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/block-post', get_post_type() );
		}
	}

	?>
	</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/modal' ); ?>

<?php get_footer(); ?>
