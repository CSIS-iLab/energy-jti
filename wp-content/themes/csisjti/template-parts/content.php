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

$post_type = get_post_type();

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	?>

	<div class="single__content post-copy">
		<?php
			csisjti_event_register_link();

			the_content( __( 'Continue reading', 'csisjti' ) );
		?>
	</div><!-- .post-inner -->

	<?php if ( !is_page() ) { ?>
	<footer class="single__footer">
		<?php get_template_part( 'template-parts/featured-image-caption' ); ?>
		<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
		<?php
			echo csisjti_authors_list_extended();
			csisjti_event_sponsored_full();

		$related_resources = get_field( 'related_resources' );
		if ( $related_resources ) : ?>

			<div class="post__related">
				<h2 class="section__heading">
					Related
					<div class="section__heading-sub">from the <span>Resource Library</span></div>
				</h2>

			<?php
			foreach ( $related_resources as $post ) :
				setup_postdata ( $post );
				get_template_part( 'template-parts/block-post-resource-library' );
			endforeach;
			wp_reset_postdata();
			?>
			</div>
		<?php endif; ?>
	</footer>
	<?php } ?>

	<?php
		dynamic_sidebar( 'explore-resource-library' );
	?>
</article><!-- .post -->
