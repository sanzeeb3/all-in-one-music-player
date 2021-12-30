// Trigger things on frontend.
jQuery( function ($) {

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

	if ( jQuery( 'body' ).find( '#blue-playlist-container' ).length === 0  ) {
		return;
	}

	bluePlaylistInit();
});
