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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	?>

	<div class="single__content">
		<?php
			the_content( __( 'Continue reading', 'csisjti' ) );
		?>
	</div><!-- .post-inner -->

	<?php if ( !is_page() ) { ?>
	<footer class="single__footer">
		<?php get_template_part( 'template-parts/featured-image-caption' ); ?>
		<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
		<?php echo csisjti_authors_list_extended(); ?>
		<div class="post__related">
			<h2 class="post__related-heading">Related</h2>
			<h3 class="post__related-subheading">from the <span class="post__related-resource-lib">Resource Library</span></h3>
			<?php $related_resources = get_field( 'related_resources' ); ?>
			<?php if ( $related_resources ) : ?>
				<?php foreach ( $related_resources as $post ) : ?>
					<?php setup_postdata ( $post ); ?>
					<?php get_template_part( 'template-parts/block-post-resource-library' ); ?>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</footer>
	<?php } ?>
</article><!-- .post -->
