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

		// Add support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Enable editor styles so Gutenberg matches front-end typography.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'hasibshah_news_setup' );

if ( ! function_exists( 'hasibshah_news_widgets_init' ) ) :
	/**
	 * Register widget areas.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function hasibshah_news_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Main Editorial Sidebar', 'hasibshah-news' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar on archives, posts, and search.', 'hasibshah-news' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title"><span class="widget-title-accent" aria-hidden="true"></span>',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Header Ad Banner', 'hasibshah-news' ),
				'id'            => 'header-ad-sidebar',
				'description'   => esc_html__( 'Add 728x90 leaderboard banner widget here.', 'hasibshah-news' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s header-ad-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<span class="screen-reader-text">',
				'after_title'   => '</span>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 1', 'hasibshah-news' ),
				'id'            => 'footer-sidebar-1',
				'description'   => esc_html__( 'Add widgets here to appear in the first footer column.', 'hasibshah-news' ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="footer-widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 2', 'hasibshah-news' ),
				'id'            => 'footer-sidebar-2',
				'description'   => esc_html__( 'Add widgets here to appear in the second footer column.', 'hasibshah-news' ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="footer-widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Column 3', 'hasibshah-news' ),
				'id'            => 'footer-sidebar-3',
				'description'   => esc_html__( 'Add widgets here to appear in the third footer column.', 'hasibshah-news' ),
				'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="footer-widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}
endif;
add_action( 'widgets_init', 'hasibshah_news_widgets_init' );
