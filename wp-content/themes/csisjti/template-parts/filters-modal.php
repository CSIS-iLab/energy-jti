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
<div class="filters-modal">

  <h2 class="filters-modal__title">All Filters</h2>

  <div class="filters-modal__btn-wrapper">
		<button id="filters-reset-btn" class="btn--reset" onclick="FWP.reset()">Clear All</button>
		<div class="filters-modal__totals btn btn--round fp-num_filters_applied">0</div>
    <button id="filters-apply-btn" class="btn btn--apply">Apply</button>
  </div>

  <div class="filters-modal__subheading filters-modal--analysis" id="myButton" >
    Analysis Type
    <?php echo csisjti_get_svg('info'); ?>
  </div>

  <?php echo facetwp_display( 'facet', 'analysis_type_modal' ); ?>

  <h3 class="filters-modal__heading filters-modal--topic">Topic Scope</h3>

  <div class="filters-modal__subheading filters-modal--sectors">
    Sectors
    <?php echo csisjti_get_svg('info'); ?>
  </div>

  <?php
    echo facetwp_display( 'facet', 'sectors_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--keywords" >
    Keywords
    <?php echo csisjti_get_svg('info'); ?>
  </div>

  <?php
    echo facetwp_display( 'facet', 'keywords_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--geo">Geographic Focus</div>
  <?php echo facetwp_display( 'facet', 'geographic_focus_modal' ); ?>

  <h3 class="filters-modal__heading filters-modal--source">Source Information</h3>
  <div class="filters-modal__subheading filters-modal--pub-org">Publishing Organization</div>
  <?php
    echo facetwp_display( 'facet', 'publishing_organization_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--pub-type">Publishing Organization Type</div>
  <?php
    echo facetwp_display( 'facet', 'publishing_organization_type_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--focus-areas" >
    Focus Areas
    <?php echo csisjti_get_svg('info'); ?>
  </div>
  <?php
    echo facetwp_display( 'facet', 'focus_areas_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--author">Author</div>
  <?php
    echo facetwp_display( 'facet', 'author_modal' );
  ?>

  <div class="filters-modal__subheading filters-modal--pub-date">Publish Date Range</div>

  <div aria-hidden="true"><?php echo facetwp_display( 'facet', 'publish_date' ); ?></div>

  <?php get_template_part( 'template-parts/filters-modal-date-range' ); ?>

  <div class="filters-modal__subheading filters-modal--format">Format</div>
  <?php
    echo facetwp_display( 'facet', 'format_modal' );
  ?>

</div>

