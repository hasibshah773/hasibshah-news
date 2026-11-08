<?php
/**
 * Elementor Page Builder Compatibility & Integration
 *
 * Implements theme support for Elementor, neutral container resets,
 * editor mode safety guards to prevent iframe freezes, and seamless
 * Elementor Canvas & Full Width template handling.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_is_elementor_active' ) ) :
	/**
	 * Checks whether Elementor is installed and loaded.
	 *
	 * @return bool
	 */
	function hasibshah_news_is_elementor_active() {
		return (bool) did_action( 'elementor/loaded' );
	}
endif;

if ( ! function_exists( 'hasibshah_news_is_elementor_editor' ) ) :
	/**
	 * Checks whether the current request is inside Elementor Editor mode or Preview.
	 *
	 * @return bool
	 */
	function hasibshah_news_is_elementor_editor() {
		if ( ! hasibshah_news_is_elementor_active() ) {
			return false;
		}

		if ( isset( \Elementor\Plugin::$instance->editor ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			return true;
		}

		if ( isset( \Elementor\Plugin::$instance->preview ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'hasibshah_news_elementor_setup' ) ) :
	/**
	 * Registers Elementor theme support flags.
	 */
	function hasibshah_news_elementor_setup() {
		// Declare Elementor theme support
		add_theme_support( 'elementor' );
	}
endif;
add_action( 'after_setup_theme', 'hasibshah_news_elementor_setup' );

if ( ! function_exists( 'hasibshah_news_register_elementor_locations' ) ) :
	/**
	 * Registers support for Elementor Pro Theme Builder locations.
	 *
	 * @param \ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager
	 */
	function hasibshah_news_register_elementor_locations( $elementor_theme_manager ) {
		$elementor_theme_manager->register_all_core_location();
	}
endif;
add_action( 'elementor/theme/register_locations', 'hasibshah_news_register_elementor_locations' );

if ( ! function_exists( 'hasibshah_news_elementor_scripts_and_styles' ) ) :
	/**
	 * Enqueues Elementor compatibility styles and passes editor safety flags.
	 */
	function hasibshah_news_elementor_scripts_and_styles() {
		// Only enqueue when Elementor is active
		if ( ! hasibshah_news_is_elementor_active() ) {
			return;
		}

		// Enqueue neutral compatibility styles
		wp_enqueue_style(
			'hasibshah-news-elementor-compat',
			HASIBSHAH_NEWS_URI . '/assets/css/elementor-compat.css',
			array( 'hasibshah-news-components' ),
			HASIBSHAH_NEWS_VERSION
		);

		// Pass editor mode safety flag to theme navigation / ticker scripts
		if ( hasibshah_news_is_elementor_editor() ) {
			wp_localize_script(
				'hasibshah-news-navigation',
				'hasibshahNewsEditorMode',
				array(
					'isElementorEditor' => true,
				)
			);
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'hasibshah_news_elementor_scripts_and_styles', 20 );

if ( ! function_exists( 'hasibshah_news_elementor_body_classes' ) ) :
	/**
	 * Adds contextual Elementor classes to the <body> tag.
	 *
	 * @param array $classes Existing body classes.
	 * @return array Modified body classes.
	 */
	function hasibshah_news_elementor_body_classes( $classes ) {
		if ( ! hasibshah_news_is_elementor_active() ) {
			return $classes;
		}

		$classes[] = 'elementor-support-active';

		if ( hasibshah_news_is_elementor_editor() ) {
			$classes[] = 'hasibshah-news-elementor-editor';
		}

		if ( is_singular() ) {
			$post_id = get_the_ID();
			$is_built = get_post_meta( $post_id, '_elementor_edit_mode', true );
			if ( 'builder' === $is_built ) {
				$classes[] = 'hasibshah-news-built-with-elementor';
			}
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'hasibshah_news_elementor_body_classes' );
