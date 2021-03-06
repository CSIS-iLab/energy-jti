<?php
/**
 * A template partial to output modals for the CSISJTI default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

/**
 * Translators:
 * This text contains HTML to allow the text to be shorter on small screens.
 * The text inside the span with the class nav-short will be hidden on small screens.
 */

?>
<div class="dialog-container" id="accessible-dialog" aria-hidden="true" >

  <div class="dialog-overlay" data-a11y-dialog-hide></div>

  <div role="document" class="dialog-content" aria-labelledby="dialog-title" aria-modal="true">
    
    <button class="dialog-close" type="button" data-a11y-dialog-hide aria-label="Close this dialog window">
      <?php echo csisjti_get_svg('close'); ?>
    </button>

    <?php 
      get_template_part( 'template-parts/classification-modal' ); 
      get_template_part( 'template-parts/filters-modal' ); 
    ?>
  </div>
</div>