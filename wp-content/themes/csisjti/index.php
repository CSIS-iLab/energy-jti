<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage CSISJTI
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">
	<?php get_template_part( 'template-parts/entry-header' ) ?>

	<div class="page__content">

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

<?php
get_footer();
