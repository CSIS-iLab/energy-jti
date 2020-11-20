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

$today = date('Ymd');
?>

<main id="site-content" role="main">
	<?php
	get_template_part( 'template-parts/entry-header' );
	?>

	<div class="entry__content">

		<h2 class="page__section-heading">Upcoming</h2>
		<?php
		$upcoming_args = array (
			'post_type' => 'event',
			'order' => 'DESC',
			'posts_per_page'   => -1,
			'meta_key'          => 'date_of_event',
			'orderby'           => 'meta_value_num',
			'order'             => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'date_of_event',
					'compare' => '>=',
					'value' => $today
				)
			)
		);

		$upcoming_query = new WP_Query( $upcoming_args );

		if ( $upcoming_query->have_posts() ) {

			while ( $upcoming_query->have_posts() ) {
				$upcoming_query->the_post();

				get_template_part( 'template-parts/block-post', get_post_type() );

			}
			wp_reset_postdata();
		} else { ?>

		<p class="page__no-content">Upcoming events will be posted here.</p>

	<?php } ?>

		<h2 class="page__section-heading">Past</h2>

	<?php
		$past_args = array (
			'post_type' => 'event',
			'order' => 'DESC',
			'posts_per_page'   => -1,
			'meta_key'          => 'date_of_event',
			'orderby'           => 'meta_value_num',
			'order'             => 'DESC',
			'meta_query' => array(
				array(
					'key' => 'date_of_event',
					'compare' => '<',
					'value' => $today
				)
			)
		);

		$past_query = new WP_Query( $past_args );

		if ( $past_query->have_posts() ) {

			while ( $past_query->have_posts() ) {
				$past_query->the_post();

				get_template_part( 'template-parts/block-post', get_post_type() );

			}
			wp_reset_postdata();
		}
	?>

	</div>

</main><!-- #site-content -->

<?php get_footer(); ?>
