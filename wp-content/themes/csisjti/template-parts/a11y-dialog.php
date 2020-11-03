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

<div class="dialog-container" id="my-accessible-dialog" aria-hidden="true">

  <div class="dialog-overlay" tabindex="-1" data-a11y-dialog-hide></div>

  <dialog class="dialog-content" aria-labelledby="dialog-title">
    
    <button class="dialog-close" type="button" data-a11y-dialog-hide aria-label="Close this dialog window">
      &times;
    </button>
    
    <!-- <h1 id="dialog-title">Dialog Title</h1> -->

  </dialog>
</div>