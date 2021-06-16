<div id="flat-black-player-container">
	<div id="list-screen" class="slide-in-top">
		<div id="list-screen-header" class="hide-playlist">
			<img id="up-arrow" src="https://521dimensions.com/img/open-source/amplitudejs/examples/flat-black/up.svg"/>
		  <?php esc_html_e( 'Hide Playlist', 'all-in-one-music-player' ); ?>
		</div>

		<div id="list">

			<?php

			for ( $i = 0; $i < count( $songs ); $i++ ) {
				?>
						<div class="song amplitude-song-container amplitude-play-pause" data-amplitude-song-index="<?php echo $i; ?>">
							<span class="song-number-now-playing">
							  <span class="number"><?php echo $i + 1; ?></span>
							  <img class="now-playing" src="https://521dimensions.com/img/open-source/amplitudejs/examples/flat-black/now-playing.svg"/>
							</span>

							<div class="song-meta-container">
							  <span class="song-name" data-amplitude-song-info="name" data-amplitude-song-index="<?php echo $i; ?>"></span>
							  <span class="song-artist-album"><span data-amplitude-song-info="artist" data-amplitude-song-index="<?php echo $i; ?>"></span> <span data-amplitude-song-info="album" data-amplitude-song-index="<?php echo $i; ?>"></span></span>
							</div>

							<span class="song-duration">
							  3:30
							<span>
						  </div>
					<?php
			}
			?>

		</div>

		<div id="list-screen-footer">
		  <div id="list-screen-meta-container">
			<span data-amplitude-song-info="name" class="song-name"></span>

			<div class="song-artist-album">
			  <span data-amplitude-song-info="artist"></span>
			</div>
		  </div>
		  <div class="list-controls">
			<div class="list-previous amplitude-prev"></div>
			<div class="list-play-pause amplitude-play-pause"></div>
			<div class="list-next amplitude-next"></div>
		  </div>
		</div>
	  </div>
	  <div id="player-screen">
		<div class="player-header down-header">
		  <img id="down" src="https://521dimensions.com/img/open-source/amplitudejs/examples/flat-black/down.svg"/>
		  <?php esc_html_e( 'Show Playlist', 'all-in-one-music-player' ); ?>
		</div>
		<div id="player-top">
		  <img data-amplitude-song-info="cover_art_url"/>
		</div>
		<div id="player-progress-bar-container">
		  <progress id="song-played-progress" class="amplitude-song-played-progress"></progress>
		  <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
		</div>
		<div id="player-middle">
		  <div id="time-container">
			<span class="amplitude-current-time time-container"></span>
			<span class="amplitude-duration-time time-container"></span>
		  </div>
		  <div id="meta-container">
			<span data-amplitude-song-info="name" class="song-name"></span>

			<div class="song-artist-album">
			  <span data-amplitude-song-info="artist"></span>
			</div>
		  </div>
		</div>
		<div id="player-bottom">
		  <div id="control-container">

			<div id="shuffle-container">
			  <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
			</div>

			<div id="prev-container">
			  <div class="amplitude-prev" id="previous"></div>
			</div>

			<div id="play-pause-container">
			  <div class="amplitude-play-pause" id="play-pause"></div>
			</div>

			<div id="next-container">
			  <div class="amplitude-next" id="next"></div>
			</div>

			<div id="repeat-container">
			  <div class="amplitude-repeat" id="repeat"></div>
			</div>

		  </div>

		  <div id="volume-container">
			  <!--   <img src="https://example.com/images/volume-control.jpg"/><input type="range" class="amplitude-volume-slider" step=".1"/> -->
		  </div>
		</div>
	  </div>
	</div>
		  
