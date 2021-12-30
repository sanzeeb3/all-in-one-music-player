/**
 * global audio_files
 *
 * jshint esversion: 6
 *
 * Flatblack JS.
 *
 * @todo A better solution for this. Issue: https://github.com/WordPress/gutenberg/issues/8379
 */
jQuery( function ($) {

	// Check if the page has a Flatblack player ID.
	if ( jQuery( 'body' ).find( '#flat-black-player-container' ).length === 0  ) {
		return;
	}

	// Initialize Flatblack in the frontend. Block editor does not load fully at this point.
	flatBlackInit();
});

// Initialize the Flatblack when the block is clicked. "musicPlayerInitialize" is in block.js inside block directory. Unfortunately, I can't find any event when the block gets fully loaded which would be more appropriate event.
document.addEventListener(
	'musicPlayerInitialize',
	function( e ) {

		// Check if the page has a Flatblack player ID.
		if ( jQuery( 'body' ).find( '#flat-black-player-container' ).length === 0  ) {
			return;
		}

		// Initialize Flatblack in the block.
		flatBlackInit();
	},
	false
);

/**
 * Initialize the FlatBlack Player.
 *
 * @return void.
 */
const flatBlackInit = function() {

	/*
	  Handles a click on the down button to slide down the playlist.
	*/
	document.getElementsByClassName('down-header')[0].addEventListener('click', function(){
	  var list = document.getElementById('list');

	  list.style.height = ( parseInt( document.getElementById('flat-black-player-container').offsetHeight ) - 135 ) + 'px';

	  document.getElementById('list-screen').classList.remove('slide-out-top');
	  document.getElementById('list-screen').classList.add('slide-in-top');
	  document.getElementById('list-screen').style.display = "block";
	});

	/*
	  Handles a click on the up arrow to hide the list screen.
	*/
	document.getElementsByClassName('hide-playlist')[0].addEventListener('click', function(){
	  document.getElementById('list-screen').classList.remove('slide-in-top');
	  document.getElementById('list-screen').classList.add('slide-out-top');
	  document.getElementById('list-screen').style.display = "none";
	});

	/*
	  Handles a click on the song played progress bar.
	*/
	document.getElementById('song-played-progress').addEventListener('click', function( e ){
	  var offset = this.getBoundingClientRect();
	  var x = e.pageX - offset.left;

	  Amplitude.setSongPlayedPercentage( ( parseFloat( x ) / parseFloat( this.offsetWidth) ) * 100 );
	});

	document.querySelector('img[data-amplitude-song-info="cover_art_url"]').style.height = document.querySelector('img[data-amplitude-song-info="cover_art_url"]').offsetWidth + 'px';

	Amplitude.init({
	  "songs": audio_files
	});
}
