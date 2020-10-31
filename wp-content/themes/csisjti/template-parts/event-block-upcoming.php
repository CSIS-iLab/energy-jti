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
	<div class="event-block">

		<?php if( get_field('date_of_event') ): ?>
		<div class="event-block__date">
			<?php $date = split_date(get_field('date_of_event')); ?>
				 <p class="event-block__month"><?php echo $date[1] ?></p>
				 <p class="event-block__day"><?php echo $date[0] ?></p>
				 <p class="event-block__year"><?php echo $date[2] ?></p>
			<?php endif; ?>
		</div>

		<?php if( get_field('time') ): ?>
			<div class="event-block__time"><?php the_field('time'); ?></p>
		<?php endif; ?>

		<?php if( get_field('location') ): ?>
			<?php $location = get_field('location', false, false); ?>
				<p class="event-block__date__location"><?php echo $location; ?></p>
		<?php endif; ?>
    
  </div>

