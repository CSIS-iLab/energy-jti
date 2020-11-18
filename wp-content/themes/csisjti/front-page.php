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
	<div class="home-header__title">Just Transition</div>
	<h2 class="home-header__desc">Searching for solutions to secure an inclusive and sustainable future.</h2>
	<div class="video-wrapper">
		<video
					preload="auto"
					autoplay
					playsinline
					muted
					loop
					data-poster="/assets/img/meta/header.jpg"
					id="player"
					class="site-header__video"
				>
					<source
						src="https://player.vimeo.com/external/477747022.hd.mp4?s=1ac388b148b442871b2875ed3de74e530a63e372&profile_id=174"
						type="video/mp4"
	/>
				</video>
	</div>
</div>

<div class="home__primary">
		<div class="home__content">
			<h3 class="home__content--subheading">Addressing climate change should not undermine the society or economy.</h3>
			<p class="home__content--desc">With climate change posing unprecedented threats to the planet and society, there is a growing focus on “just transitions” to help achieve the economic and social changes necessary for sustainable development, while protecting workers and communities and ensuring a more socially-equitable distribution of benefits and risks.</p>
			<a href="" class="cta">What is "Just Transition"? <?php
				echo csisjti_get_svg( 'arrow-right' ); ?>
			</a>
		</div>
		<div class="home__inline-filters resource-library__inline-filters">
			<h3 class="home__inline-filters--subheading">Explore the Resource Library</h3>
			<p class="home__inline-filters--desc">Browse resources or search for specific analysis, strategies, and case studies.</p>
			<?php
				echo facetwp_display( 'facet', 'search_input' );
				echo facetwp_display( 'facet', 'geographic_focus' );
				echo facetwp_display( 'facet', 'sectors' );
				echo facetwp_display( 'facet', 'focus_areas' );
				echo facetwp_display( 'facet', 'format' );
			?>
			<p class="home__inline-filters--info">More filters can be found on the Resource Library page.</p>
			<div style="display:none"><?php echo facetwp_display( 'template', 'resource_library' ); ?></div>
			<button class="fwp-submit btn" data-href="/resource-library/">Submit</button>
		</div>
	</div>


	<section class="home__analysis">
	<!-- <div class="facetwp-template"> -->
	<h3 class="home__analysis--subheading">Analysis</h3>
	<p class="home__analysis--byline">by the<span> Just Transition Initiative</span></p>
	<div class="home__analysis--content">
		
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
		<a href="/jti-analysis/" class="cta">All Analysis <?php
			echo csisjti_get_svg( 'arrow-right' ); ?>
		</a>
	</div>
	</section>

	<div class="csis-block--gray-section">
			<a href="<?php echo get_home_url(); ?>" class="header__logo" title="Go home">
					<?php
						include( get_template_directory() . '/assets/static/csisjti-logo-long.svg');
					?>
					</a>
		<p>The <strong>Just Transition Initiative</strong> is a new partnership project developed by the CSIS Energy Security & Climate Change Program and the Climate Investment Funds (CIF) to investigate how to achieve a just transition through the transformational change necessary to address climate change. <a href="/about/" title="Learn more">Learn more</a></p>
	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
