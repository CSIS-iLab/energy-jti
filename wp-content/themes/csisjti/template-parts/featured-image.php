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

	<div class="entry-header__spacer"></div>

	<div class="entry-header__img">

		<?php
			the_post_thumbnail( 'large' );
		?>

	</div><!-- .featured-media -->
	<div class="entry-header__caption">
		<?php
			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				echo esc_html( $caption );
			}
		?>
	</div>

	<?php
}
