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

  $pub_dates = array();

    while ( $the_query->have_posts() ) {
        
        $the_query->the_post(); 
        $pub_field = (int)substr(get_field('publication_date'), -4); ?>

        <?php array_push($pub_dates, $pub_field); ?>

    <?php } }  

 wp_reset_postdata(); ?>


<div class="filters-modal__date-range">
  <div class="filters-modal__date-range-start">
    <select id="date-range--start-month" class="date-range--select">

      <?php 
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $i = 0;

        foreach($months as $month) {
          echo "<option value=" . $i . ">" . $month . "</option>";
          $i++;
        }   
      ?>
    </select>

    <select id="date-range--start-year" class="date-range--select">  

    <?php 
        $i = min($pub_dates);
        $max = max($pub_dates);
        $pub_dates = array($i, $max);
        $pub_dates = array_unique($pub_dates);

        while ( $i <= $max ) {
          echo "<option value=" . $i . ">" . $i . "</option>";
          $i++;
        }
      ?>
    </select>
  </div>

  <div class="filters-modal__date-range--text">to</div>

  <div class="filters-modal__date-range-start">
    <select id="date-range--end-month"  class="date-range--select">
    <?php 
        $i = 0;

        foreach($months as $month) {
          echo "<option value=" . $i . ">" . $month . "</option>";
          $i++;
        }   
      ?>
    </select>

    <select id="date-range--end-year"  class="date-range--select">
    <?php 
        $i = min($pub_dates);

        while ( $i <= $max ) {
          echo "<option value=" . $i . ">" . $i . "</option>";
          $i++;
        }
    ?>
    </select>
  </div>
</div>
