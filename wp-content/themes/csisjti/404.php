<?php
/**
 * The template for displaying the 404 template in the CSIS Mag theme.
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php	get_template_part( 'template-parts/entry-header' ); ?>
	
	<div class="section-inner thin error404-content">


		<div class="intro-text"><p><?php _e( 'The page you requested was moved, removed, renamed, or might never have existed. We apologize for any inconvenience!', 'csisjti' ); ?></p></div>

		<a href="/" class="cta"> 
			Go to the homepage <?php echo csisjti_get_svg('arrow-right') ?>
		</a>

	</div><!-- .section-inner -->

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
