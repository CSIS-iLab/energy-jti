<?php
/**
 * Displays the post header
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

$entry_header_classes = '';

?>

<header class="entry-header<?php echo esc_attr( $entry_header_classes ); ?>">
    
	<?php
	csisjti_share();
  
	if (get_post_type() == 'event') {

		csisjti_display_categories();

		the_title('<h1 class="entry-header__title">', '</h1>');
			
		csisjti_header_subtitle();

		csisjti_header_description();

		csisjti_last_updated();

		get_template_part( 'template-parts/event-block-upcoming' );
	?>

		<!-- past event block -->
		 
		<?php $related_analysis = get_field( 'related_analysis' ); ?>
		<?php if ( $related_analysis ) : ?>
			<?php $post = $related_analysis; ?>
			<?php setup_postdata( $post ); ?> 
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

	<?php } else if ( has_post_thumbnail() ) { ?>
		<div class="post-block__img"><?php the_post_thumbnail( 'large' ); ?></div>
			
		<?php
		get_template_part( 'template-parts/featured-image-caption' );

		csisjti_display_categories();

		the_title( '<h1 class="entry-header__title">', '</h1>' );

		csisjti_header_subtitle();

		csisjti_header_description();

		if (get_post_type() == 'post') { csisjti_posted_on(); }

	} else if ((get_post_type() == 'resource-library')) {
		
		csisjti_display_categories();

		the_title( '<h1 class="entry-header__title">', '</h1>' );

		csisjti_header_description();
	?>

		<p class="entry-header__icon"><span><?php echo csisjti_get_svg('info'); ?></span>Classifications</p>

		<a href="" class="cta cta--white">What is "Just Transition"? 
			<?php echo csisjti_get_svg( 'arrow-right' ); ?>
		</a>
		
	<?php } else {

		the_title( '<h1 class="entry-header__title">', '</h1>' );

		csisjti_header_description();

	}?>

</header><!-- .entry-header -->
