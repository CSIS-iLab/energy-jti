<?php
/**
 * Displays the featured image
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

if ( has_post_thumbnail() && ! post_password_required() ) {

	?>

	<figure class="post-block__img">

		<?php
			the_post_thumbnail( 'large' );

			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				echo '<figcaption class="featured-media__caption"> ' . esc_html( $caption ) . '</figcaption>';
			}
		?>

	</figure><!-- .featured-media -->

	<?php
}
