<?php

namespace MusicPlayer;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Class.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize.
	 */
	public function init() {

		// Load plugin text domain.
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Register block.
		add_action( 'init', array( $this, 'register_block' ) );

		// Enqueue assets in block editor.
		add_action( 'enqueue_block_editor_assets', array( $this, 'load_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'load_assets' ) );

		// Enqueue assets in the frontend.
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/all-in-one-music-player/all-in-one-music-player-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/all-in-one-music-player-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'all-in-one-music-player' );

		load_textdomain( 'all-in-one-music-player', WP_LANG_DIR . '/all-in-one-music-player/all-in-one-music-player-' . $locale . '.mo' );
		load_plugin_textdomain( 'all-in-one-music-player', false, plugin_basename( dirname( AIO_MUSIC_PLAYER ) ) . '/languages' );
	}

	/**
	 * Register gutenber block.
	 *
	 * @return void.
	 */
	public function register_block() {

		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		$attributes = array(
			'theme' => array(
				'type' => 'string',
			),
		);

		register_block_type(
			'all-in-one-music-player/music-player-selector',
			array(
				'attributes'      => $attributes,
				'editor_script'   => 'all-in-one-music-player-block',
				'render_callback' => array( $this, 'music_player_content' ),
			)
		);
	}

	/**
	 * Load assets on block editor area.
	 *
	 * @return void.
	 */
	public function load_assets() {

		wp_enqueue_script(
			'all-in-one-music-player-block-script',
			plugins_url( 'assets/js/block/block.min.js', AIO_MUSIC_PLAYER ),
			array( 'wp-blocks', 'wp-editor' ),
			AIO_MUSIC_PLAYER_VERSION,
			true
		);

		// Query posts table with audio files.
		$args = array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'audio',
			'numberposts'    => -1,
		);

		$audio_files      = get_posts( $args );
		$audio_files_data = array();

		foreach ( $audio_files as $key => $file ) {

			$url                                = wp_get_attachment_url( $file->ID );
			$audio_files_data[ $key ]['artist'] = $file->post_content;
			$audio_files_data[ $key ]['song']   = $file->post_title;
			$audio_files_data[ $key ]['name']   = $file->post_title;
			$audio_files_data[ $key ]['url']    = $url;
		}

		wp_enqueue_style(
			'circular-spikes-style',
			plugins_url( 'assets/css/circular-spikes.css', AIO_MUSIC_PLAYER ),
			array(),
			AIO_MUSIC_PLAYER_VERSION,
			false
		);

		wp_enqueue_style(
			'a-player-style',
			plugins_url( 'assets/css/APlayer.min.css', AIO_MUSIC_PLAYER ),
			array(),
			AIO_MUSIC_PLAYER_VERSION,
			false
		);

		wp_enqueue_style(
			'flat-black-player-style',
			plugins_url( 'assets/css/flat-black.css', AIO_MUSIC_PLAYER ),
			array(),
			AIO_MUSIC_PLAYER_VERSION,
			false
		);

		wp_enqueue_script(
			'circular-spikes-script',
			plugins_url( 'assets/js/circular-spikes.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			AIO_MUSIC_PLAYER_VERSION,
			true
		);

		/**
		 * @see https://github.com/DIYgod/APlayer
		 */
		wp_enqueue_script(
			'a-player-script',
			plugins_url( 'assets/js/APlayer.min.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			AIO_MUSIC_PLAYER_VERSION,
			true
		);

		/**
		 * @see https://github.com/serversideup/amplitudejs/
		 */
		wp_enqueue_script(
			'amplitude-player-script',
			plugins_url( 'assets/js/amplitude.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			'5.3.1',
			true
		);

		wp_enqueue_script(
			'flat-black-player-script',
			plugins_url( 'assets/js/flat-black.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			AIO_MUSIC_PLAYER_VERSION,
			true
		);

		// Global script for all music player.
		wp_enqueue_script(
			'all-in-one-music-player-main-script',
			plugins_url( 'assets/js/main.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			AIO_MUSIC_PLAYER_VERSION,
			true
		);

		wp_localize_script( 'circular-spikes-script', 'audio_files', $audio_files_data );
		wp_localize_script( 'all-in-one-music-player-script', 'audio_files', $audio_files_data );
	}

	/**
	 * Displays the music player.
	 *
	 * @since 1.0.0
	 *
	 * @return string An HTML.
	 */
	public function music_player_content( $attr ) {

		$theme = isset( $attr['theme'] ) ? $attr['theme'] : 'aplayer';

		ob_start();

		include AIO_MUSIC_PLAYER_PLUGIN_DIR . 'templates/' . $theme . '.php';

		return ob_get_clean();

		return $theme;
	}
}
