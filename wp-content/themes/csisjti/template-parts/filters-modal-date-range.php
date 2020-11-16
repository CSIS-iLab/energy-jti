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
	'posts_per_page'   => -1,
	'meta_key'          => 'publication_date',
  'orderby'           => 'meta_value_num',
	'order'             => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'publication_date',
			'compare' => '!=',
			'value' => ''
		)
	)
);

$the_query = new WP_Query( $args );

// Create fallbacks just in case the query fails.
// $min_year = 2012;
// $max_year = 2020;

if ( $the_query->have_posts() ) {

	// Get most recent & oldest posts to pull the date from
	$newest = $the_query->posts[0]->ID;
	$max_year = (int)substr( get_field( 'publication_date', $newest ), -4);

	$oldest = $the_query->posts[$the_query->post_count - 1]->ID;
	$min_year = (int)substr( get_field( 'publication_date', $oldest ), -4);

}

$yearDropdown = '';
$i = $min_year;
while ( $i <= $max_year ) {
	$yearDropdown .= "<option value=" . $i . ">" . $i . "</option>";
	$i++;
}

$monthDropdown = '';
$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$i = 0;
foreach($months as $month) {
	$monthDropdown .= "<option value=" . $i . ">" . $month . "</option>";
	$i++;
}

?>


<div class="filters-modal__date-range">
  <div class="filters-modal__date-range-start">
    <select id="date-range--start-month" class="date-range--select">
      <option value="hide" disabled selected>Month</option>
			<?php echo $monthDropdown; ?>
    </select>

    <select id="date-range--start-year" class="date-range--select">
    <option value="hide" disabled selected>Year</option>
    <?php echo $yearDropdown; ?>
    </select>
  </div>

  <div class="filters-modal__date-range--text">to</div>

  <div class="filters-modal__date-range-end">
    <select id="date-range--end-month"  class="date-range--select">
    <option value="hide" disabled selected>Month</option>
		<?php echo $monthDropdown; ?>
    </select>

    <select id="date-range--end-year"  class="date-range--select">
    <option value="hide" disabled selected>Year</option>
		<?php echo $yearDropdown; ?>
    </select>
  </div>
</div>
