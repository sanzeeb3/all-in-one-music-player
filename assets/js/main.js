/**
 * global audio_files
 *
 * jshint esversion: 6
 *
 * Main JS. For only the APlayer functionality. Filename is not so obvious.
 *
 * @todo A better solution for this. Issue: https://github.com/WordPress/gutenberg/issues/8379
 */
jQuery( function ($) {

	// Check if the page has a APLayer ID.
	if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
		return;
	}

	// Initialize APlayer in the frontend. Block editor does not load fully at this point.
	aplayerInit();
});

// Initialize the APlayer when the block is clicked. "musicPlayerInitialize" is in block.js inside block directory. Unfortunately, I can't find any event when the block gets fully loaded which would be more appropriate event.
document.addEventListener(
	'musicPlayerInitialize',
	function( e ) {

		// Check if the page has a APLayer ID.
		if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
			return;
		}

		// Initialize APlayer in the block.
		aplayerInit();
	},
	false
);

/**
 * Initialize the APlayer.
 *
 * @return void.
 */
const aplayerInit = function() {

	if ( typeof APlayer != 'undefined' ) {

		// APlayer.
		const aplayer = new APlayer({
		    container: document.getElementById('aplayer'),
		    audio: audio_files
		});
	}
};
