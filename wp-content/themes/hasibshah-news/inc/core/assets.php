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
		// 1. Base styles, font definitions, and design tokens.
		wp_enqueue_style(
			'hasibshah-news-base',
			HASIBSHAH_NEWS_URI . '/assets/css/base.css',
			array(),
			HASIBSHAH_NEWS_VERSION
		);

		// 2. Responsive layout engine and newspaper grid.
		wp_enqueue_style(
			'hasibshah-news-layout',
			HASIBSHAH_NEWS_URI . '/assets/css/layout.css',
			array( 'hasibshah-news-base' ),
			HASIBSHAH_NEWS_VERSION
		);

		// 3. Primary theme stylesheet.
		wp_enqueue_style(
			'hasibshah-news-style',
			get_stylesheet_uri(),
			array( 'hasibshah-news-layout' ),
			HASIBSHAH_NEWS_VERSION
		);

		// Conditionally enqueue comment reply script for threaded discussions.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'hasibshah_news_scripts' );

