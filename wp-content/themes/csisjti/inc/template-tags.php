<?php
/**
 * Custom template tags for this theme.
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

/**
 * Table of Contents:
 * Logo & Description
 * Post Meta
 * Menus
 * Classes
 * Archives
 * Miscellaneous
 */

/**
 * Logo & Description
 */
/**
 * Displays the site logo, either text or image.
 *
 * @param array   $args Arguments for displaying the site logo either as an image or text.
 * @param boolean $echo Echo or return the HTML.
 *
 * @return string $html Compiled HTML based on our arguments.
 */
function csisjti_site_logo( $args = array(), $echo = true ) {
	$logo       = get_custom_logo();
	$site_title = get_bloginfo( 'name' );
	$contents   = '';
	$classname  = '';

	$defaults = array(
		'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
		'logo_class'  => 'site-logo',
		'title'       => '<a href="%1$s">%2$s</a>',
		'title_class' => 'site-title',
		'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
		'wrap' => '<div class="%1$s faux-heading">%2$s</div>',
		'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
	);

	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments for `csisjti_site_logo()`.
	 *
	 * @param array  $args     Parsed arguments.
	 * @param array  $defaults Function's default arguments.
	 */
	$args = apply_filters( 'csisjti_site_logo_args', $args, $defaults );

	if ( has_custom_logo() ) {
		$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
		$classname = $args['logo_class'];
	} else {
		$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
		$classname = $args['title_class'];
	}

	$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

	$html = sprintf( $args[ $wrap ], $classname, $contents );

	/**
	 * Filters the arguments for `csisjti_site_logo()`.
	 *
	 * @param string $html      Compiled html based on our arguments.
	 * @param array  $args      Parsed arguments.
	 * @param string $classname Class name based on current view, home or single.
	 * @param string $contents  HTML for site title or logo.
	 */
	$html = apply_filters( 'csisjti_site_logo', $html, $args, $classname, $contents );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Displays the site description.
 *
 * @param boolean $echo Echo or return the html.
 *
 * @return string $html The HTML to display.
 */
function csisjti_site_description( $echo = true ) {
	$description = get_bloginfo( 'description' );

	if ( ! $description ) {
		return;
	}

	$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

	$html = sprintf( $wrapper, esc_html( $description ) );

	/**
	 * Filters the html for the site description.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html         The HTML to display.
	 * @param string $description  Site description via `bloginfo()`.
	 * @param string $wrapper      The format used in case you want to reuse it in a `sprintf()`.
	 */
	$html = apply_filters( 'csisjti_site_description', $html, $description, $wrapper );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Post Meta
 */

/**
 * Displays the page's formatted title.
 *
 *
 * @return string $html The formatted page title.
 */
function csisjti_formatted_title( $post_id = false ) {
	$formatted_title = get_field('formatted_title', $post_id);

	if ( is_archive() ) {
		$object = get_queried_object();
		$formatted_title = get_field( 'formatted_title', $object->name );
	}

	if ( !$formatted_title ) {
		return;
	}

	printf( '<h1 class="entry-header__title">' . esc_html__( '%1$s', 'csisjti' ) . '</h1>', $formatted_title ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Displays the post's publish date.
 *
 *
 * @return string $html The post date.
 */
function csisjti_posted_on( $date_format = null ) {

	// Require post ID.
	if ( ! get_the_ID() ) {
		return;
	}

	$date = get_option( 'date_format' );

	if  ( $date_format ) {
		$date = $date_format;
	}

	echo '<div class="post-meta post-meta__date">' . get_the_time( $date ) . '</div>';
}

/**
 * Displays the post's publish date.
 *
 *
 * @return string $html The post date.
 */
function csisjti_last_updated() {

	// Require post ID.
	if ( ! get_the_ID() ) {
		return;
	}

	echo '<div class="post-meta post-meta__date">' . get_the_modified_time( get_option( 'date_format' ) ) . '</div>';
}

/**
 * Displays the post authors. Uses CoAuthors Plus plugin to display guest authors in place of standard WP authors.
 *
 */
function csisjti_authors() {
	if ( function_exists( 'coauthors' ) ) {
    $authors = coauthors_links( ', ', ', ', null, null, false );
	} else {
		$authors = get_the_author();
	}

	if ( !$authors ) {
		return;
	}

	echo '<div class="post-meta post-meta__authors">' . $authors . '</div>';
}

if (! function_exists('csisjti_authors_list_extended')) :
	/**
	 * Prints HTML with short author list.
	 */
	function csisjti_authors_list_extended()
	{
		global $post;

		if (function_exists('coauthors_posts_links')) {
			$authors = '<h2 class="heading">Authors</h2>';

			foreach (get_coauthors() as $coauthor) {
				$name = $coauthor->display_name;

				$authors .= '<div class="post__authors-author"><h3 class="post__authors-author-name">' . $name . '</h3><p class="post__authors-author-bio">' . $name . ' ' . $coauthor->description . '</p>';

				if ( $coauthor->website ) {
					$authors .= '<a href="' . $coauthor->website . '" class="post__authors-author-link">Learn More ' . csisjti_get_svg( 'arrow-external' ) .'</a></div>';
				} else {
					$authors .= '</div>';
				}
			}
		} else {
			$authors = the_author_posts_link();
		}
		return '<div class="post__authors"><hr class="post__authors-divider alignfull">' . $authors . '</div>';
	}
endif;

/**
 * Displays the post's categories.
 *
 *
 * @return string $html The categories.
 */
if (! function_exists('csisjti_display_categories')) :
	function csisjti_display_categories() {

		// Require post ID.
		if ( ! get_the_ID() ) {
			return;
		}

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(', ');

		if ('Uncategorized' === $categories_list) {
				return;
		}

		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<div class="post-meta post-meta__categories">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

/**
 * Displays the page's content_type if it has one.
 *
 *
 * @return string $html The content_type.
 */
if (! function_exists('csisjti_display_page_content_type')) :
	function csisjti_display_page_content_type() {

		$object = get_queried_object();

		$content_type = get_field( 'content_type', $object->name );

		if ( !$content_type ) {
			return;
		}

		/* translators: 1: list of categories. */
		printf( '<div class="post-meta post-meta__categories">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $content_type ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


/**
 * Displays the post's categories.
 *
 *
 * @return string $html The categories.
 */
if (! function_exists('csisjti_display_tags')) :
	function csisjti_display_tags() {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('<ul class="post-meta__tags"><li>', '</li><li>', '</li></ul>');

		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="entry__tags">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

/**
 * Displays the AddToAny Share Links.
 *
 *
 * @return string $html The share links.
 */
if (! function_exists('csisjti_share')) :
	function csisjti_share() {

		if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
			ADDTOANY_SHARE_SAVE_KIT();
		}
	}
endif;

/**
 * Splits date string to create date object
 *
 */
function split_date($date) {
	if ( strpos($date, "/") ) {
		return explode("/", $date);
	} elseif ( strpos($date, "-") ) {
		return explode("-", $date);
	}
}

/**
 * Displays the header's description or excerpt depending on post type.
 *
 *
 * @return string $html The description.
 */
if (! function_exists('csisjti_header_description')) :
	function csisjti_header_description( $post_id = false ) {
		$desc = '';

		if ( is_archive() ) {
			$object = get_queried_object();
			$desc = get_field( 'description', $object->name );
		} elseif ( get_field('description', $post_id ) ) {
			$desc = get_field('description', $post_id);
		} elseif (has_excerpt()) {
			$desc = get_the_excerpt();
		}

		if ( !$desc ) {
			return;
		}

		printf('<div class="entry-header__desc">' . $desc . '</div>');
	}
endif;

/**
 * Displays Header Subtitle.
 *
 *
 * @return string $html The subtitle.
 */
if (! function_exists('csisjti_header_subtitle')) :
	function csisjti_header_subtitle( $post_id = false ) {

		if (! is_single() ) {
			return;
		}


		$subtitle = get_field( 'subtitle', $post_id );

		if ( !$subtitle ) {
			return;
		}

		printf( '<p class="entry-header__subtitle">' . esc_html__( '%1$s', 'csisjti' ) . '</p>', $subtitle ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

/**
 * Displays Event Block Time.
 *
 *
 * @return string $html The event block time.
 */
if (! function_exists('csisjti_event_block_time')) :
	function csisjti_event_block_time() {
		$time = get_field( 'time' );

		if ( !$time ) {
			return;
		}

		printf( '<div class="event-block__time">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $time ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

/**
 * Displays Event Block Location.
 *
 *
 * @return string $html The event block location.
 */
if (! function_exists('csisjti_event_block_loc')) :
	function csisjti_event_block_loc() {
		$loc = get_field( 'location', false, false );

		if ( !$loc ) {
			return;
		}

		printf( '<address class="event-block__loc">' . esc_html__( '%1$s', 'csisjti' ) . '</address>', $loc ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Publication Date.
 *
 *
 * @return string $html The publication date.
 */
if (! function_exists('csisjti_resource_date')) :
	function csisjti_resource_date() {
		$publication_date = get_field( 'publication_date' );

		if ( !$publication_date ) {
			return;
		}

		printf( '<div class="post-meta post-meta__date">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $publication_date ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Description.
 *
 *
 * @return string $html The description.
 */
if (! function_exists('csisjti_resource_description')) :
	function csisjti_resource_description() {
		$description = get_field( 'description' );

		if ( !$description ) {
			return;
		}

		printf( '<div class="post-block__desc">' . esc_html__( '%1$s', 'csisjti' ) . '</div>', $description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

/**
 * Displays Resource Summary.
 *
 *
 * @return string $html The summary.
 */
if (! function_exists('csisjti_resource_summary')) :
	function csisjti_resource_summary() {
		$summary = get_field( 'summary' );

		if ( !$summary ) {
			return;
		}

		printf( '<div class="post-block__summary post-content"><dt class="post-meta__label">Summary</dt><dd class="post-block__summary-content">' . esc_html__( '%1$s', 'csisjti' ) . '</dd></div>', $summary ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Authors.
 *
 *
 * @return string $html The authors.
 */
if (! function_exists('csisjti_resource_authors')) :
	function csisjti_resource_authors() {
		$resource_author = get_field( 'resource_author' );

		if ( !$resource_author ) {
			return;
		}

		$authors = array();
		foreach( $resource_author as $author ) {
			$authors[] = $author->name;
		}

		printf( '<div class="post-block__authors"><dt class="post-meta__label">By</dt><dd class="post-meta__value">' . esc_html__( '%1$s', 'csisjti' ) . '</dd></div>', implode(', ', $authors ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Generates classes for Resource Block if it's a JTI analysis or Essential Reading.
 *
 *
 * @return string $html The authors.
 */
if (! function_exists('csisjti_resource_content_type')) :
	function csisjti_resource_content_type() {
		$type_of_content = get_field( 'type_of_content' );

		if ( !$type_of_content ) {
			return;
		}

		$classes = '';
		foreach( $type_of_content as $type ) {
			$classes .= ' is-' . str_replace('_', '-', $type);
		}

		return $classes;
	}
endif;

/**
 * Displays Resource Organizations & Types.
 *
 *
 * @return string $html The organizations & types.
 */
if (! function_exists('csisjti_resource_organization')) :
	function csisjti_resource_organization() {
		$publishing_organization = get_field( 'publishing_organization' );

		if ( !$publishing_organization ) {
			return;
		}

		$organizations = array();
		foreach( $publishing_organization as $organization ) {
			$organizations[] = $organization->name;
		}

		$publishing_organization_type = get_field( 'publishing_organization_type' );

		if ( !$publishing_organization_type ) {
			return;
		}

		$organizations_type = array();
		foreach( $publishing_organization_type as $organization_type ) {
			$organizations_type[] = $organization_type->name;
		}

		printf( '<div class="post-block__organizations"><dt class="post-meta__label">Publishing Organization</dt><dd class="post-meta__value">' . esc_html__( '%1$s', 'csisjti' ) . '<div class="post-meta__subvalue">' . esc_html__( '%2$s', 'csisjti' ) . '</div></dd></div>', implode(', ', $organizations ), implode(', ', $organizations_type ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Format.
 *
 *
 * @return string $html The format.
 */
if (! function_exists('csisjti_resource_format')) :
	function csisjti_resource_format() {
		$format = get_field( 'format' );
		$analysis_type = get_field( 'analysis_type' );

		if ( !$format && !$analysis_type ) {
			return;
		}

		$formats = array();
		if ( $format ) {
			foreach( $format as $term ) {
				$formats[] = $term->name;
			}
		}

		$types = array();
		if ( $analysis_type ) {
			foreach( $analysis_type as $term ) {
				$types[] = $term->name;
			}
		}

		$divider = '';
		if ( $format && $analysis_type ) {
			$divider = '<span class="post-meta__divider">/</span>';
		}



		printf( '<div class="post-meta post-meta__categories">' . esc_html__( '%1$s', 'csisjti' ) . esc_html__( '%2$s', 'csisjti' ) . '<span class="post-meta__analysis-types">' . esc_html__( '%3$s', 'csisjti' ) . '</span></div>', implode(', ', $formats ), $divider, implode('; ', $types) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Sectors.
 *
 *
 * @return string $html The sectors.
 */
if (! function_exists('csisjti_resource_sectors')) :
	function csisjti_resource_sectors() {
		$sectors = get_field( 'sectors' );

		if ( !$sectors ) {
			return;
		}

		$items = '';
		foreach( $sectors as $term ) {
			$items .= '<dd class="post-meta__pill">' . $term->name . '</dd>';
		}

		printf( '<div class="post-block__sectors"><dt class="post-meta__label">Sectors</dt><div class="post-meta__value post-block__pill-container">' . esc_html__( '%1$s', 'csisjti' ) . '</div></div>', $items ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Keywords.
 *
 *
 * @return string $html The keywords.
 */
if (! function_exists('csisjti_resource_keywords')) :
	function csisjti_resource_keywords() {
		$keywords = get_field( 'keywords' );

		if ( !$keywords ) {
			return;
		}

		$items = '';
		foreach( $keywords as $term ) {
			$items .= '<dd class="post-meta__pill">' . $term->name . '</dd>';
		}

		printf( '<div class="post-block__keywords"><dt class="post-meta__label">Keywords</dt><div class="post-meta__value post-block__pill-container">' . esc_html__( '%1$s', 'csisjti' ) . '</div></div>', $items ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Geographic Focus.
 *
 *
 * @return string $html The geographic foci.
 */
if (! function_exists('csisjti_resource_geographic_focus')) :
	function csisjti_resource_geographic_focus() {
		$geographic_focus = get_field( 'geographic_focus' );

		if ( !$geographic_focus ) {
			return;
		}

		// Global term always goes first & only show child terms.
		$terms = array();
		$global = '';
		foreach( $geographic_focus as $term ) {
			if ( $term->term_id == 86 ) {
				$global = $term->name;
			} elseif ( $term->parent != 0 ) {
				$terms[] = $term->name;
			}
		}
		sort($terms);

		if ($global) {
			array_unshift($terms, $global);
		}


		printf( '<div class="post-block__geographic"><dt class="post-meta__label">Geographic Scope</dt><div class="post-meta__value">' . esc_html__( '%1$s', 'csisjti' ) . '</div></div>', implode( ', ', $terms ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Displays Resource Focus Areas.
 *
 *
 * @return string $html The focus areas.
 */
if (! function_exists('csisjti_resource_focus_areas')) :
	function csisjti_resource_focus_areas() {
		$focus_areas = get_field( 'focus_areas' );

		if ( !$focus_areas ) {
			return;
		}

		// Group by parent term
		$html = csisjti_group_acf_tax_by_parent( $focus_areas );

		/* translators: 1: list of tags. */
		printf( '<div class="post-block__focus"><dt class="post-meta__label">Focus Areas</dt><div class="post-block__focus-content">' . esc_html__( '%1$s', 'csisjti' ) . '</div></div>', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

/**
 * Groups taxonomy terms made with ACF by their parent term. Specifically for the Resources Library post block.
 *
 *
 * @return string $html The grouped terms in a defintion term.
 */
if (! function_exists('csisjti_group_acf_tax_by_parent')) :
function csisjti_group_acf_tax_by_parent( $field ) {
	// Group by parent term
	$terms = array();
	foreach( $field as $term ) {
		if ($term->parent) {
			$terms[$term->parent]['children'][] = $term->name;
		} else {
			$terms[$term->term_id]['parent'] = $term->name;
		}
	}

	$html = '';
	foreach( $terms as $term ) {
		$html .= '<dd class="post-meta__value">' . $term['parent'];

		if ($term['children']) {
			$html .= ' > ' . implode(', ', $term['children']);
		}

		$html .='</dd>';
	}

	return $html;
}
endif;
