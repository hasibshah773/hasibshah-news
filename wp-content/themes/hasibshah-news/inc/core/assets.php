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

		// 3. Header, navigation, and breaking news ticker styles.
		wp_enqueue_style(
			'hasibshah-news-header',
			HASIBSHAH_NEWS_URI . '/assets/css/header.css',
			array( 'hasibshah-news-layout' ),
			HASIBSHAH_NEWS_VERSION
		);

		// 4. Reusable editorial news components, cards, and section layouts.
		wp_enqueue_style(
			'hasibshah-news-components',
			HASIBSHAH_NEWS_URI . '/assets/css/components.css',
			array( 'hasibshah-news-header' ),
			HASIBSHAH_NEWS_VERSION
		);

		// 5. Single article typography, bylines, social share, and comments.
		if ( is_singular() ) {
			wp_enqueue_style(
				'hasibshah-news-single',
				HASIBSHAH_NEWS_URI . '/assets/css/single.css',
				array( 'hasibshah-news-components' ),
				HASIBSHAH_NEWS_VERSION
			);
		}

		// 6. Archive, category, district, search, author, and 404 templates.
		if ( is_archive() || is_search() || is_404() || is_home() ) {
			wp_enqueue_style(
				'hasibshah-news-archive',
				HASIBSHAH_NEWS_URI . '/assets/css/archive.css',
				array( 'hasibshah-news-components' ),
				HASIBSHAH_NEWS_VERSION
			);
		}

		// 7. Primary theme stylesheet.
		wp_enqueue_style(
			'hasibshah-news-style',
			get_stylesheet_uri(),
			array( 'hasibshah-news-components' ),
			HASIBSHAH_NEWS_VERSION
		);

		// 8. Navigation, mobile drawer, and interactive controls script.
		wp_enqueue_script(
			'hasibshah-news-navigation',
			HASIBSHAH_NEWS_URI . '/assets/js/navigation.js',
			array(),
			HASIBSHAH_NEWS_VERSION,
			true
		);

		// Conditionally enqueue comment reply script for threaded discussions.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'hasibshah_news_scripts' );

