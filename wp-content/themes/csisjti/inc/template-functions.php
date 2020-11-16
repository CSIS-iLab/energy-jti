<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CSISJTI
 */

/**
 * Classes
 */
/**
 * Add No-JS Class.
 * If we're missing JavaScript support, the HTML element will have a no-js class.
 */
function csisjti_no_js_class() {

	?>
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	<?php

}

add_action( 'wp_head', 'csisjti_no_js_class' );

/**
 * Add conditional body classes.
 *
 * @param array $classes Classes added to the body tag.
 *
 * @return array $classes Classes added to the body tag.
 */
function csisjti_body_classes( $classes ) {

	global $post;
	$post_type = isset( $post ) ? $post->post_type : false;

	// Check whether we're singular.
	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	// Check for post thumbnail.
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	} elseif ( is_singular() ) {
		$classes[] = 'missing-post-thumbnail';
	}

	// Check whether we're in the customizer preview.
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-preview';
	}

	// Check if posts have single pagination.
	if ( is_single() && ( get_next_post() || get_previous_post() ) ) {
		$classes[] = 'has-single-pagination';
	} else {
		$classes[] = 'has-no-pagination';
	}

	// Slim page template class names (class = name - file suffix).
	if ( is_page_template() ) {
		$classes[] = basename( get_page_template_slug(), '.php' );
	}

	return $classes;

}

add_filter( 'body_class', 'csisjti_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function csisjti_pingback_header()
{
    if (is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'csisjti_pingback_header');

/**
 * Archives
 */
/**
 * Filters the archive title and styles the word before the first colon.
 *
 * @param string $title Current archive title.
 *
 * @return string $title Current archive title.
 */
function csisjti_get_the_archive_title( $title ) {

	$regex = apply_filters(
		'csisjti_get_the_archive_title_regex',
		array(
			'pattern'     => '/(\A[^\:]+\:)/',
			'replacement' => '<span class="color-accent">$1</span>',
		)
	);

	if ( empty( $regex ) ) {

		return $title;

	}

	return preg_replace( $regex['pattern'], $regex['replacement'], $title );

}

add_filter( 'get_the_archive_title', 'csisjti_get_the_archive_title' );

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function csisjti_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Fixes empty <p> and <br> tags showing before and after shortcodes in the
 * output content.
 */
function csisjti_the_content_shortcode_fix($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']'
    );
    return strtr($content, $array);
}
add_filter('the_content', 'csisjti_the_content_shortcode_fix');

/**
 * Use relative URLs for images
 */
function csisjti_switch_to_relative_url($html, $id, $caption, $title, $align, $url, $size, $alt)
{
    $imageurl = wp_get_attachment_image_src($id, $size);
    $relativeurl = wp_make_link_relative($imageurl[0]);
    $html = str_replace($imageurl[0],$relativeurl,$html);

    return $html;
}
add_filter('image_send_to_editor','csisjti_switch_to_relative_url',10,8);


/**
 * Make links pushed to Algolia relative.
 *
 * @param array   $shared_attributes Attributes to push.
 * @param WP_Post $post Post object.
 * @return array Updated Attributes array.
 */
function csisjti_algolia_shared_attributes( array $shared_attributes, WP_Post $post ) {

    $shared_attributes['permalink'] = wp_make_link_relative( get_post_permalink( $post ) );
    if ( has_post_thumbnail( $post ) ) {
        $shared_attributes['images']['thumbnail']['url'] = wp_make_link_relative( get_the_post_thumbnail_url( $post ) );
    }
    return $shared_attributes;
}
add_filter( 'algolia_post_shared_attributes', 'csisjti_algolia_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'csisjti_algolia_shared_attributes', 10, 2 );


/**
 * Only use Photon for images belonging to our site.
 *
 * @see https://wordpress.org/support/?p=8513006
 *
 * @param bool         $skip      Should Photon ignore that image.
 * @param string       $image_url Image URL.
 * @param array|string $args      Array of Photon arguments.
 * @param string|null  $scheme    Image scheme. Default to null.
 */
function jetpack_photon_only_allow_local( $skip, $image_url, $args, $scheme ) {
    // Get the site URL, without any protocol.
    $site_url = preg_replace( '~^(?:f|ht)tps?://~i', '', get_site_url() );

    /**
     * If the image URL is from our site,
     * return default value (false, unless another function overwrites).
     * Otherwise, do not use Photon with it.
     */
    if ( strpos( $image_url, $site_url ) ) {
        return $skip;
    } else {
        return true;
    }
}
add_filter( 'jetpack_photon_skip_for_url', 'jetpack_photon_only_allow_local', 9, 4 );

/**
 * Change "Posts" label in WP Admin to "Analysis"
 * @return array Modified global $menu, $submenu arrays.
 */
function csisjti_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Analysis';
    $submenu['edit.php'][5][0] = 'Analysis';
    $submenu['edit.php'][10][0] = 'Add Analysis';
    $submenu['edit.php'][16][0] = 'Analysis Tags';
}
add_action( 'admin_menu', 'csisjti_change_post_label' );

/**
 * Change Post Object Labels
 * @return array Modified post object
 */
function csisjti_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Analysis';
    $labels->singular_name = 'Analysis';
    $labels->add_new = 'Add Analysis';
    $labels->add_new_item = 'Add Analysis';
    $labels->edit_item = 'Edit Analysis';
    $labels->new_item = 'Analysis';
    $labels->view_item = 'View Analysis';
    $labels->search_items = 'Search Analysis';
    $labels->not_found = 'No Analysis found';
    $labels->not_found_in_trash = 'No Analysis found in Trash';
    $labels->all_items = 'All Analysis';
    $labels->menu_name = 'Analysis';
    $labels->name_admin_bar = 'Analysis';
}
add_action( 'init', 'csisjti_change_post_object' );

/**
 * Remove comments from media attachements, specifically the comments on the JetPack Carousel Slides
 * @param  string $open    Content
 * @param  ID $post_id Post ID
 * @return string          Content
 */
function filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 *
 * @return string $html
 */
function csisjti_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'csisjti_read_more_tag' );

/** Modify Excerpt */
function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param string $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post',
 *
 * @return mixed
 */
function csisjti_custom_wpkses_post_tags( $tags, $context ) {
    if ( 'post' === $context ) {
        $tags['iframe'] = array(
            'src'             => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
            'allowvr allowfullscreen' => true,
            'mozallowfullscreen' => true,
            'webkitallowfullscreen' => true,
            'onmousewheel' => true
        );
        $tags['style'] = array(
            'type' => true
        );
    }
    return $tags;
}
add_filter( 'wp_kses_allowed_html', 'csisjti_custom_wpkses_post_tags', 10, 2 );

/**
 * Change the default post query to show private pages on missile pages.
 *
 * @param  array $query Query object.
 */
function csisjti_custom_sort_posts( $query ) {
    if ( is_tax( 'countries' ) && $query->is_main_query() ) {
        $query->set( 'post_status', array( 'publish', 'private' ) );
    }
}
add_action( 'pre_get_posts', 'csisjti_custom_sort_posts' );

/**
 * Add search link to the main menu.
 * @param  string $items Menu items content.
 * @param  array $args  Menu.
 * @return string        Modified menu.
 */
function csisjti_add_search_box( $items, $args ) {
    if($args->theme_location == 'primary') {
        $search = '<li class="search">';
        $search .= '<form method="get" id="searchform" action="/"><div class="input-group">';
        $search .= '<label class="screen-reader-text" for="navSearchInput">Search for:</label>';
        $search .= '<input type="text" class="form-control" name="s" id="navSearchInput" placeholder="Search" />';
        $search .= '<label for="navSearchInput" id="navSearchLabel"><i class="fa fa-search" aria-hidden="true"></i></label>';
        $search .= '</div></form>';
        $search .= '</li>';
        return $items.$search;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items','csisjti_add_search_box', 10, 2 );

/**
 * Alter the titles of the archives for categories & tags.
 * @param  string $title Archive title
 * @return string        Modified archive title.
 */
function csisjti_archive_titles( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '<span class="archive-label">Category:</span> ', false );
    } elseif( is_tag() ) {
        $title = single_tag_title( '<span class="archive-label">Keyword:</span> ', false );
    } elseif( is_author() ) {
        $title = '<span class="archive-label">Author:</span> ' . get_the_author();
    } elseif ( is_tax( 'system' ) ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'csisjti_archive_titles' );

/**
*
* Recreate the default filters on the_content so we can pull formated content with get_post_meta
*/
add_filter( 'meta_content', 'wptexturize' );
add_filter( 'meta_content', 'convert_smilies' );
add_filter( 'meta_content', 'convert_chars' );
add_filter( 'meta_content', 'wpautop' );
add_filter( 'meta_content', 'shortcode_unautop' );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode' );
add_filter( 'term_description', 'do_shortcode' );

/**
 * Move Yoast SEO meta boxes to bottom of editing screen.
 * @return string Priority level.
 */
function missile_defenseyoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'missile_defenseyoasttobottom');

/**
 * Set default attributes for the accordion shortcode.
 * @param array $atts Shortcode attributes.
 */
function set_accordion_shortcode_defaults($atts) {
    $atts['autoclose'] = false;
    $atts['clicktoclose'] = true;
    return $atts;
}
add_filter('shortcode_atts_accordion', 'set_accordion_shortcode_defaults', 10, 3);

function csisjti_undo_footnote_reset() {
    if ( in_array( get_post_type(), array( 'actors', 'systems', 'post', 'defsys', 'missile' ) ) && is_single() ) {
        global $easyFootnotes;
        remove_filter( 'the_content', array($easyFootnotes, 'easy_footnote_reset'), 999 );
    }
}
add_action( 'template_redirect', 'csisjti_undo_footnote_reset' );

if ( class_exists( 'easyFootnotes' ) ) {
    /**
     * Removes the easy footnotes from the content so we can display them separately elsewhere.
     * @param  string $content The post content.
     * @return string          The modified post content.
     */
    function csisjti_remove_easy_footnotes($content) {
        $content = preg_replace('#<ol[^>]*class="easy-footnotes-wrapper"[^>]*>.*?</ol>#is', '', $content);
        return $content;
    }
    add_filter('the_content', 'csisjti_remove_easy_footnotes', 20);
}

/**
*
* Strips additional p tags placed in html when using ACF wsywg
*/
function the_field_without_wpautop( $field_name ) {

	remove_filter('acf_the_content', 'wpautop');

	the_field( $field_name );

	add_filter('acf_the_content', 'wpautop');

}

/**
 * Modify the assets that are loaded on pages that use facets.
 */
add_filter( 'facetwp_assets', function( $assets ) {
        $assets['custom.js'] = '/wp-content/themes/csisjti/assets/plugins/facets.js';
        unset( $assets['fSelect.css'] );
    return $assets;
});

/**
 * Add accessibility JS for facets.
 */
add_filter( 'facetwp_load_a11y', '__return_true' );

/**
 * Modify Resource Library Sort by, including the default sort order.
 */

function csisjti_resource_library_pre_get_posts( $query ) {

	// do not modify queries in the admin
	if ( is_admin() ) {
		return $query;
	}


	// only modify queries for 'event' post type
	if ( isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'resource-library' ) {

		$query->set('orderby', 'meta_value');
		$query->set('meta_key', 'publication_date');
		$query->set('order', 'DESC');

	}
	return $query;
}
add_action('pre_get_posts', 'csisjti_resource_library_pre_get_posts');

add_filter( 'facetwp_sort_options', function( $options, $params ) {
    $options = [
				'default' => [
						'label' => 'Publication Date (Newest)',
						'query_args' => [
							'orderby' => 'meta_value',
							'meta_key' => 'publication_date',
							'order' => 'DESC',
						]
				],
				'publication_date_asc' => [
						'label' => 'Publication Date (Oldest)',
						'query_args' => [
							'orderby' => 'meta_value',
							'meta_key' => 'publication_date',
							'order' => 'ASC',
						]
				],
		];

    return $options;
}, 10, 2 );

add_filter( 'facetwp_sort_html', function( $html, $params ) {
    $html = '<label for="sort" class="facetwp-sort__label">Sort By</label><select class="facetwp-sort-select" id="sort">';
    foreach ( $params['sort_options'] as $key => $atts ) {
        $html .= '<option value="' . $key . '">' . $atts['label'] . '</option>';
    }
    $html .= '</select>';
    return $html;
}, 10, 2 );

/**
 * Modify FacetWP Pager Template
 */
add_filter( 'facetwp_facet_html', function( $output, $params ) {
		if ( 'numbers' !== $params['facet']['pager_type'] ) {
			return $output;
		}

		$pager_args = FWP()->facet->pager_args;

    $output = '';
    $page = $pager_args['page'];
		$total_pages = $pager_args['total_pages'];

		$output .= '<div class="facetwp-pager-totals">
			<strong class="is-highlighted">Page ' . $page . '</strong> of ' . $total_pages . '
		</div>';

		if ( 1 < $total_pages ) {
			if ( $page === 1 ) {
				$prev_disabled = ' is-disabled';
			}

			if ( $page == $total_pages ) {
				$next_disabled = ' is-disabled';
			}

			$output .= '<div class="facetwp-pager-nav">';

			$output .= '<a class="facetwp-page facetwp-page--prev' . $prev_disabled . '" data-page="' . ($page - 1) . '">' . csisjti_get_svg( 'chevron-left' ) . '</a>';

			$output .= '<a class="facetwp-page facetwp-page--next' . $next_disabled . '" data-page="' . ($page + 1) . '">' . csisjti_get_svg( 'chevron-right' )  . '</a>';

			$output .= '</div>';

		}

    return $output;
}, 10, 2 );

/**
 * Modifies the # of posts visible on an archive. For testing purposes only!!!
 */
add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {

  global $wp_the_query;

  if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_archive() ) ) {
    $query->set( 'posts_per_page', 2 );
  }

  return $query;
}
