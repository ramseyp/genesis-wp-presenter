<?php 
/*
Custom Homepage which lists your presentations (Categories)

*/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'slide25_loop_helper' );
function slide25_loop_helper() {
	echo '<header><h1 class="entry-title">'. get_bloginfo( 'name' ) .'</h1></header>';
	if ( is_active_sidebar( 'homepage' ) ) {
		echo '<div class="homepage">';
		dynamic_sidebar( 'homepage' );
		echo '</div><!-- end .homepage -->';
	} else {
		echo '<section class="post_content clearfix">';
		echo '<h2 class="intro">'. _e('Select from a Presentation below.', 'presenter') .'</h2>';
	}
	$args = array(
		'orderby' => 'name',
		'show_count' => 1,
		'hierarchical' => false,
		'title_li' => null
	);
	wp_list_categories( $args );
	echo '</section>';

}

genesis();
