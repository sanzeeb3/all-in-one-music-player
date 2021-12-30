/**
 * global audio_files
 *
 * jshint esversion: 6
 *
 * Blue Playlist JS.
 *
 * @todo A better solution for this. Issue: https://github.com/WordPress/gutenberg/issues/8379
 */
jQuery( function ($) {

	// Check if the page has a Blueplaylist player ID.
	if ( jQuery( 'body' ).find( '#blue-playlist-container' ).length === 0  ) {
		return;
	}

	// Initialize blueplaylist in the frontend. Block editor does not load fully at this point.
	bluePlaylistInit();
});

// Initialize the APlayer when the block is clicked. "musicPlayerInitialize" is in block.js inside block directory. Unfortunately, I can't find any event when the block gets fully loaded which would be more appropriate event.
document.addEventListener(
	'musicPlayerInitialize',
	function( e ) {

		// Check if the page has a Blueplaylist player ID.
		if ( jQuery( 'body' ).find( '#blue-playlist-container' ).length === 0  ) {
			return;
		}

		// Initialize Blueplaylist in the block.
		bluePlaylistInit();
	},
	false
);

/**
 * Initialize the Blueplaylist Player.
 *
 * @return void.
 */
const bluePlaylistInit = function() {

	/*
		When the bandcamp link is pressed, stop all propagation so AmplitudeJS doesn't
		play the song.
	*/
	let bandcampLinks = document.getElementsByClassName('bandcamp-link');

	for( var i = 0; i < bandcampLinks.length; i++ ){
		bandcampLinks[i].addEventListener('click', function(e){
			e.stopPropagation();
		});
	}


	let songElements = document.getElementsByClassName('song');

	for( var i = 0; i < songElements.length; i++ ){
		/*
			Ensure that on mouseover, CSS styles don't get messed up for active songs.
		*/
		songElements[i].addEventListener('mouseover', function(){
			this.style.backgroundColor = '#00A0FF';
		});

		/*
			Ensure that on mouseout, CSS styles don't get messed up for active songs.
		*/
		songElements[i].addEventListener('mouseout', function(){
			this.style.backgroundColor = '#FFFFFF';
		});
	}

	Amplitude.init({
	  "songs": audio_files
	});
}
