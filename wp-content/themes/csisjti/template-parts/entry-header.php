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
    
	<?php csisjti_share(); ?>
  
	<?php if (get_post_type() == 'event') { ?>

		
			<?php echo '<p class="entry-header__category">' . csisjti_display_categories() . '</p>'; ?>

			<?php the_title('<h1 class="entry-header__title">', '</h1>'); ?>
				
			<?php if( get_field('subtitle') ): ?>
				<p class="entry-header__subtitle"><?php the_field('subtitle'); ?></p>
			<?php endif; ?>

			<?php csisjti_header_description(); ?>

			<?php
			csisjti_last_updated();
			?> 

			<?php
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
			
		<?php get_template_part( 'template-parts/featured-image-caption' ); ?>

		<?php csisjti_display_categories(); ?>

		<?php the_title( '<h1 class="entry-header__title">', '</h1>' ); ?>

		<?php if( get_field('subtitle') ): ?>
			<p class="entry-header__subtitle"><?php the_field('subtitle'); ?></p>
		<?php endif; ?>

		<?php csisjti_header_description(); ?>

	 <?php if (get_post_type() == 'post') {
			csisjti_posted_on();
		} ?>

	<?php } else if ((get_post_type() == 'resource-library')) { ?>
		
		<?php echo '<p class="entry-header__category">' . csisjti_display_categories() . '</p>'; ?>

		<?php the_title( '<h1 class="entry-header__title">', '</h1>' ); ?>	

		<?php csisjti_header_description(); ?>

		<p class="entry-header__icon"><span><?php echo csisjti_get_svg('info'); ?></span>Classifications</p>

		<a href="" class="cta cta--white">What is "Just Transition"? 
			<?php echo csisjti_get_svg( 'arrow-right' );?>
		</a>
		
	<?php } else { ?>

		<?php the_title( '<h1 class="entry-header__title">', '</h1>' ); ?>

		<?php csisjti_header_description(); ?>

	<?php } ?>

</header><!-- .entry-header -->
