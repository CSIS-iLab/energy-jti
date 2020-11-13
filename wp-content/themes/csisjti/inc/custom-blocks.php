<?php
/**
 * CSISJTI Custom Blocks
 *
 * @package CSIS iLab
 * @subpackage @package CSISJTI
 * @since 1.0.0
 */

add_action('init', function() {
	register_block_style('core/media-text', [
		'name' => 'csisjti-participants',
		'label' => 'Participants'
	]);
});

// Set Download Button to have alignsmall class always.
function csisjti_lzb_block_download_button_render_attributes( $attributes, $content, $block, $context ) {
    $attributes['className'] .= ' alignsmall';

    return $attributes;
}
add_filter( 'lazyblock/download-button/attributes', 'csisjti_lzb_block_download_button_render_attributes', 10, 4 );
