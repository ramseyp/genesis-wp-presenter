<?php

// Custom meta box setup
$prefix = 's25_';
add_filter( 'cmb_meta_boxes', 's25_custom_meta_boxes' );
function s25_custom_meta_boxes( $meta_boxes ) {
	//// Setup Meta Box Data
	global $prefix;
	$meta_boxes[] = array();
	
/*
$meta_boxes[] = array(
		'id' => 'project_details',
		'title' => 'Project Details',
		'pages' => array('work'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names left of input
		'fields' => array(
			array(
				'name' => 'Client Name',
				'id' => $prefix.'client_name',
				'desc' => '',
				'type' => 'text',
			),
		   array(
				'name' => 'Client URL',
				'id' => $prefix.'client_url',
				'desc' => '',
				'type' => 'text',
			),
		   array(
				'name' => 'Framework Used',
				'id' => $prefix.'client_framework',
				'desc' => '',
				'type' => 'text',
			),
		   array(
				'name' => 'Design Provided By',
				'id' => $prefix.'design_source',
				'desc' => '',
				'type' => 'text',
			),
		   array(
				'name' => 'Estimated Cost',
				'id' => $prefix.'cost_estimate',
				'desc' => '',
				'type' => 'text_money',
			),
		   array(
				'name' => 'Client Comments',
				'id' => $prefix.'client_comments',
				'desc' => '',
				'type' => 'text',
			),
		)
	);
*/	

	);
	return $meta_boxes;
	
}

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( CHILD_DIR.'/lib/metabox/init.php' );
	}
}