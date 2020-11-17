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
	<div class="resource-library__top-bar"></div>
	<div class="resource-library__content">
		<div class="resource-library__secondary">
			<div class="resource-library__sticky">

				<div class="resource-library__pagination">
				<?php echo facetwp_display( 'facet', 'pagination' ); ?>

					<button id="mobile-filters-btn" class="btn btn--outline btn--round btn--filters" data-a11y-dialog-show="accessible-dialog">
						<?php
							echo csisjti_get_svg( 'filter' );
						?>
						Filters
					</button>
				</div>

				<div class="resource-library__inline-filters">
					<h2 class="resource-library__subheading">Search &amp; Filter</h2>
					<?php
						echo facetwp_display( 'facet', 'search_input' );
						echo facetwp_display( 'facet', 'analysis_type' );
						echo facetwp_display( 'facet', 'geographic_focus' );
						echo facetwp_display( 'facet', 'sectors' );
						echo facetwp_display( 'facet', 'focus_areas' );
						echo facetwp_display( 'facet', 'format' );
					?>
					<button id="filters-btn" class="btn btn--outline btn--round btn--filters" data-a11y-dialog-show="accessible-dialog" onclick="FWP.reset()">
						<?php
							echo csisjti_get_svg( 'filter' );
						?>
						More Filters
					</button>
					<button id="filters-reset-btn" class="btn--reset" onclick="FWP.reset()">Clear All</button>
				</div>
			</div>
		</div>

		<div class="filters-overview">
			<div class="filters-overview__totals">
				<strong class="is-highlighted" id="num_filters_applied">0</strong>&nbsp;filters applied,&nbsp;
				<?php echo facetwp_display( 'facet', 'total_entries' ); ?>
			</div>
			<?php echo facetwp_display( 'sort' ); ?>
		</div>

		<div class="resource-library__results">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/block-post', get_post_type() );
			}
		} else {
			?>
			<h2 class="no-results__heading">No entries match your search.</h2>
			<p class="no-results__desc">Try searching for a similar term or removing a filter.</p>
		<?php
		}
		?>
		</div>
	</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/modal' ); ?>

<?php get_footer(); ?>
