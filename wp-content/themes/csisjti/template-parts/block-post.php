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

<article <?php post_class('post-block post-block--post'); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
    <a href="<?php the_permalink(); ?>" class="post-block__img" title="<?php the_title_attribute(); ?>">
      <?php the_post_thumbnail( 'large' ); ?>
    </a>
	<?php endif; ?>

	<?php
		csisjti_display_categories();
	?>

	<?php

	the_title( '<h2 class="post-block__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

	csisjti_posted_on('M Y');

	?>

	<p class="post-block__excerpt"> <?php echo get_the_excerpt(); ?></p>

</article><!-- .post -->
