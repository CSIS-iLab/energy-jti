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

		<?php echo '<h1>Events</h1>'?>
		<?php the_title( '<h1 class="single__header-title">', '</h1>' ) ?>
  	  
		<?php if ( is_null(the_field('subtitle')) ): ?>
			<p class="single__header-subtitle"><?php the_field('subtitle')?></p>
		<?php endif; ?>

		<p class="single__header-description"><?php the_field('description')?></p> 

		<?php
		  if ( has_excerpt() && is_singular() ) {
			echo '<p class="single__header-excerpt">' . get_the_excerpt() . '</p>';
			}	
			csisjti_last_updated()
		?>

		<p class="single__header-date"><?php the_field('date_of_event')?></p> 
		<p class="single__header-time"><?php the_field('time')?></p> 
		<p class="single__header-location"><?php the_field_without_wpautop('location')?></p> 

		<p class="single__header-registration-link"><?php the_field('registration_link')?></p> 
		<p class="single__header-registration-info"><?php the_field('additional_registration_info')?></p> 
		<p class="single__header-sponsor"><?php the_field('sponsor_or_partners')?></p> 

		<p class="single__header-video"><?php the_field('has_video_available')?></p> 
		<p class="single__header-related-analysis"><?php the_field('related_analysis')?></p> 
		<p class="single__header-related-resouces"><?php the_field('related_resource')?></p> 

	  </div>

		<?php 
		
	} else { ?>
		<?php the_title( '<h1 class="single__header-title">', '</h1>' ) ?>
  
		<p class="single__header-subtitle"><?php the_field('subtitle')?></p>
		  
		<?php if ( is_null(the_field('description')) ): ?>
		  <p class="single__header-description"><?php the_field('description')?></p> 
		<?php endif; ?>
  
		<?php
		  if ( has_excerpt() && is_singular() ) {
			echo '<p class="single__header-excerpt">' . get_the_excerpt() . '</p>';
		  }
		  csisjti_posted_on();
		?>
	  </div>

<?php
		}
		
		
		?>

 

    <?php
      get_template_part( 'template-parts/featured-image' );
      get_template_part( 'template-parts/featured-image-caption' );
		?>

  </div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
