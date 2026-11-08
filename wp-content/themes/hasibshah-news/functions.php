<?php
/**
 * HasibShah News Theme Functions and Definitions
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Theme Constants
 */
define( 'HASIBSHAH_NEWS_VERSION', '1.0.0' );
define( 'HASIBSHAH_NEWS_DIR', get_template_directory() );
define( 'HASIBSHAH_NEWS_URI', get_template_directory_uri() );

/**
 * Set Content Width
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hasibshah_news_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hasibshah_news_content_width', 1280 );
}
add_action( 'after_setup_theme', 'hasibshah_news_content_width', 0 );

/**
 * Load Core Modules
 */
require_once HASIBSHAH_NEWS_DIR . '/inc/core/setup.php';
require_once HASIBSHAH_NEWS_DIR . '/inc/core/assets.php';
require_once HASIBSHAH_NEWS_DIR . '/inc/core/template-tags.php';
require_once HASIBSHAH_NEWS_DIR . '/inc/editorial/bangla-date.php';
require_once HASIBSHAH_NEWS_DIR . '/inc/editorial/news-queries.php';

/**
 * Load Compatibility Modules (Elementor & Gutenberg)
 */
require_once HASIBSHAH_NEWS_DIR . '/inc/compatibility/elementor.php';
require_once HASIBSHAH_NEWS_DIR . '/inc/compatibility/gutenberg.php';

