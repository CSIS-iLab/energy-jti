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

<div class="home__header">
	<div class="home__header--title-wrapper">
		<h1 class="home__header--title"><?php the_field( 'content_type' ); ?></h1>
		<div class="home__header--desc"><?php the_field( 'formatted_title' ); ?></div>
	</div>

	<div class="video-wrapper">
		<video
					preload="auto"
					autoplay
					playsinline
					muted
					loop
					data-poster="/assets/img/meta/header.jpg"
					id="player"
					class="site-header__video intrinsic-ignore"
				>
					<source
						src="https://player.vimeo.com/external/477747022.hd.mp4?s=1ac388b148b442871b2875ed3de74e530a63e372&profile_id=174"
						type="video/mp4"
	/>
				</video>
	</div>
</div>

<div class="home__primary">
	<div class="home__objective">
		<?php the_content(); ?>
			<a href="/about-just-transitions/" title="Go to Just Transition Page" class="cta">What is "Just Transition"? <?php
				echo csisjti_get_svg( 'arrow-right' ); ?>
			</a>
		</div>
		<aside class="home__inline-filters">
			<h2 class="home__inline-filters--subheading">Explore the Resource Library</h2>
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
		</aside>
	</div>

<!-- <div class="home__event-block">
<div class="home__event-block--heading">Upcoming Event:</div>
<div class="home__event-block--date">Date</div>
<div class="home__event-block--name">Event Name</div>
<div class="home__event-block--time">9am-3pm EST</div>
</div> -->

	<section class="home__analysis">
		<h2 class="home__analysis--subheading">Analysis<div class="home__analysis--byline"><span>by the</span> Just Transition Initiative</div></h2>
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

	<div class="home__jti-block">
			<a href="<?php echo get_home_url(); ?>" class="header__logo" title="Go home">
					<?php
						include( get_template_directory() . '/assets/static/csisjti-logo-long.svg');
					?>
			</a>
			<?php dynamic_sidebar( 'about-jti' ); ?>
	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
