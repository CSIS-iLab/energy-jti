<?php
/**
 * Custom date range dropdown for filter modal.
 *
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */
?>

<?php
$args = array (
  'post_type' => 'resource-library',
  'order' => 'DESC',
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        
        $the_query->the_post(); ?>
        <h2>Found</h2>
        <div><?php the_field('publication_date'); ?></div>

    <?php } } else { ?>

    <h2>Not Found</h2>

<?php } ?>
<?php wp_reset_postdata(); ?>


<div class="filters-modal__date-range">
  <select id="date-range--start-month" class="date-range--select">
    <option value="01">01</option>
    <option value="10">10</option>
  </select>

  <select id="date-range--start-year" class="date-range--select">
    <option>2016</option>
    <option>2017</option>
    <option>2018</option>
  </select>

  <div class="filters-modal__date-range--text">to</div>

  <select id="date-range--end-month"  class="date-range--select">
    <option>01</option>
    <option>02</option>
  </select>

  <select id="date-range--end-year"  class="date-range--select">
    <option>2016</option>
    <option>2017</option>
    <option>2018</option>
  </select>


      <!-- Hide the custom select from AT (e.g. SR) using aria-hidden
      <div class="selectCustom js-selectCustom" aria-hidden="true">
          <div class="selectCustom-trigger">Start Month</div>
          <div class="selectCustom-options">
            <div data-value="01">Jan</div>
            <div data-value="10">Oct</div>
          </div>
      </div>

      <div class="selectCustom js-selectCustom" aria-hidden="true">
            <div class="selectCustom-trigger">Start Year</div>
            <div class="selectCustom-options">
              <div>2016</div>
              <div>2017</div>
              <div>2018</div>
            </div>
        </div>

        <div class="selectCustom js-selectCustom" aria-hidden="true">
            <div class="selectCustom-trigger">End Month</div>
            <div  class="selectCustom-options">
              <div>01</div>
              <div>02</div>
            </div>
        </div>

        <div class="selectCustom js-selectCustom" aria-hidden="true">
            <div class="selectCustom-trigger">End Year</div>
            <div  class="selectCustom-options">
              <div>01</div>
              <div>02</div>
            </div>
        </div> -->
</div>
