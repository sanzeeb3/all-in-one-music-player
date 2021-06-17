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
	public function load_assets() { //phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh

		if ( is_admin() ) {
			// block.min.js isn't required on the frontend. The check is only required for 'wp_enqueue_scripts'. 'enqueue_block_editor_assets' automatically loads only on block editor.

			wp_enqueue_script(
				'all-in-one-music-player-block-script',
				plugins_url( 'assets/js/block/block.min.js', AIO_MUSIC_PLAYER ),
				array( 'wp-blocks', 'wp-editor' ),
				AIO_MUSIC_PLAYER_VERSION,
				true
			);

			$all_in_one_music_player = array(
				'icon_url' => plugins_url( 'assets/img/logo.png', AIO_MUSIC_PLAYER ),
			);

			wp_localize_script( 'all-in-one-music-player-block-script', 'aio_music_player', $all_in_one_music_player );
		}

		/**
		 * Amplitude.js loads separately because of version and needs update and regular monitor.
		 *
		 * @see https://github.com/serversideup/amplitudejs/
		 */
		wp_enqueue_script(
			'amplitude-player-script',
			plugins_url( 'assets/js/amplitude.js', AIO_MUSIC_PLAYER ),
			array( 'jquery' ),
			'5.3.1',
			true
		);

		$assets = array(
			'circular-spikes',
			'a-player',
			'flat-black',
			'blue-playlist',
			'main',
		);

		// Load assets conditionally on frontend.
		if ( ! is_admin() ) {

			global $post;

			$blocks = isset( $post->post_content ) ? parse_blocks( $post->post_content ) : array();

			$assets = array();

			foreach ( $blocks as $block ) {
				if ( 'all-in-one-music-player/music-player-selector' === $block['blockName'] ) {
					$assets[] = ! empty( $block['attrs']['theme'] ) ? $block['attrs']['theme'] : 'a-player';
				}
			}

			$assets[] = 'main';
		}

		foreach ( $assets as $asset ) {

			wp_enqueue_style(
				$asset . '-style',
				plugins_url( 'assets/css/' . $asset . '.css', AIO_MUSIC_PLAYER ),
				array(),
				AIO_MUSIC_PLAYER_VERSION,
				false
			);

			/**
			 * Enqueue Scripts. APLayer is versioned separately.
			 *
			 * @see For APlayer: https://github.com/DIYgod/APlayer
			 *
			 */
			wp_enqueue_script(
				$asset . '-script',
				plugins_url( 'assets/js/' . $asset . '.js', AIO_MUSIC_PLAYER ),
				array( 'jquery' ),
				'a-player' === $asset ? '1.10.1' : AIO_MUSIC_PLAYER_VERSION,
				true
			);

			wp_localize_script( $asset . '-script', 'audio_files', $this->get_audio_files() );
		};
	}

	/**
	 * Get all audio files in the Media Library and prepare them.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_audio_files() {

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

			// Cover for all Amplitude.js.
			$audio_files_data[ $key ]['cover_art_url'] = ! empty( get_the_post_thumbnail_url( $file->ID ) ) ? get_the_post_thumbnail_url( $file->ID ) : plugins_url( 'assets/img/logo.png', AIO_MUSIC_PLAYER );

			// Cover for aPlayer.
			$audio_files_data[ $key ]['cover'] = ! empty( get_the_post_thumbnail_url( $file->ID ) ) ? get_the_post_thumbnail_url( $file->ID ) : plugins_url( 'assets/img/logo.png', AIO_MUSIC_PLAYER );
		}

		return $audio_files_data;
	}

	/**
	 * Displays the music player.
	 *
	 * @param array $attr Attributes choosen from the block settings.
	 *
	 * @since 1.0.0
	 *
	 * @return string An HTML.
	 */
	public function music_player_content( $attr ) {

		$songs = $this->get_audio_files();

		$theme = ! empty( $attr['theme'] ) ? $attr['theme'] : '';

		if ( empty( $theme ) ) {
			return esc_html__( 'No music player selected.', 'all-in-one-music-player' );
		}

		ob_start();

		include AIO_MUSIC_PLAYER_PLUGIN_DIR . 'templates/' . $theme . '.php';

		return ob_get_clean();
	}
}
