<?php
/**
 * Enqueue scripts and styles
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_scripts' ) ) :
	/**
	 * Enqueue theme scripts and styles.
	 */
	function hasibshah_news_scripts() {
		// Enqueue the primary theme stylesheet.
		wp_enqueue_style(
			'hasibshah-news-style',
			get_stylesheet_uri(),
			array(),
			HASIBSHAH_NEWS_VERSION
		);

		// Conditionally enqueue comment reply script for threaded discussions.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'hasibshah_news_scripts' );
