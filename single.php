<?php 

add_action ( 'genesis_after_post_title','slideshow_home_link' );
function slideshow_home_link() {
	echo '<p class="pres_home">';
	_e('Back to first slide: ','presenter');
	$category = get_the_category(); 
	if($category[0]){
		echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
	}
	echo '</p>';
}

genesis();