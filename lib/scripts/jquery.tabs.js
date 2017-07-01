jQuery( document ).ready( function( $ ) {

	'use strict';
	
	var panelContainer = $( '#panels' );
	
	$( '<div class="tabs"></div>' ).insertBefore( panelContainer );
	
	panelContainer.find( '.panel' ).each( function( n ) {
		$( '.tabs' ).append( '<a class="tab" href="#' + ( n + 1 ) + '">' + $( this ).attr( 'data-name' ) + '</a>' );
	});
	
	var panelLocation = location.hash.slice( 1 );
	
	if ( panelLocation ) {
		var panelNum = panelLocation;
	} else {
		var panelNum = '1';
	}
	
	panelContainer.find( '.panel' ).hide();
	
	panelContainer.find( '.panel:nth-child(' + panelNum + ')' ).fadeIn( 'slow' );
	
	$( '.tabs' ).find( 'a.tab:nth-child(' + panelNum + ')' ).removeClass().addClass( 'tab-active' );

	$( '.tabs' ).find( 'a' ).each( function( n ) {

		$( this ).click( function() {
			panelContainer.find( '.panel' ).hide();
			panelContainer.find( '.panel:nth-child(' + ( n + 1 ) + ')' ).fadeIn( 'slow' );
			$( this ).parent().find( 'a' ).removeClass().addClass( 'tab' );
			$( this ).removeClass().addClass( 'tab-active' );
		});
		
	});
	
	panelContainer.css( 'visibility', 'visible' );
	
});