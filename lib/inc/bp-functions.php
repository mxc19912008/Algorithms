<?php

/*--------------------------------------------------------------
Load custom BuddyPress stylesheet
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_bp_enqueue_styles' ) ) {	
	function ghostpool_bp_enqueue_styles() {
		//wp_deregister_style( 'bp-legacy-css' );
		wp_enqueue_style( 'gp-bp', ghostpool_css_uri . 'bp.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'ghostpool_bp_enqueue_styles' );


/*--------------------------------------------------------------
Default avatar dimensions
--------------------------------------------------------------*/


if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
	define( 'BP_AVATAR_THUMB_WIDTH', 58 );
}
if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
	define( 'BP_AVATAR_THUMB_HEIGHT', 58 );
}
if ( bp_is_groups_component() ) {
	if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
		define( 'BP_AVATAR_FULL_WIDTH', 210 );
	}
	if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
		define( 'BP_AVATAR_FULL_HEIGHT', 210 );
	}
} else {
	if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
		define( 'BP_AVATAR_FULL_WIDTH', 150 );
	}
	if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
		define( 'BP_AVATAR_FULL_HEIGHT', 150 );
	}
}


/*--------------------------------------------------------------
Remove WordPress SEO title filter from BuddyPress pages
--------------------------------------------------------------*/

if ( ! function_exists( 'ghostpool_remove_bp_wpseo_title' ) && function_exists( 'wpseo_auto_load' ) ) {
	function ghostpool_remove_bp_wpseo_title() {
		if ( ! bp_is_blog_page() ) { 
			$gp_front_end = WPSEO_Frontend::get_instance();
			remove_filter( 'pre_get_document_title', array( $gp_front_end, 'title' ), 15 );
		}	
	}
	add_action( 'init', 'ghostpool_remove_bp_wpseo_title' );
}


/*--------------------------------------------------------------
Add shortcode support for Activity Visual Composer element
--------------------------------------------------------------*/

function ghostpool_bp_get_activity_content_body( $gp_content ) {
  return do_shortcode( $gp_content );
}
add_filter( 'bp_get_activity_content_body', 'ghostpool_bp_get_activity_content_body' );

?>