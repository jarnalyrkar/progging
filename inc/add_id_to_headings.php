<?php
add_filter( 'render_block', 'origin_add_id_to_heading_block', 10, 2 );
function origin_add_id_to_heading_block( $block_content, $block ) {
	if ( 'core/heading' == $block['blockName'] ) {
		$block_content = preg_replace_callback("#<(h[1-6])>(.*?)</\\1>#", "origin_add_id_to_heading", $block_content);
	}
	return $block_content;
}

function origin_add_id_to_heading($match) {
	list(, $heading, $title) = $match;
	$id = sanitize_title_with_dashes($title);
	$anchor = '<a href="#'.$id.'" class="headingAnchor hidden">' . $title . '</a>';
	return "$anchor <$heading id='$id'>$title</$heading>";
}