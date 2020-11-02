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
				 <div class="event-block__month"><?php echo $date[1] ?></div>
				 <div class="event-block__day"><?php echo $date[2] ?></div>
				 <div class="event-block__year"><?php echo $date[0] ?></div>
			<?php endif; ?>
		</div>

		<?php if( get_field('time') ): ?>
			<div class="event-block__time"><?php the_field('time'); ?></div>
		<?php endif; ?>

		<?php if( get_field('location') ): ?>
			<?php $location = get_field('location', false, false); ?>
				<address class="event-block__location"><?php echo $location; ?></address>
		<?php endif; ?>
    
  </div>

