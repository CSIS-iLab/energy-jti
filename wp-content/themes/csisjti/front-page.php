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

<div class="home-header">
	<!-- <div class="home-header__title">Just Transition</div>
	<h2 class="home-header__desc">Searching for solutions to secure an inclusive and sustainable future.</h2> -->
	
	<div class="iframe-wrapper"> 
	<iframe src="https://player.vimeo.com/video/477747022?loop=1&title=0&byline=0&portrait=0" width="640" height="275" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
	</div>

	<!-- <video class="iframe-wrapper">
	<iframe src="https://player.vimeo.com/video/477747022?title=0&byline=0&portrait=0?background?controls=0" width="640" height="300" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
		</iframe>
	</video> -->

	<!-- <video autoplay muted loop id="video">
		<source src="https://player.vimeo.com/video/477747022?title=0&byline=0&portrait=0" type="video/mp4">
	</video> -->
</div>


	<section class="home__analysis">

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

	<div class="home__content">
		<h3 class="home__content--subheading">Addressing climate change should not undermine the society or economy.</h3>
		<p class="home__content--desc">With climate change posing unprecedented threats to the planet and society, there is a growing focus on “just transitions” to help achieve the economic and social changes necessary for sustainable development, while protecting workers and communities and ensuring a more socially-equitable distribution of benefits and risks.</p>
		<a href="" class="cta">What is "Just Transition"? <?php
			echo csisjti_get_svg( 'arrow-right' ); ?>
		</a>
	</div>

	<!-- <button class="btn">Default Button</button>
	<button class="btn btn--round">Filled Round</button>
	<button class="btn btn--round">
	<?php
	//echo csisjti_get_svg( 'filter' );
	?>
		Text Icons
		<?php
	// echo csisjti_get_svg( 'arrow-down' );
	?>
	</button>
	<button class="btn btn--outline">Test Outline</button>
	<button class="btn btn--outline btn--round">
		<?php
	// echo csisjti_get_svg( 'filter' );
	?>
		Less Details
		<?php
	// echo csisjti_get_svg( 'arrow-down' );
	?>
	</button>
	<br /><br />
	<a href="" class="cta">What is "Just Transition"? <?php
	// echo csisjti_get_svg( 'arrow-right' );
	?></a>
	<br /><br />
	<div style="background: #ccc;">
		<a href="" class="cta cta--white">What is "Just Transition"? <?php
	// echo csisjti_get_svg( 'arrow-right' );
	?></a>
	</div> -->

</main><!-- #site-content -->

<?php get_footer(); ?>
