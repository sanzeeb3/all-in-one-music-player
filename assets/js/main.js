/* global audio_files */
/* jshint esversion: 6 */

/**
 * @todo: A better solution for this. Issue: https://github.com/WordPress/gutenberg/issues/8379
 */

// Trigger things on frontend.
jQuery( function ($) {

	if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
		return;
	}

	aplayerInit();
});

document.addEventListener(
	'musicPlayerInitialize',
	function( e ) {

		if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
			return;
		}

		window.setTimeout( aplayerInit, 20 );
	},
	false
);

const aplayerInit = function() {

	if ( typeof APlayer != 'undefined' ) {

		// APlayer.
		const aplayer = new APlayer({
		    container: document.getElementById('aplayer'),
		    audio: audio_files
		});
	}
};
