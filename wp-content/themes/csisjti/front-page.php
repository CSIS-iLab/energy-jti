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
	<section class="home__analysis">

	<h1 class="title text--bold">Hello, World!</h1>

	<?php
		$featured_analysis = get_field( 'featured_analysis' );

		if ( $featured_analysis ) :
			foreach ( $featured_analysis as $post ) :
				setup_postdata ( $post );

				get_template_part( 'template-parts/block-post', get_post_type() );

			endforeach;
			wp_reset_postdata();
		endif;
	?>

	</section>

	<button class="btn">Default Button</button>
	<button class="btn btn--round">Filled Round</button>
	<button class="btn btn--round">
		<?php
	echo csisjti_get_svg( 'filter' );
	?>
		Text Icons
		<?php
	echo csisjti_get_svg( 'arrow-down' );
	?>
	</button>
	<button class="btn btn--outline">Test Outline</button>
	<button class="btn btn--outline btn--round">
		<?php
	echo csisjti_get_svg( 'filter' );
	?>
		Less Details
		<?php
	echo csisjti_get_svg( 'arrow-down' );
	?>
	</button>
	<br /><br />
	<a href="" class="cta">What is "Just Transition"? <?php
	echo csisjti_get_svg( 'arrow-right' );
	?></a>
	<br /><br />
	<div style="background: #ccc;">
		<a href="" class="cta cta--white">What is "Just Transition"? <?php
	echo csisjti_get_svg( 'arrow-right' );
	?></a>
	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
