<?php 

add_action ( 'genesis_before_loop','slide25_search_title');
function slide25_search_title() {
	echo '<h1 class="entry-title">';
	_e('search Results');
	echo '</h1>';
}

add_action ( 'genesis_before_loop','slide25_1140_start' );
function slide25_1140_start() {
	echo '<div class="twelvecol" role="main">';
}


add_action ( 'genesis_after_loop','slide25_1140_end' );
function slide25_1140_end() {
	echo '</div>';
}

genesis();

