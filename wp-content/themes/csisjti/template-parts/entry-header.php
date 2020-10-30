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

<header class="single__header<?php echo esc_attr( $entry_header_classes ); ?>">

  <div class="single__header-wrapper">
    
	<?php csisjti_share(); ?>
  
	<?php if (get_post_type() == 'event') { ?>

		<!-- category -->

		<?php	echo '<p class="single__header-category">Category</p>'; ?>

		<?php the_title('<h1 class="single__header-title">', '</h1>'); ?>
  	  
		<?php if( get_field('subtitle') ): ?>
			<p class="single__header-subtitle"><?php the_field('subtitle'); ?></p>
		<?php endif; ?>

		<?php if( get_field('description') ): ?>
			<p class="single__header-description"><?php the_field('description'); ?></p>
		<?php endif; ?>

		<?php
		if ( has_excerpt() && is_singular() ) {
			echo '<p class="single__header-excerpt">' . get_the_excerpt() . '</p>';
		}	
		csisjti_last_updated();
		?>

		<?php if( get_field('date_of_event') ): ?>
			<p class="single__header-date"><?php the_field('date_of_event'); ?></p>
		<?php endif; ?>

		<?php if( get_field('time') ): ?>
			<p class="single__header-time"><?php the_field('time'); ?></p>
		<?php endif; ?>

		<?php if( get_field('location') ): ?>
			<p class="single__header-location"><?php the_field('location'); ?></p>
		<?php endif; ?>

		<!-- post event  -->
   	<p class="single__header-related-analysis"><?php //the_field('related_analysis')?></p> 

	<?php } else if ( has_post_thumbnail() ) { ?>

		<?php echo '<p class="single__header-category">Category</p>'; ?>

    <a href="<?php the_permalink(); ?>" class="post-block__img" title="<?php the_title_attribute(); ?>">
      <?php the_post_thumbnail( 'large' ); ?>
		</a>	
		<?php get_template_part( 'template-parts/featured-image-caption' ); ?>

		<?php the_title( '<h1 class="single__header-title">', '</h1>' ); ?>

		<?php if( get_field('subtitle') ): ?>
			<p class="single__header-subtitle"><?php the_field('subtitle'); ?></p>
		<?php endif; ?>

		<?php if( get_field('description') ): ?>
			<p class="single__header-description"><?php the_field('description'); ?></p>
		<?php endif; ?>
  
		<?php
		if ( has_excerpt() && is_singular() ) {
			echo '<p class="single__header-excerpt">' . get_the_excerpt() . '</p>';
		}
		csisjti_posted_on();
		?>

	<?php } else if ((get_post_type() == 'resource-library')) { ?>
		
		<?php echo '<p class="single__header-category">Category</p>'; ?>

		<?php the_title( '<h1 class="single__header-title">', '</h1>' ); ?>		  
		<p class="single__header-description"><?php the_field('description');?></p> 
		
	<?php } else { ?>

		<?php the_title( '<h1 class="single__header-title">', '</h1>' ); ?>

		<?php if( get_field('description') ): ?>
			<p class="single__header-description"><?php the_field('description'); ?></p>
		<?php endif; ?>

	<?php } ?>
   
  </div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
