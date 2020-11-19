<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

?>
	<div class="event-block">
		<?php
		csisjti_event_date();

		csisjti_event_details();

		$related_analysis = get_field( 'related_analysis' );

		if ( $related_analysis ) :
			$post = $related_analysis;
			 setup_postdata( $post );
			 get_template_part( 'template-parts/block-post-event-past' );
			wp_reset_postdata();
		endif;

		?>
  </div>

