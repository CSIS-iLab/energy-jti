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

	Tabs go in header component.

		<div class="resource-library__filter-overview">
			<?php echo facetwp_display( 'facet', 'pagination' ); ?>
			Filters Button (Mobile)<br />
			# of Filters Applied<br />
			<?php echo facetwp_display( 'facet', 'total_entries' ); ?>
			<?php echo facetwp_display( 'sort' ); ?>
		</div>

	<div class="resource-library__content">

		<div class="resource-library__secondary">
			<h2 class="resource-library__subheading">Search &amp; Filter</h2>
			<?php
				echo facetwp_display( 'facet', 'search_input' );
				echo facetwp_display( 'facet', 'analysis_type' );
				echo facetwp_display( 'facet', 'geographic_focus' );
				echo facetwp_display( 'facet', 'sectors' );
				echo facetwp_display( 'facet', 'focus_areas' );
				echo facetwp_display( 'facet', 'format' );
			?>
			<button id="filters-btn" class="btn btn--outline btn--round btn--filters" data-a11y-dialog-show="accessible-dialog">
				<?php
					echo csisjti_get_svg( 'filter' );
				?>
				More Filters
			</button>
			<button id="filters-reset-btn" class="btn--reset" onclick="FWP.reset()">Clear All</button>
		</div>

		<div class="resource-library__results">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/block-post', get_post_type() );
			}
		}
		?>
		</div>
	</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/modal' ); ?>

<?php get_footer(); ?>
