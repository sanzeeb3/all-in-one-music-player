/* global audio_files */
/* jshint esversion: 6 */

/**
 * @todo: A better solution for this. Issue: https://github.com/WordPress/gutenberg/issues/8379
 */

// Trigger things on frontend.
jQuery( function ($) {

	const aplayerInit = function() {

		if ( typeof APlayer != 'undefined' ) {

			// APlayer.
			const aplayer = new APlayer({
			    container: document.getElementById('aplayer'),
			    audio: audio_files
			});
		}
	};

	if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
		return;
	}

	aplayerInit();
});

