<?php

genesis_structural_wrap( 'inner', '</div><!-- end .wrap -->' );

echo '</div><!-- end #inner -->
</div><!-- end #wrap -->
<div id="stickyfoot"><div class="stickywrap twelvecol">';
echo '<header id="branding" role="banner" class="threecol"><hgroup>';
do_action( 'genesis_header' );
echo '</hgroup></header>';
	echo '<div class="footer-widgets-1 widget-area threecol" role="complementary">';
	if ( is_active_sidebar( 'footer-bottom-left' ) ) {
		dynamic_sidebar( 'footer-bottom-left' );
	}
	echo '</div>';
	echo '<div class="footer-widgets-2 widget-area  threecol" role="complementary">';
	if ( is_active_sidebar( 'footer-bottom-mid' ) ) {
		dynamic_sidebar( 'footer-bottom-mid' );
	}
	echo '</div>';
	echo '<div class="footer-widgets-3 widget-area threecol last" role="complementary">';
	if ( is_active_sidebar( 'footer-bottom-right' ) ) {
		dynamic_sidebar( 'footer-bottom-right' );
	}
	echo '</div>';

do_action( 'genesis_footer' );
do_action( 'genesis_after_footer' );

echo '</div></div>';

	wp_footer(); // we need this for plugins
	do_action( 'genesis_after' );
?>
</body>
</html>