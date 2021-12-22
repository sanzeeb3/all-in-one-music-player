## All in One Music Player

Your favourite music player on your WordPress site :boom:

![Don't stop the music](https://github.com/sanzeeb3/all-in-one-music-player/blob/master/the-music.gif)

## Installation:

1) Download the plugin: https://wordpress.org/plugins/all-in-one-music-player/
2) Upload the plugin in your site.
3) Go to the posts or pages.
4) Add a block "All in one music player".
5) Choose the music player.
6) That's it.

All in One Music Player automatically plays the media found on your media gallery.

## Documentation ##

https://sanjeebaryal.com.np/all-in-one-music-player

## Credits ##

1) APlayer (https://github.com/DIYgod/APlayer).
2) AmplitudeJS (https://github.com/serversideup/amplitudejs/).


## Modifying the audio-files:

```

add_filter(
	'all_in_one_music_player_audio_files_data',
	function( $audio ) {

		$audio = array(
			array(
				'artist'        => 'The Shadows',
				'song'          => 'Prakriti',
				'name'          => 'Prakriti',
				'url'           => 'https://sanjeebaryal.com.np/wp-content/uploads/2021/10/bensound-happyrock.mp3',
				'cover_art_url' => 'https://sanjeebaryal.com.np/wp-content/uploads/2021/06/All-in-one-music-player.png',
				'cover'         => 'https://sanjeebaryal.com.np/wp-content/uploads/2021/06/All-in-one-music-player.png',
				'length'        => '4:30',
			),
		);

		return $audio;
	}
);

```
