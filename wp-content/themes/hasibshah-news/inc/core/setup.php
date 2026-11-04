<?php
/**
 * Theme Setup and Configuration
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function hasibshah_news_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'hasibshah-news', HASIBSHAH_NEWS_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		// Register custom editorial image sizes.
		add_image_size( 'hasibshah-news-lead', 1200, 675, true );  // 16:9 Lead Story Cover
		add_image_size( 'hasibshah-news-card', 600, 400, true );   // 3:2 Standard News Card
		add_image_size( 'hasibshah-news-thumb', 150, 150, true );  // 1:1 Square News Thumbnail

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'hasibshah-news' ),
				'topbar'  => esc_html__( 'Top Bar Menu', 'hasibshah-news' ),
				'footer'  => esc_html__( 'Footer Menu', 'hasibshah-news' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom logo feature.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 350,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content (YouTube, Vimeo, etc.).
		add_theme_support( 'responsive-embeds' );

		// Add support for wide and full alignment in Gutenberg blocks.
		add_theme_support( 'align-wide' );

		// Enable editor styles so Gutenberg matches front-end typography.
		add_theme_support( 'editor-styles' );
	}
endif;
add_action( 'after_setup_theme', 'hasibshah_news_setup' );
