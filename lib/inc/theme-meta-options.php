<?php // Meta Options ( WPShout.com )

require( ghostpool_inc . 'options.php' );

add_action( 'admin_menu', 'ghostpool_create_meta_box' );
add_action( 'save_post', 'ghostpool_save_meta_data' );

function ghostpool_create_meta_box() {
	add_meta_box( 'gp-theme-options', esc_html__( 'Post Settings', 'buddy' ), 'ghostpool_meta_boxes', 'post', 'normal', 'core' );
	add_meta_box( 'gp-theme-options', esc_html__( 'Page Settings', 'buddy' ), 'ghostpool_meta_boxes', 'page', 'normal', 'core' );
	add_meta_box( 'gp-theme-options', esc_html__( 'Slide Settings', 'buddy' ), 'ghostpool_meta_boxes', 'slide', 'normal', 'core' );	
}


/////////////////////////////////////// Post Settings ///////////////////////////////////////

function ghostpool_post_meta_boxes() {
	
	global $dirname;
	
	$meta_boxes = array( 

	'thumbnail_settings' => array( 'name' => 'thumbnail_settings', 'type' => 'open', 'desc' => esc_html__( 'Controls the thumbnails used on category, archive, tag and search result pages.', 'buddy' ), 'title' => esc_html__( 'Thumbnail Settings', 'buddy' ) ),
	
		'_' . $dirname . '_thumbnail_width' => array( 'name' => '_' . $dirname . '_thumbnail_width', 'title' => esc_html__( 'Thumbnail Width', 'buddy' ), 'desc' => esc_html__( 'The width to crop the thumbnail to.', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),	
				
		'_' . $dirname . '_thumbnail_height' => array( 'name' => '_' . $dirname . '_thumbnail_height', 'title' => esc_html__( 'Thumbnail Height', 'buddy' ), 'desc' => esc_html__( 'The height to crop the thumbnail to (set to 0 to have a proportionate height).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),	

	array( 'type' => 'close' ),

	'image_settings' => array( 'name' => 'image_settings', 'type' => 'open', 'desc' => esc_html__( 'Controls the featured image displayed within this page.', 'buddy' ), 'title' => esc_html__( 'Image Settings', 'buddy' ) ),

		'_' . $dirname . '_show_image' => array( 'name' => '_' . $dirname . '_show_image', 'title' => esc_html__( 'Featured Image', 'buddy' ), 'desc' => esc_html__( 'Choose whether to display the featured image within your page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Show' => esc_html__( 'Show', 'buddy' ), 'Hide' => esc_html__( 'Hide', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
		
		'_' . $dirname . '_image_width' => array( 'name' => '_' . $dirname . '_image_width', 'title' => esc_html__( 'Image Width', 'buddy' ), 'desc' => esc_html__( 'The width to crop the image to.', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),
				
		'_' . $dirname . '_image_height' => array( 'name' => '_' . $dirname . '_image_height', 'title' => esc_html__( 'Image Height', 'buddy' ), 'desc' => esc_html__( 'The height to crop the image to (set to 0 to have a proportionate height).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),

		'_' . $dirname . '_image_wrap' => array( 'name' => '_' . $dirname . '_image_wrap', 'title' => esc_html__( 'Image Wrap', 'buddy' ), 'desc' => esc_html__( 'Choose whether the page content wraps around the featured image.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Enable' => esc_html__( 'Enable', 'buddy' ), 'Disable' => esc_html__( 'Disable', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
		
		array( 'type' => 'divider', 'name' => '' ),	
		
		'_' . $dirname . '_hard_crop' => array( 'name' => '_' . $dirname . '_hard_crop', 'title' => esc_html__( 'Hard Crop', 'buddy' ), 'desc' => esc_html__( 'Choose whether the image is hard cropped.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Enable' => esc_html__( 'Enable', 'buddy' ), 'Disable' => esc_html__( 'Disable', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
						
	array( 'type' => 'close' ),
		
	'portfolio_settings' => array( 'name' => 'portfolio_settings', 'type' => 'open', 'desc' => esc_html__( 'Can be used when your posts are displayed in [posts] shortcodes.', 'buddy' ), 'title' => esc_html__( 'Portfolio Settings', 'buddy' ) ),
		
		'_' . $dirname . '_link_type' => array( 'name' => '_' . $dirname . '_link_type', 'title' => esc_html__( 'Link Type', 'buddy' ), 'desc' => esc_html__( 'Choose how your portfolio link opens.', 'buddy' ), 'options' => array( 'Page' => esc_html__( 'Page', 'buddy' ), 'Lightbox Image' => esc_html__( 'Lightbox Image', 'buddy' ), 'Lightbox Video' => esc_html__( 'Lightbox Video', 'buddy' ), 'None' => esc_html__( 'None', 'buddy' ) ), 'std' => 'Page', 'type' => 'select' ),
	
		'_' . $dirname . '_custom_url' => array( 'name' => '_' . $dirname . '_custom_url', 'title' => esc_html__( 'Custom URL', 'buddy' ), 'desc' => esc_html__( 'A custom URL which your image links to ( overrides the default post URL ).', 'buddy' ), 'type' => 'text' ),
		
		'_' . $dirname . '_lightbox_content' => array( 'name' => '_' . $dirname . '_lightbox_content', 'title' => esc_html__( 'Lightbox Content', 'buddy' ), 'desc' => esc_html__( 'Upload images/audio/videos that will be opened in the lightbox.', 'buddy' ), 'type' => 'gallery_upload' ),
	
	array( 'type' => 'close' ),
		
	'format_settings' => array( 'name' => 'format_settings', 'type' => 'open', 'desc' => esc_html__( 'General formatting settings.', 'buddy' ), 'title' => esc_html__( 'Format Settings', 'buddy' ) ),
				
		'_' . $dirname . '_sidebar_left' => array( 'name' => '_' . $dirname . '_sidebar_left', 'title' => esc_html__( 'Left Sidebar', 'buddy' ), 'desc' => esc_html__( 'Choose which sidebar area to display on this page.', 'buddy' ), 'std' => 'Default', 'type' => 'select_sidebar' ),

		'_' . $dirname . '_sidebar_right' => array( 'name' => '_' . $dirname . '_sidebar_right', 'title' => esc_html__( 'Right Sidebar', 'buddy' ), 'desc' => esc_html__( 'Choose which sidebar area to display on this page.', 'buddy' ), 'std' => 'Default', 'type' => 'select_sidebar' ),

		'_' . $dirname . '_layout' => array( 'name' => '_' . $dirname . '_layout', 'title' => esc_html__( 'Layout', 'buddy' ), 'desc' => esc_html__( 'Choose the layout for this page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'sb-left' => esc_html__( 'Sidebar Left', 'buddy' ), 'sb-right' => esc_html__( 'Sidebar Right', 'buddy' ), 'sb-both' => esc_html__( 'Sidebar Left & Right', 'buddy' ), 'fullwidth' => esc_html__( 'Fullwidth', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),
						
		'_' . $dirname . '_title' => array( 'name' => '_' . $dirname . '_title', 'title' => esc_html__( 'Title', 'buddy' ), 'desc' => esc_html__( 'Choose whether to display the title on this page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Show' => esc_html__( 'Show', 'buddy' ), 'Hide' => esc_html__( 'Hide', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),

		array( 'type' => 'divider' ),
				
		'_' . $dirname . '_custom_stylesheet' => array( 'name' => '_' . $dirname . '_custom_stylesheet', 'title' => esc_html__( 'Custom Stylesheet URL', 'buddy' ), 'desc' => esc_html__( 'Enter the relative URL to your custom stylesheet e.g. lib/css/custom-style.css', 'buddy' ), 'type' => 'text' ),
		
	array( 'type' => 'close' ),
	
	 );

	return apply_filters( '_' . $dirname . '_post_meta_boxes', $meta_boxes );
}


/////////////////////////////////////// Page Settings ///////////////////////////////////////

function ghostpool_page_meta_boxes() {
	
	global $dirname;

	$meta_boxes = array( 
	
	'thumbnail_settings' => array( 'name' => 'thumbnail_settings', 'type' => 'open', 'desc' => esc_html__( 'Controls the thumbnails used on category, archive, tag and search result pages.', 'buddy' ), 'title' => esc_html__( 'Thumbnail Settings', 'buddy' ) ),
		
		'_' . $dirname . '_thumbnail_width' => array( 'name' => '_' . $dirname . '_thumbnail_width', 'title' => esc_html__( 'Thumbnail Width', 'buddy' ), 'desc' => esc_html__( 'The width to crop the thumbnail to (set to 0 to have a proportionate width ).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),	
				
		'_' . $dirname . '_thumbnail_height' => array( 'name' => '_' . $dirname . '_thumbnail_height', 'title' => esc_html__( 'Thumbnail Height', 'buddy' ), 'desc' => esc_html__( 'The height to crop the thumbnail to (set to 0 to have a proportionate height).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),	

	array( 'type' => 'close' ),

	'image_settings' => array( 'name' => 'image_settings', 'type' => 'open', 'desc' => esc_html__( 'Controls the featured image displayed within this page.', 'buddy' ), 'title' => esc_html__( 'Image Settings', 'buddy' ) ),

		'_' . $dirname . '_show_image' => array( 'name' => '_' . $dirname . '_show_image', 'title' => esc_html__( 'Featured Image', 'buddy' ), 'desc' => esc_html__( 'Choose whether to display the featured image within your page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Show' => esc_html__( 'Show', 'buddy' ), 'Hide' => esc_html__( 'Hide', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
		
		'_' . $dirname . '_image_width' => array( 'name' => '_' . $dirname . '_image_width', 'title' => esc_html__( 'Image Width', 'buddy' ), 'desc' => esc_html__( 'The width to crop the image to (set to 0 to have a proportionate width ).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),
				
		'_' . $dirname . '_image_height' => array( 'name' => '_' . $dirname . '_image_height', 'title' => esc_html__( 'Image Height', 'buddy' ), 'desc' => esc_html__( 'The height to crop the image to (set to 0 to have a proportionate height).', 'buddy' ), 'type' => 'text', 'size' => 'small', 'details' => 'px' ),

		'_' . $dirname . '_image_wrap' => array( 'name' => '_' . $dirname . '_image_wrap', 'title' => esc_html__( 'Image Wrap', 'buddy' ), 'desc' => esc_html__( 'Choose whether the page content wraps around the featured image.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Enable' => esc_html__( 'Enable', 'buddy' ), 'Disable' => esc_html__( 'Disable', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
		
		array( 'type' => 'divider', 'name' => '' ),	
		
		'_' . $dirname . '_hard_crop' => array( 'name' => '_' . $dirname . '_hard_crop', 'title' => esc_html__( 'Hard Crop', 'buddy' ), 'desc' => esc_html__( 'Choose whether the image is hard cropped.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Enable' => esc_html__( 'Enable', 'buddy' ), 'Disable' => esc_html__( 'Disable', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),	
					
	array( 'type' => 'close' ),
		
	'format_settings' => array( 'name' => 'format_settings', 'type' => 'open', 'desc' => esc_html__( 'General formatting settings.', 'buddy' ), 'title' => esc_html__( 'Format Settings', 'buddy' ) ),

		'_' . $dirname . '_sidebar_left' => array( 'name' => '_' . $dirname . '_sidebar_left', 'title' => esc_html__( 'Left Sidebar', 'buddy' ), 'desc' => esc_html__( 'Choose which sidebar area to display on this page.', 'buddy' ), 'std' => 'Default', 'type' => 'select_sidebar' ),

		'_' . $dirname . '_sidebar_right' => array( 'name' => '_' . $dirname . '_sidebar_right', 'title' => esc_html__( 'Right Sidebar', 'buddy' ), 'desc' => esc_html__( 'Choose which sidebar area to display on this page.', 'buddy' ), 'std' => 'Default', 'type' => 'select_sidebar' ),

		'_' . $dirname . '_layout' => array( 'name' => '_' . $dirname . '_layout', 'title' => esc_html__( 'Layout', 'buddy' ), 'desc' => esc_html__( 'Choose the layout for this page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'sb-left' => esc_html__( 'Sidebar Left', 'buddy' ), 'sb-right' => esc_html__( 'Sidebar Right', 'buddy' ), 'sb-both' => esc_html__( 'Sidebar Left & Right', 'buddy' ), 'fullwidth' => esc_html__( 'Fullwidth', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),
				
		'_' . $dirname . '_title' => array( 'name' => '_' . $dirname . '_title', 'title' => esc_html__( 'Title', 'buddy' ), 'desc' => esc_html__( 'Choose whether to display the title on this page.', 'buddy' ), 'options' => array( 'Default' => esc_html__( 'Default', 'buddy' ), 'Show' => esc_html__( 'Show', 'buddy' ), 'Hide' => esc_html__( 'Hide', 'buddy' ) ), 'std' => 'Default', 'type' => 'select' ),
		
		array( 'type' => 'divider' ),
		
		'_' . $dirname . '_custom_stylesheet' => array( 'name' => '_' . $dirname . '_custom_stylesheet', 'title' => esc_html__( 'Custom Stylesheet URL', 'buddy' ), 'desc' => esc_html__( 'Enter the relative URL to your custom stylesheet e.g. lib/css/custom-style.css', 'buddy' ), 'type' => 'text' ),
	
	array( 'type' => 'close' ),
	
	 );

	return apply_filters( '_' . $dirname . '_page_meta_boxes', $meta_boxes );
}


/////////////////////////////////////// Slide Settings ///////////////////////////////////////

function ghostpool_slide_meta_boxes() {
	
	global $dirname;
	
	$meta_boxes = array( 

	'general_settings' => array( 'name' => 'general_settings', 'type' => 'open', 'desc' => esc_html__( 'General slide settings.', 'buddy' ), 'title' => esc_html__( 'Format Settings', 'buddy' ) ),
		
		'_' . $dirname . '_custom_url' => array( 'name' => '_' . $dirname . '_custom_url', 'title' => esc_html__( 'Slide URL', 'buddy' ), 'desc' => esc_html__( 'Enter the URL you want your slide to link to.', 'buddy' ), 'type' => 'text' ),

		'_' . $dirname . '_link_type' => array( 'name' => '_' . $dirname . '_link_type', 'title' => esc_html__( 'Link Type', 'buddy' ), 'desc' => esc_html__( 'Choose how your slide links to the URL you provided to the left.', 'buddy' ), 'options' => array( 'Page' => esc_html__( 'Page', 'buddy' ), 'Lightbox Image' => esc_html__( 'Lightbox Image', 'buddy' ), 'Lightbox Video' => esc_html__( 'Lightbox Video', 'buddy' ), 'None' => esc_html__( 'None', 'buddy' ) ), 'std' => 'Page', 'type' => 'select' ),
		
	array( 'type' => 'close' ),
	
	'video_settings' => array( 'name' => 'video_settings', 'type' => 'open', 'desc' => esc_html__( 'The settings for a video used in this slide.', 'buddy' ), 'title' => esc_html__( 'Video Settings', 'buddy' ) ),
	
		'_' . $dirname . '_slide_video' => array( 'name' => '_' . $dirname . '_slide_video', 'title' => esc_html__( 'Video URL', 'buddy' ), 'desc' => esc_html__( 'The URL of your video or audio file ( YouTube/Vimeo/FLV/MP4/M4V/MP3 ).', 'buddy' ), 'type' => 'upload' ),

		'_' . $dirname . '_webm_mp4_slide_video' => array( 'name' => '_' . $dirname . '_webm_mp4_slide_video', 'title' => esc_html__( 'HTML5 Video URL ( Safari/Chrome )', 'buddy' ), 'desc' => esc_html__( 'Enter your HTML5 video URL for Safari/Chrome ( WEBM/MP4 ).', 'buddy' ), 'type' => 'upload' ),

		'_' . $dirname . '_ogg_slide_video' => array( 'name' => '_' . $dirname . '_ogg_slide_video', 'title' => esc_html__( 'HTML5 Video URL ( FireFox/Opera )', 'buddy' ), 'desc' => esc_html__( 'Enter your HTML5 video URL for FireFox/Opera ( OGG/OGV ).', 'buddy' ), 'type' => 'upload' ),
				
		'_' . $dirname . '_slide_autostart_video' => array( 'name' => '_' . $dirname . '_slide_autostart_video', 'title' => esc_html__( 'Autostart Video', 'buddy' ), 'desc' => esc_html__( 'Plays the video automatically when the slide comes into view ( works in the first slide only ).', 'buddy' ), 'type' => 'checkbox' ),

		array( 'type' => 'divider' ),
		
		'_' . $dirname . '_slide_video_priority' => array( 'name' => '_' . $dirname . '_slide_video_priority', 'title' => esc_html__( 'Video Priority', 'buddy' ), 'desc' => esc_html__( 'If you have provided both flash and HTML5 videos, select which one will take priority if the browser can play both.', 'buddy' ), 'options' => array( 'Flash' => esc_html__( 'Flash', 'buddy' ), 'HTML5' => esc_html__( 'HTML5', 'buddy' ) ), 'std' => 'Flash', 'type' => 'select' ),
		
		'_' . $dirname . '_slide_video_controls' => array( 'name' => '_' . $dirname . '_slide_video_controls', 'title' => esc_html__( 'Video Controls', 'buddy' ), 'desc' => esc_html__( 'Choose how to display the video controls ( does not apply to YouTube and Vimeo videos ).', 'buddy' ), 'options' => array( 'None' => esc_html__( 'None', 'buddy' ), 'Bottom' => esc_html__( 'Bottom', 'buddy' ), 'Over' => esc_html__( 'Over', 'buddy' ) ), 'std' => 'None', 'type' => 'select' ),
		
	array( 'type' => 'close' ),
	
	'caption_settings' => array( 'name' => 'caption_settings', 'type' => 'open', 'desc' => esc_html__( 'The settings for a caption in this slide.', 'buddy' ),  'title' => esc_html__( 'Caption Settings', 'buddy' ) ),
		
		'_' . $dirname . '_slide_title' => array( 'name' => '_' . $dirname . '_slide_title', 'title' => esc_html__( 'Hide Slide Caption Title', 'buddy' ), 'desc' => esc_html__( 'Hide the slide caption title.', 'buddy' ), 'type' => 'checkbox' ),

		'_' . $dirname . '_slide_caption_position' => array( 'name' => '_' . $dirname . '_slide_caption_position', 'title' => esc_html__( 'Caption Position', 'buddy' ), 'desc' => esc_html__( 'Choose the caption position.', 'buddy' ), 'options' => array( 'caption-topleft' => esc_html__( 'Top Left', 'buddy' ), 'caption-topright' => esc_html__( 'Top Right', 'buddy' ), 'caption-bottomleft' => esc_html__( 'Bottom Left', 'buddy' ), 'caption-bottomright' => esc_html__( 'Bottom Right', 'buddy' ) ), 'type' => 'select', 'std' => 'caption-bottomright' ),
							
	array( 'type' => 'close' ),
	
	 );

	return apply_filters( '_' . $dirname . '_slide_meta_boxes', $meta_boxes );
}


/////////////////////////////////////// Meta Fields ///////////////////////////////////////

function ghostpool_meta_boxes() {

	global $post;
	
	if ( get_post_type() == 'post' ) {
		$meta_boxes = ghostpool_post_meta_boxes();	
	} elseif ( get_post_type() == 'slide' ) {
		$meta_boxes = ghostpool_slide_meta_boxes();					
	} else {
		$meta_boxes = ghostpool_page_meta_boxes();
	}
	
	foreach ( $meta_boxes as $meta ) {
		if ( isset( $meta['name'] ) ) {
			$value = get_post_meta( $post->ID, $meta['name'], true );
		}
		if ( $meta['type'] == 'open' ) {
			get_meta_open( $meta, $value );		
		} elseif ( $meta['type'] == 'close' ) {
			get_meta_close( $meta, $value );	
		} elseif ( $meta['type'] == 'option_open' ) {
			get_meta_option_open( $meta, $value );		
		} elseif ( $meta['type'] == 'option_close' ) {
			get_meta_option_close( $meta, $value );	
		} elseif ( $meta['type'] == 'text' ) {
			get_meta_text( $meta, $value );				
		} elseif ( $meta['type'] == 'text' ) {
			get_meta_text( $meta, $value );	
		} elseif ( $meta['type'] == 'upload' ) {
			get_meta_upload( $meta, $value );	
		} elseif ( $meta['type'] == 'gallery_upload' ) {
			get_meta_gallery_upload( $meta, $value );					
		} elseif ( $meta['type'] == 'textarea' ) {
			get_meta_textarea( $meta, $value );
		} elseif ( $meta['type'] == 'select' ) {
			get_meta_select( $meta, $value );
		} elseif ( $meta['type'] == 'select_sidebar' ) {
			get_meta_select_sidebar( $meta, $value );
		} elseif ( $meta['type'] == 'select_layerslider' ) {
			get_meta_select_layerslider( $meta, $value );
		} elseif ( $meta['type'] == 'select_taxonomy' ) {
			get_meta_select_taxonomy( $meta, $value );									
		} elseif ( $meta['type'] == 'checkbox' ) {
			get_meta_checkbox( $meta, $value );	
		} elseif ( $meta['type'] == 'radio' ) {
			get_meta_radio( $meta, $value );						
		} elseif ( $meta['type'] == 'colorpicker' ) {
			get_meta_colorpicker( $meta, $value );				
		}
	}	
	
} function get_meta_open( $args = array(), $value = false, $title = false ) {
extract( $args ); ?>
	
	<div class="meta-settings" id="<?php echo sanitize_html_class( $name ); ?>">
			
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

		<?php if ( isset( $title ) ) { ?><div class="gp-meta-section-title"><?php echo $title; ?></div><?php } ?>
	
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc gp-header-desc"><?php echo $desc; ?></div><?php } ?>
	
	
<?php } function get_meta_close( $args = array(), $value = false ) {
extract( $args ); ?>

		<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		
	</div>
	
	
<?php } function get_meta_option_open( $args = array(), $value = false, $title = false ) {
extract( $args ); ?>

	<div id="meta-box" class="gp-option gp-option-open">		

		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>	

		<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
		
	
<?php } function get_meta_option_close( $args = array(), $value = false ) {
extract( $args ); ?>
	
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="_noncename" id="_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
					
	</div>
	
				
<?php } function get_meta_text( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false', $size = '' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-text<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">	
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
			
		<input type="text" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>" value="<?php if ( $value != '' ) { echo esc_html( $value, 1 ); } else { echo $std; } ?>" placeholder="<?php echo $placeholder; ?>" size="<?php if ( $size == 'small' ) { ?>4<?php } else { ?>30<?php } ?>" /><?php if ( isset( $details ) ) { ?> <span><?php echo $details; ?></span><?php } ?>		
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
	
	</div>


<?php } function get_meta_upload( $args = array(), $value = false, $title = false, $std = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-upload<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
	
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<input type="text" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>" class="upload" value="<?php if ( $value != '' ) { echo esc_html( $value, 1 ); } else { echo $std; } ?>" size="30" />
		
		<input type="button" id="<?php echo sanitize_html_class( $name ); ?>_button" class="gp-upload-button button" value="<?php esc_html_e( 'Upload', 'buddy' ); ?>" />
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>
	
	
<?php } function get_meta_gallery_upload( $args = array(), $value = false, $title = false, $std = '', $stripped = 'false' ) {
extract( $args ); global $post; ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-gallery-upload <?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>

		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>	

		<div id="gallery-images-container">
		
			<ul class="gallery-images">
				
				<?php
				
				if ( metadata_exists( 'post', $post->ID, $name ) ) {
					$image_gallery = get_post_meta( $post->ID, $name, true );
				} else {
					$image_gallery = '';
				}
				
				$attachments = array_filter( explode( ',', $image_gallery ) );

				if ( $attachments )
					foreach ( $attachments as $attachment_id ) {
						echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
							' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
							<a href="#" class="delete tips" data-tip="' . esc_html__( 'Delete image', 'buddy' ) . '"></a>
						</li>';
					}
				?>
				
			</ul>

			<input type="hidden" id="<?php echo sanitize_html_class( $name ); ?>" name="<?php echo sanitize_html_class( $name ); ?>" class="gp-gallery" value="<?php echo esc_attr( $image_gallery ); ?>" />
			
		</div>
		
		<span class="add-gallery-images hide-if-no-js">
			<input type="button" class="button" value="<?php esc_html_e( 'Add Images', 'buddy' ); ?>" data-choose="<?php esc_html_e( 'Add Images', 'buddy' ); ?>" data-update="<?php esc_html_e( 'Add Image', 'buddy' ); ?>" data-delete="<?php esc_html_e( 'Delete Image', 'buddy' ); ?>" data-text="<?php esc_html_e( 'Delete', 'buddy' ); ?>">
		</span>

		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>
		
		
<?php } function get_meta_textarea( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-textarea<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">	
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<textarea name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>" cols="60" rows="4" tabindex="30" placeholder="<?php echo $placeholder; ?>"><?php if ( $value != '' ) { echo esc_html( $value, 1 ); } else { echo $std; } ?></textarea>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>


<?php } function get_meta_checkbox( $args = array(), $value = false, $title = false, $std = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-checkbox<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
	
		<?php if ( $value != '' ) { $checked = 'checked="checked"'; } else { if ( $std === 'true' ) { $checked = 'checked="checked"'; } else { $checked = ''; } } ?>
		
		<input type="checkbox" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>" value="true" <?php echo $checked; ?> />
		
		<?php if ( isset( $title ) ) { ?><strong><?php echo $title; ?></strong><?php } ?>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
	
	</div>
	

<?php } function get_meta_radio( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false' ) {
extract( $args ); ?>
	
	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-radio<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
	
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
					
		<?php foreach ( $options as $key => $option ) { ?>
			
			<div class="gp-radio-button">
			
				<?php if($key == 'Default') { ?>
					<input type="radio" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo $name . $key; ?>" value="Default" <?php if ( $key == 'Default' ) { echo ' checked="checked"'; } ?>><label for="<?php echo $name . '_' . $key; ?>"><?php echo ucwords( str_replace( '-', ' ', $placeholder ) ) . esc_html__(' Default', 'buddy'); ?></label>
				<?php } elseif ( $value != '' ) { ?>
					<input type="radio" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo $name . $key; ?>" value="<?php echo $key; ?>" <?php if ( htmlentities( $value, ENT_QUOTES ) == $key ) { echo ' checked="checked"'; } ?>><label for="<?php echo $name . '_' . $key; ?>"><?php echo $option; ?></label>
				<?php } else { ?>
					<input type="radio" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo $name . $key; ?>" value="<?php echo $key; ?>" <?php if ( $std == $key ) { echo ' checked="checked"'; } ?>><label for="<?php echo $name . '_' . $key; ?>"><?php echo $option; ?></label>
				<?php } ?>
			
			</div>
							
		<?php } ?>
				
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>

			
<?php } function get_meta_select( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false' ) {
extract( $args ); ?>
	
	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-select<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
	
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<select name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>">
						
			<?php foreach ( $options as $key => $option ) { ?>
			
				<?php if($key == 'Default') { ?>
					<option value="Default" <?php if ( htmlentities( $value, ENT_QUOTES ) == 'Default' ) echo ' selected="selected"'; ?>><?php echo ucwords( str_replace( '-', ' ', $placeholder ) ) . esc_html__(' Default', 'buddy'); ?></option>
				<?php } elseif ( $value != '' ) { ?>
					<option value="<?php echo $key; ?>" <?php if ( htmlentities( $value, ENT_QUOTES ) == $key ) echo ' selected="selected"'; ?>><?php echo $option; ?></option>
				<?php } else { ?>
					<option value="<?php echo $key; ?>" <?php if ( $std == $key ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
					
			<?php } ?>
			
		</select>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>


<?php } function get_meta_select_sidebar( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false' ) {
extract( $args ); global $wp_registered_sidebars; ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-sidebar-select<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<?php 		
		$placeholder = str_replace( 'gp-', '', $placeholder );
		$placeholder = ucwords( str_replace( '-', ' ', $placeholder ) );
		?>
		
		<select name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>">
			
			<option value="Default" <?php if( htmlentities( $value, ENT_QUOTES) == 'Default' ) echo ' selected="selected"'; ?>><?php echo $placeholder . esc_html__(' Default', 'buddy'); ?></option>
			
			<?php $sidebars = $wp_registered_sidebars;
			if ( is_array( $sidebars ) && !empty( $sidebars ) ) { foreach ( $sidebars as $sidebar ) { if ( $value != '' ) { ?>
				<option value="<?php echo $sidebar['id']; ?>"<?php if ( $value == $sidebar['id'] ) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php } else { ?>
				<option value="<?php echo $sidebar['id']; ?>"<?php if ( $std == $sidebar['id'] ) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php }}} ?>
			
		</select>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>


<?php } function get_meta_select_layerslider( $args = array(), $value = false, $title = false, $std = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-sidebar-select<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<select name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>">

			<?php if ( function_exists( 'layerslider' ) ) {
			
				$sliders = LS_Sliders::find( array( 'data' => true ) );
			
				if ( !empty( $sliders ) ) {
			
					foreach ($sliders as $key => $item ) {
			
						 if ( $value != '' ) { ?>
							<option value="<?php echo $item['id']; ?>"<?php if ( $value == $item['id'] ) { echo ' selected="selected"'; } ?>><?php echo apply_filters( 'ls_slider_title', $item['name'], 40 ); ?></option>
						<?php } else { ?>
							<option value="<?php echo $item['id']; ?>"<?php if ( $std == $item['id'] ) { echo ' selected="selected"'; } ?>><?php echo apply_filters( 'ls_slider_title', $item['name'], 40 ); ?></option>
						<?php }
				
					}
			
				} 
			
			} ?>
			
		</select>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>


<?php } function get_meta_select_taxonomy( $args = array(), $value = false, $title = false, $std = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-sidebar-select<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<select name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>">

			<?php $terms = get_terms( $tax, 'hide_empty=false' );
			
			if ( !empty( $terms ) ) {
			
				foreach( $terms as $term ) {
			
					 if ( $value != '' ) { ?>
						<option value="<?php echo $term->slug; ?>"<?php if ( $value == $term->slug ) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option>
					<?php } else { ?>
						<option value="<?php echo $term->slug; ?>"<?php if ( $std == $term->slug ) { echo ' selected="selected"'; } ?>><?php echo $term->name; ?></option>
					<?php }
				
				}
			
			} else { ?>
			
				<option disabled><?php esc_html_e( 'No Sliders Created', 'buddy' ); ?></option>

			<?php } ?>
			
		</select>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>		


<?php } function get_meta_colorpicker( $args = array(), $value = false, $title = false, $std = '', $placeholder = '', $stripped = 'false' ) {
extract( $args ); ?>

	<div id="meta-box-<?php echo sanitize_html_class( $name ); ?>" class="gp-option gp-colorpicker<?php if ( $stripped == 'true' ) { ?> gp-stripped<?php } ?>">
		
		<script>
			jQuery( document ).ready( function( $ ) { 
				$( '#<?php echo sanitize_html_class( $name ); ?>' ).wpColorPicker();
			} );
		</script>
		
		<?php if ( isset( $title ) ) { ?><h4><?php echo $title; ?></h4><?php } ?>
		
		<input type="text" name="<?php echo sanitize_html_class( $name ); ?>" id="<?php echo sanitize_html_class( $name ); ?>" value="<?php if ( $value != '' ) { echo esc_html( $value, 1 ); } else { echo $std; } ?>" placeholder="<?php echo $placeholder; ?>" />	
		
		<div id="<?php echo sanitize_html_class( $name ); ?>_picker"></div>
		
		<?php if ( isset( $desc ) ) { ?><div class="gp-option-desc"><?php echo $desc; ?></div><?php } ?>
		
		<input type="hidden" name="<?php echo sanitize_html_class( $name ); ?>_noncename" id="<?php echo sanitize_html_class( $name ); ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	
	</div>
	
<?php }

if ( is_admin() && ( $pagenow == "post.php" OR $pagenow == "post-new.php" ) ) {

	function ghostpool_admin_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'gp-admin-css', ghostpool_css_uri . 'admin.css' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'gp-uploader', ghostpool_scripts_uri . 'uploader.js' );	
	}
	add_action( 'admin_enqueue_scripts', 'ghostpool_admin_scripts' );

}

function ghostpool_save_meta_data( $post_id ) {

	global $post;

	if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {
		$meta_boxes = array_merge( ghostpool_post_meta_boxes() );
	} elseif ( isset( $_POST['post_type'] ) && 'slide' == $_POST['post_type'] ) {
		$meta_boxes = array_merge( ghostpool_slide_meta_boxes() );					
	} else {
		$meta_boxes = array_merge( ghostpool_page_meta_boxes() );
	}
				
	foreach ( $meta_boxes as $meta_box ) {
		
		if ( isset( $meta_box['name'] ) ) {
			if ( ! isset( $_POST[$meta_box['name'] . '_noncename'] ) OR ! wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) ) {
				return $post_id;
			}
		}
					
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		      
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		if ( isset( $_POST[$meta_box['name']] ) ) {			
			$data = sanitize_text_field( $_POST[$meta_box['name']] );
		} else {
			$data = '';
		}
		
		if ( isset( $meta_box['name'] ) ) {
			if ( get_post_meta( $post_id, $meta_box['name'] ) == '' ) {
				add_post_meta( $post_id, $meta_box['name'], $data, true );
			} elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) ) {
				update_post_meta( $post_id, $meta_box['name'], $data );
			} elseif ( $data == '' ) {
				delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
			}
		}
				
	}
	
}

?>