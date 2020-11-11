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
  <h2 class="filters-modal__heading">All Filters</h2>

  <button class="filters-modal__analysis-btn" >
    Analysis Type
    <?php echo csisjti_get_svg('info'); ?>
  </button>

  <?php echo facetwp_display( 'facet', 'analysis_type_checkbox' ); ?>

  <div class="filters-modal__subheading">Topic Scope</div>

  <button class="filters-modal__analysis-btn" >
    Sectors
    <?php echo csisjti_get_svg('info'); ?>
  </button>

  <?php 
    echo facetwp_display( 'facet', 'sectors_checkboxes' ); 
  ?>

  <div class="filters-modal__analysis-btn">Geographic Focus</div>
  <?php echo facetwp_display( 'facet', 'geographic_focus' ); ?>

  <button class="filters-modal__analysis-btn" >
    Keywords
    <?php echo csisjti_get_svg('info'); ?>
  </button>

  <?php 
    echo facetwp_display( 'facet', 'keywords' ); 
  ?>
 
  <div class="filters-modal__subheading">Source Information</div>
  <div class="filters-modal__analysis-btn">Publishing Organization</div>
  <?php  
    echo facetwp_display( 'facet', 'publishing_organization' );
  ?>
  
  <div class="filters-modal__analysis-btn">Publishing Organization Type</div>
  <?php
    echo facetwp_display( 'facet', 'publishing_organization_type' ); 
  ?>
  
  <button class="filters-modal__analysis-btn" >
    Focus Areas
    <?php echo csisjti_get_svg('info'); ?>
  </button>
  <?php 
    echo facetwp_display( 'facet', 'focus_areas_checkboxes' ); 
  ?>

</div>
    
