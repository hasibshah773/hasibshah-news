<?php
/**
 * Custom template tags for HasibShah News
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post date/time.
	 */
	function hasibshah_news_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated screen-reader-text" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'hasibshah_news_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function hasibshah_news_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'hasibshah-news' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'hasibshah_news_nav_fallback' ) ) :
	/**
	 * Fallback menu callback when no primary menu is assigned.
	 *
	 * Dynamically accepts wp_nav_menu $args to output distinct IDs
	 * and classes for desktop and mobile navigation containers, preventing
	 * duplicate DOM IDs and ensuring consistent responsive styling.
	 *
	 * @param array|object $args Arguments from wp_nav_menu().
	 * @return string|void Echoes or returns navigation markup.
	 */
	function hasibshah_news_nav_fallback( $args = array() ) {
		$menu_args = is_object( $args ) ? (array) $args : (array) $args;

		$menu_id    = ! empty( $menu_args['menu_id'] ) ? $menu_args['menu_id'] : 'primary-menu';
		$menu_class = ! empty( $menu_args['menu_class'] ) ? $menu_args['menu_class'] : 'news-primary-nav-menu';
		$echo       = isset( $menu_args['echo'] ) ? (bool) $menu_args['echo'] : true;

		$pages_output = wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 2,
				'number'   => 8,
				'echo'     => false,
			)
		);

		$output  = '<ul id="' . esc_attr( $menu_id ) . '" class="' . esc_attr( $menu_class ) . '">';
		$output .= $pages_output;
		$output .= '</ul>';

		if ( $echo ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
	}
endif;

