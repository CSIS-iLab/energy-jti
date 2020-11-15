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
    <option>01</option>
    <option>10</option>
  </select>

  <select id="date-range--start-year" class="date-range--select">
    <option>2016</option>
    <option>2017</option>
    <option>2018</option>
  </select>

  <select id="date-range--end-month" class="date-range--select">
    <option>01</option>
    <option>02</option>
  </select>

  <select id="date-range--end-year" class="date-range--select">
    <option>2016</option>
    <option>2017</option>
    <option>2018</option>
  </select>
</div>
