<?php
/**
 * Post Block for Resource Library content.
 *
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

 $classes = 'post-block post-block--resource-library';

 $specialClasses = csisjti_resource_content_type();

 $classes .= $specialClasses;

?>

<article <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
 <header class="post-block__header">
	<?php
		csisjti_resource_format();

		csisjti_resource_date();

		$url = get_field( 'url' );

		if ( !$url ) {
			the_title( '<h2 class="post-block__title">', '</h2>' );
		} else {
			the_title( '<h2 class="post-block__title"><a href="' . esc_url( $url ) . '">', '</a></h2>' );
		}
	?>
	</header>

	<?php csisjti_resource_description(); ?>

	<dl class="post-block__meta">
		<?php
			csisjti_resource_geographic_focus();

			csisjti_resource_sectors();
		?>

		<details class="post-block__details">
			<summary class="btn btn--outline btn--round" data-close="Less Details">
				<span class="post-block__details-label" data-open="More" data-close="Less"></span>Details
				<?php echo csisjti_get_svg( 'arrow-down' ); ?>
			</summary>
			<div class="post-block__details-content">

			<?php
				csisjti_resource_focus_areas();

				csisjti_resource_keywords();

				csisjti_resource_authors();

				csisjti_resource_organization();

				csisjti_resource_summary();
			?>
			</div>
		</details>
	</dl>

</article>
