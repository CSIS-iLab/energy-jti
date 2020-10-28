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

		<?php

			the_title( '<h1 class="single__header-title">', '</h1>' )?>

      <p class="single__header-subtitle"><?php the_field('subtitle')?></p>
      
      <p class="single__header-description"><?php the_field('description')?></p>

      <?php
			if ( has_excerpt() && is_singular() ) {
				the_excerpt();
			}

			get_template_part( 'template-parts/featured-image' );
			get_template_part( 'template-parts/featured-image-caption' );

			csisjti_posted_on();
		?>

	</div><!-- .entry-header-inner -->

	

</header><!-- .entry-header -->
