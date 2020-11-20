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

<article <?php post_class('post-block post-block--event'); ?> id="post-<?php the_ID(); ?>">

	<?php

	csisjti_event_date();

	the_title( '<h3 class="post-block__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );

	csisjti_event_sponsored_short();

	?>

	<p class="post-block__excerpt"> <?php echo get_the_excerpt(); ?></p>

	<?php csisjti_event_details(); ?>

</article><!-- .post -->
