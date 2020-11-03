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

		<?php 
		csisjti_event_block_time();

		csisjti_event_block_loc();
		
		?>
    
  </div>

