<?php 

add_action( 'genesis_after_post_content', 'genesis_post_info' );
/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
if (!is_page()) {
    $post_info = '[post_comments zero="" one="1 Comment" more="% Comments"]';
    return $post_info;
}}
//var_export ($wp_query);
add_action ( 'genesis_before_loop','slide25_flex_start' );
function slide25_flex_start() {
	echo '<div class="twelvecol flexslider" role="main"><ul class="slides">';
}

add_action ( 'genesis_before_post','slide25_flex_slide_start' );
function slide25_flex_slide_start() {
	echo '<li>';
}

add_action ( 'genesis_after_post','slide25_flex_slide_stop' );
function slide25_flex_slide_stop() {
	echo '</li>';
}

add_action ( 'genesis_after_loop','slide25_flex_end' );
function slide25_flex_end() {
	echo '</ul></div>';
}

genesis();

