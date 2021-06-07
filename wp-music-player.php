<?php
/**
 * Plugin Name: Music Player
 * Description: TBD.
 * Version: 1.0.0
 * Author: Sanjeev Aryal
 * Author URI: https://www.sanjeebaryal.com.np
 * Text Domain: music-player
 * Domain Path: /languages/
 *
 * @package    Music Player
 * @author     Sanjeev Aryal
 * @link       https://github.com/sanzeeb3/music-player
 * @since      1.0.0
 * @license    GPL-3.0+
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'MUSIC_PLAYER', __FILE__ );

/**
 * Plugin version.
 *
 * @var string
 */
const MUSIC_PLAYER_VERSION = '1.0.0';

require_once __DIR__ . '/src/Plugin.php';

/**
 * Return the main instance of Plugin Class.
 *
 * @since  1.0.0
 *
 * @return Plugin.
 */
function music_player() {
    $instance = MusicPlayer\Plugin::get_instance();
    $instance->init();

    return $instance;
}

music_player();