/* global audio_files */
/* jshint esversion: 6 */

// Trigger things on frontend.
jQuery( function ($) {
	aplayerInit();
});

// Trigger things on block rendering.
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

let blockLoadedForAPlayer = false;

let blockLoadedForAPlayerInterval = setInterval(function() {

	if ( jQuery( 'body' ).find( '#aplayer' ).length === 0  ) {
		return;
	}

    if ( document.getElementById( 'post-title-1' ) ) {/*post-title-1 is ID of Post Title Textarea*/

		aplayerInit();
        blockLoadedForAPlayer = true;
    }
    if ( blockLoadedForAPlayer ) {
        clearInterval( blockLoadedForAPlayerInterval );
    }
}, 20 );


const aplayerInit = function() {

	// APlayer.
	const aplayer = new APlayer({
	    container: document.getElementById('aplayer'),
	    audio: audio_files
	});
};
