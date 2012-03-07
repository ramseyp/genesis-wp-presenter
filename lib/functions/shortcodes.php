<?php

add_shortcode('url','s25_url_shortcode');
function url_shortcode($atts) {
	return get_bloginfo('url');
}

add_shortcode('div', 's25_div_shortcode');
function s25_div_shortcode($atts) {
	extract(shortcode_atts(array('class' => '', 'id' => '' ), $atts));
	if ($class) $show_class = ' class="'.$class.'"';
	if ($id) $show_id = ' id="'.$id.'"';
	return '<div'.$show_class.$show_id.'>';
}

add_shortcode('end-div', 's25_end_div_shortcode');
function s25_end_div_shortcode($atts) {
	return '</div>';
}

add_shortcode('img', 's25_img_shortcode');
function s25_img_shortcode($atts) {
	extract(shortcode_atts(array( 'src' => '','alt'  => ''), $atts));
	if ($src) $show_src = 'src="'.$src.'"';
	if ($alt) $show_alt = ' alt="'.$alt.'"';

	return '<img '.$show_src.$show_alt.' />';
}

// Heading Class / ID
add_shortcode('heading', 's25_heading_shortcode');
function s25_heading_shortcode($atts) {
	extract(shortcode_atts(array('level'=>'', 'class' => '', 'id' => '' ), $atts));
	if ($level) $show_level = $level.' ';
	if ($class) $show_class = ' class="'.$class.'"';
	if ($id) $show_id = ' id="'.$id.'"';
	return '<h'.$level.$show_class.$show_id.'>';
}
// Closes a heading
add_shortcode('end-heading', 's25_end_heading_shortcode');
function rm_end_heading_shortcode($atts) {
	extract(shortcode_atts(array('level'=>''), $atts));
	if ($level) $show_level = $level;
	return '</h'.$level.'>';
}

// iframe code for google maps embed
add_shortcode('googlemap', 's25_map_iframe_shortcode');
function s25_map_iframe_shortcode($atts) {
	extract(shortcode_atts(array('width'=>'', 'height' => '', 'address' => '' ), $atts));
	if ($width) $show_width = $width;
	if ($height) $show_height = $height;
	if ($address) $show_address = urlencode ( $address );
	return '<div id="s25_googlemaps"><iframe width="'.$show_width.'" height="'.$show_height.'" src="http://www.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;z=14&amp;iwloc=&amp;geocode=&amp;q='.$show_address.'?>&amp;output=embed"></iframe><br /><small><a href="http://www.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q='.$show_address.'" style="color:#0000FF;text-align:left">View Larger Map</a></small></div>';
}
