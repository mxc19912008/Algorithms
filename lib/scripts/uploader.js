jQuery( document ).ready( function( $ ) {

	'use strict';


	/*--------------------------------------------------------------
	Single Media Upload
	--------------------------------------------------------------*/

	if ( $('.gp-option').hasClass('gp-upload') ) { 
	
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;
		$( '.gp-upload .button' ).click( function( e ) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $( this );
			var id = button.attr( 'id' ).replace( '_button', '' );
			_custom_media = true;
			wp.media.editor.send.attachment = function( props, attachment ) {
				if ( _custom_media ) {
					$( '#' + id ).val( attachment.url );
				} else {
					return _orig_send_attachment.apply( this, [props, attachment] );
				}
			};
			wp.media.editor.open( button );
			return false;
		});
		$( '.add_media' ).on( 'click', function() {
			_custom_media = false;
		});
	
	}
		

	/*--------------------------------------------------------------
	Gallery Upload
	--------------------------------------------------------------*/

	if ( $('.gp-option').hasClass('gp-gallery-upload') ) { 
	
		// Uploading files
		var gallery_frame;
		var $image_gallery_ids = $( '.gp-gallery' );
		var $gallery_images = $( '#gallery-images-container ul.gallery-images' );

		jQuery( '.add-gallery-images' ).on( 'click', 'input', function( event ) {

			var $el = $( this );
			var attachment_ids = $image_gallery_ids.val();

			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( gallery_frame ) {
				gallery_frame.open();
				return;
			}

			// Create the media frame.
			gallery_frame = wp.media.frames.downloadable_file = wp.media({
				// Set the title of the modal.
				title: 'Add Images',
				button: {
					text: 'Add Images',
				},
				multiple: true
			});

			// When an image is selected, run a callback.
			gallery_frame.on( 'select', function() {

				var selection = gallery_frame.state().get( 'selection' );

				selection.map( function( attachment ) {

					attachment = attachment.toJSON();

					if ( attachment.id ) {
						attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

						$gallery_images.append( '\
							<li class="image" data-attachment_id="' + attachment.id + '">\
								<img src="' + attachment.url + '" />\
								<a href="#" class="delete" title="Delete image"></a>\
							</li>' );
					}

				} );

				$image_gallery_ids.val( attachment_ids );
			});

			// Finally, open the modal.
			gallery_frame.open();
		});

		// Image ordering
		$gallery_images.sortable({
			items: 'li.image',
			cursor: 'move',
			scrollSensitivity:40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.65,
			placeholder: 'gp-gallery-upload-placeholder',
			start:function( event,ui ){
				ui.item.css( 'background-color','#f6f6f6' );
			},
			stop:function( event,ui ){
				ui.item.removeAttr( 'style' );
			},
			update: function(event, ui ) {
				var attachment_ids = '';

				$( '#gallery-images-container ul li.image' ).css( 'cursor','default' ).each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$image_gallery_ids.val( attachment_ids );
			}
		});

		// Remove images
		$( '#gallery-images-container' ).on( 'click', 'a.delete', function() {

			$(this).closest( 'li.image' ).remove();

			var attachment_ids = '';

			$( '#gallery-images-container ul li.image').css( 'cursor','default' ).each(function() {
				var attachment_id = jQuery(this).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );

			return false;
		
		});
	
	}
	
			
});