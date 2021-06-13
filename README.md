## All in One Music Player

Your favourite music player on your website :boom:

## Development guidelines:

1) Clone the repo: 

```git clone git@github.com:sanzeeb3/all-in-one-music-player.git```

2) Checkout at all-in-one-music player directory.

3) Run commands:

```npm install```

```composer install```

```npm run build```


block.js is written in ESNext standard and webpack.config.js has a config to compile it to ES5 standard to make it readable. `npm run build` performs this task.

3) Create a new branch.

4) Make changes. If there's any changes in assets/js/block/block.js, to see the changes run ```npm run build```

5) Commit:

git commit -am "Useful messaage" --no-verify

write `--no-verify` if absolutely required. The husky in package.json checks for the coding standard and rules set in phpcs.xml. `--no-verify` bypasses this check.

6) Push the changs:

`git push origin 'the-branch'`



### Adding a new Music Player:

To add  new music player, all we need is a HTML, JS and CSS files.

Example adding visualization player: https://521dimensions.com/open-source/amplitudejs/docs/examples/visualization-player.html

In the example, there's a HTML, CSS and JS section.


Steps:


1) Edit in assets/jsblock/block.js, see line number 52. There are other music player options to choose from. So, let us add 'Visualization' player

``{ value: 'visualization', label: 'Visualization' },``

2) Copy the CSS, and create a file in assets/css/visualization.css
3) Copy the JS, and create a file in assets/js/visualization.js
4) Copy the PHP, and create a file in templates/visualization.php


5) Enqueue the addded CSS and JS.

In src/Plugin.php around line 124 see how files are enqueued. let us enqueue visualization.js

```
// Enqueue JS.
wp_enqueue_script(
  'visualization-script',
  plugins_url( 'assets/js/visualization.js', AIO_MUSIC_PLAYER ),
  array( 'jquery' ),
  AIO_MUSIC_PLAYER_VERSION,
  true
);

// Enqueue CSS.
wp_enqueue_style(
  'visualization-style',
  plugins_url( 'assets/css/visualization.css', AIO_MUSIC_PLAYER ),
  array(),
  AIO_MUSIC_PLAYER_VERSION,
  false
);

// Localize to pass variables to JS.
wp_localize_script( 'visualization-script', 'audio_files', $this->get_audio_files() );
```

That's it. There should be a new Option in block editor to change the music player.

But, the songs in these files are dummy and should be changes.

So, let's go to newly added assets/js/visualization.js and change to 

```
Amplitude.init({
  "bindings": {
    37: 'prev',
    39: 'next',
    32: 'play_pause'
  },
  "songs": audio_files
});
```


The `audio_files` is a variable passed to JS with wp_localize_script, see above. which gives all the songs in the WordPress media library to play.

Similarly, changes in templates/visualization.php is required to add dynamic songs. See, blue-playlist.php and adjust accordingly. Should be just a small tweaks.


That's all! Happy developing!
