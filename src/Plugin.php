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
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/music-player/music-player-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/music-player-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'music-player' );

		load_textdomain( 'music-player', WP_LANG_DIR . '/music-player/music-player-' . $locale . '.mo' );
		load_plugin_textdomain( 'music-player', false, plugin_basename( dirname( MUSIC_PLAYER ) ) . '/languages' );
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

		register_block_type(
			'music-player/music-player',
			array(
				'editor_script'   => 'music-player-block',
				'render_callback' => 'wpf_delete_account_content',
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
			'music-player-block',
			plugins_url( 'assets/js/admin/block.js', MUSIC_PLAYER ),
			array( 'wp-blocks', 'wp-editor' ),
			MUSIC_PLAYER_VERSION,
			true
		);
	}
}