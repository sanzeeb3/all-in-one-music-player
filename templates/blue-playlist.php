 <!-- Blue Playlist Container -->
<div id="blue-playlist-container">

<!-- Amplitude Player -->
<div id="amplitude-player">

<!-- Left Side Player -->
<div id="amplitude-left">
	<img data-amplitude-song-info="cover_art_url" class="album-art"/>
	<div class="amplitude-visualization" id="large-visualization">

	</div>
	<div id="player-left-bottom">
		<div id="time-container">
			<span class="current-time">
				<span class="amplitude-current-minutes" ></span>:<span class="amplitude-current-seconds"></span>
			</span>
			<div id="progress-container">
				<div class="amplitude-wave-form">

								</div>
				<input type="range" class="amplitude-song-slider"/>
				<progress id="song-played-progress" class="amplitude-song-played-progress"></progress>
				<progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
			</div>
			<span class="duration">
				<span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
			</span>
		</div>

		<div id="control-container">
			<div id="repeat-container">
				<div class="amplitude-repeat" id="repeat"></div>
				<div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
			</div>

			<div id="central-control-container">
				<div id="central-controls">
					<div class="amplitude-prev" id="previous"></div>
					<div class="amplitude-play-pause" id="play-pause"></div>
					<div class="amplitude-next" id="next"></div>
				</div>
			</div>

			<div id="volume-container">
				<div class="volume-controls">
					<div class="amplitude-mute amplitude-not-muted"></div>
					<input type="range" class="amplitude-volume-slider"/>
					<div class="ms-range-fix"></div>
				</div>
				<div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle-right"></div>
			</div>
		</div>

		<div id="meta-container">
			<span data-amplitude-song-info="name" class="song-name"></span>

			<div class="song-artist-album">
				<span data-amplitude-song-info="artist"></span>
				<span data-amplitude-song-info="album"></span>
			</div>
		</div>
	</div>
</div>
<!-- End Left Side Player -->

<!-- Right Side Player -->
<div id="amplitude-right">

	 <div id="list">

		    <?php

		    	for ( $i = 0; $i < count( $songs ); $i++ ) {
		    		?>
		    			<div class="song amplitude-song-container amplitude-play-pause" data-amplitude-song-index="<?php echo $i;?>">
				            <div class="song-meta-container">
				              <span class="song-name" data-amplitude-song-info="name" data-amplitude-song-index="<?php echo $i;?>"></span>
				              <span class="song-artist-album"><span data-amplitude-song-info="artist" data-amplitude-song-index="<?php echo $i;?>"></span> <span data-amplitude-song-info="album" data-amplitude-song-index="<?php echo $i;?>"></span></span>
				            </div>
		      			</div>
		      			<hr>
		    		<?php
		    	}
		    ?>

        </div>

</div>
<!-- End Right Side Player -->
</div>
