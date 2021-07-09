<?php
/**
 * Plugin Name: All in One Music Player
 * Description: Easily embed your favourite music player in your website.
 * Version: 1.1.1
 * Author: Sanjeev Aryal
 * Author URI: https://www.sanjeebaryal.com.np
 * Text Domain: all-in-one-music-player
 * Domain Path: /languages/
 *
 * @package    All in One Music Player
 * @author     Sanjeev Aryal
 * @link       https://github.com/sanzeeb3/all-in-one-music-player
 * @since      1.0.0
 * @license    GPL-3.0+
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'AIO_MUSIC_PLAYER', __FILE__ );

// Plugin Folder Path.
if ( ! defined( 'AIO_MUSIC_PLAYER_PLUGIN_DIR' ) ) {
	define( 'AIO_MUSIC_PLAYER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Plugin version.
 *
 * @var string
 */
const AIO_MUSIC_PLAYER_VERSION = '1.1.1';

require_once __DIR__ . '/src/Plugin.php';

/**
 * Return the main instance of Plugin Class.
 *
 * @since  1.0.0
 *
 * @return Plugin.
 */
function aio_music_player() {
	$instance = MusicPlayer\Plugin::get_instance();
	$instance->init();

	return $instance;
}

aio_music_player();
