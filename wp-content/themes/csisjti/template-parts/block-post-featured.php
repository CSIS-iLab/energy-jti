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

<article <?php post_class('featured-post'); ?> id="post-<?php the_ID(); ?>">

	<?php
		the_post_thumbnail(array(400, 304));
	?>

	<div>

		<?php
			foreach (get_the_category() as $category) {
				if ( $category->name !== 'Featured' ) {
						echo '<a class="featured-post__category" href="' . get_category_link($category->term_id) . '">' .$category->name . '</a>'; //Markup as you see fit
				}
			}
		?>

	</div>

	<?php

	the_title( '<h3 class="featured-post__title text--semibold"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );

	csisjti_posted_on();

	csisjti_authors();
	?>

<p class="featured-post__excerpt"><?php echo get_the_excerpt(); ?></p>

</article><!-- .post -->
