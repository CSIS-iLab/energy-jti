<?php
/**
 * The template for displaying the home page.
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
	<?php
	get_template_part( 'template-parts/entry-header' );
	?>

	<div class="entry__content">

	<?php
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/block-post', get_post_type() );

		}
	}
	?>

	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
