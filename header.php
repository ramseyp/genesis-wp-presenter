<?php
/**
 * WARNING: This file is part of the core Genesis framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * Handles the header structure.
 *
 * @package Genesis
 */
do_action( 'genesis_doctype' );
do_action( 'genesis_title' );
do_action( 'genesis_meta' );

wp_head(); /** we need this for plugins **/
?>
</head>
<body <?php body_class(); ?>>
<?php
do_action( 'genesis_before' );
?>
<div id="wrap" class="container">
<?php

echo '<div id="inner" class="row">';
genesis_structural_wrap( 'inner' );