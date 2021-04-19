<?php
/**
 * Mantranews functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mantrabrain
 * @subpackage Mantranews
 * @since 1.0.0
 */


define('MANTRANEWS_THEME_VERSION', '1.1.5');
define('MANTRANEWS_THEME_SETTINGS', 'mantranews-settings');

define('MANTRANEWS_THEME_DIR', trailingslashit(get_template_directory()));
define('MANTRANEWS_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));


// Theme Core file init
require_once MANTRANEWS_THEME_DIR . 'core/class-mantranews-core.php';

function Mantranews()
{
    return Mantranews_Core::get_instance();
}

Mantranews();

