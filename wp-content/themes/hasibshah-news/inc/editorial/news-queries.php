<?php
/**
 * News Queries and Editorial Helpers for HasibShah News
 *
 * Provides optimized WP_Query helpers, category badge formatters,
 * Bengali time-ago calculations, and responsive thumbnail handlers.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hasibshah_news_get_section_posts' ) ) :
	/**
	 * Executes an optimized news query for homepage editorial sections.
	 *
	 * Applies 'no_found_rows' => true by default to eliminate SQL_CALC_FOUND_ROWS
	 * overhead since non-paginated homepage sections do not require pagination totals.
	 *
	 * @param array  $args       Custom WP_Query arguments.
	 * @param string $section_id Unique identifier for the section (for filtering).
	 * @return WP_Query
	 */
	function hasibshah_news_get_section_posts( $args = array(), $section_id = '' ) {
		$defaults = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => true,
			'posts_per_page'      => 4,
		);

		$query_args = wp_parse_args( $args, $defaults );

		/**
		 * Filter query arguments for editorial sections.
		 *
		 * @param array  $query_args Formatted query arguments.
		 * @param string $section_id Section identifier.
		 */
		$filtered_args = apply_filters( 'hasibshah_news_section_query_args', $query_args, $section_id );

		return new WP_Query( $filtered_args );
	}
endif;

if ( ! function_exists( 'hasibshah_news_post_badge' ) ) :
	/**
	 * Outputs or returns a styled category badge with semantic color accents.
	 *
	 * @param int|null $post_id Optional. Post ID. Defaults to current loop post.
	 * @param bool     $echo    Optional. Whether to echo or return. Default true.
	 * @return string
	 */
	function hasibshah_news_post_badge( $post_id = null, $echo = true ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$categories = get_the_category( $post_id );
		if ( empty( $categories ) ) {
			return '';
		}

		$primary_cat = $categories[0];
		$cat_slug    = $primary_cat->slug;

		// Map common Bengali/English category slugs to design system color tokens
		$cat_class = 'badge-cat-default';
		if ( preg_match( '/(bangladesh|জাতীয়|বাংলাদেশ|desh|saradesh)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-bangladesh';
		} elseif ( preg_match( '/(politic|রাজনীতি|rajniti)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-politics';
		} elseif ( preg_match( '/(business|অর্থনীতি|বাণিজ্য|economy)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-business';
		} elseif ( preg_match( '/(sport|খেলা|khela)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-sports';
		} elseif ( preg_match( '/(entertainment|বিনোদন|binodon)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-entertainment';
		} elseif ( preg_match( '/(opinion|মতামত|সম্পাদকীয়|editorial)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-opinion';
		} elseif ( preg_match( '/(tech|প্রযুক্তি|বিজ্ঞান)/i', $cat_slug ) ) {
			$cat_class = 'badge-cat-tech';
		}

		$badge_html = sprintf(
			'<a href="%1$s" class="news-category-badge %2$s">%3$s</a>',
			esc_url( get_category_link( $primary_cat->term_id ) ),
			esc_attr( $cat_class ),
			esc_html( $primary_cat->name )
		);

		if ( $echo ) {
			echo $badge_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		return $badge_html;
	}
endif;

if ( ! function_exists( 'hasibshah_news_time_ago' ) ) :
	/**
	 * Returns human-readable relative time converted to Bengali numerals.
	 *
	 * Example: "১৫ মিনিট আগে", "২ ঘণ্টা আগে"
	 *
	 * @param int|null $post_id Optional. Post ID. Defaults to current loop post.
	 * @return string
	 */
	function hasibshah_news_time_ago( $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$post_time = get_the_time( 'U', $post_id );
		$now       = current_time( 'timestamp' ); // phpcs:ignore WordPress.DateTime.CurrentTimeTimestamp.Requested

		$diff = (int) abs( $now - $post_time );

		if ( $diff < HOUR_IN_SECONDS ) {
			$mins  = max( 1, round( $diff / MINUTE_IN_SECONDS ) );
			$count = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $mins ) : $mins;
			return sprintf(
				/* translators: %s: number of minutes */
				esc_html__( '%s মিনিট আগে', 'hasibshah-news' ),
				$count
			);
		} elseif ( $diff < DAY_IN_SECONDS ) {
			$hours = round( $diff / HOUR_IN_SECONDS );
			$count = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $hours ) : $hours;
			return sprintf(
				/* translators: %s: number of hours */
				esc_html__( '%s ঘণ্টা আগে', 'hasibshah-news' ),
				$count
			);
		} elseif ( $diff < 7 * DAY_IN_SECONDS ) {
			$days  = round( $diff / DAY_IN_SECONDS );
			$count = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $days ) : $days;
			return sprintf(
				/* translators: %s: number of days */
				esc_html__( '%s দিন আগে', 'hasibshah-news' ),
				$count
			);
		}

		// Fallback to formatted date if older than 7 days
		return get_the_date( '', $post_id );
	}
endif;

if ( ! function_exists( 'hasibshah_news_reading_time' ) ) :
	/**
	 * Calculates and returns estimated reading time in Bengali numerals.
	 *
	 * @param int|null $post_id Optional. Post ID. Defaults to current loop post.
	 * @return string
	 */
	function hasibshah_news_reading_time( $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$content    = get_post_field( 'post_content', $post_id );
		$word_count = str_word_count( wp_strip_all_tags( $content ) );
		$minutes    = max( 1, (int) ceil( $word_count / 160 ) );
		$bn_minutes = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $minutes ) : $minutes;

		return sprintf(
			/* translators: %s: estimated reading time in minutes */
			esc_html__( '%s মিনিট পড়ার সময়', 'hasibshah-news' ),
			$bn_minutes
		);
	}
endif;

if ( ! function_exists( 'hasibshah_news_post_thumbnail' ) ) :
	/**
	 * Displays responsive post thumbnail with fallback editorial SVG placeholder.
	 *
	 * Guarantees zero layout shifts (CLS) by rendering an SVG placeholder when
	 * no featured image is attached to the post.
	 *
	 * @param string   $size    Image size name. Default 'hasibshah-news-card'.
	 * @param int|null $post_id Optional. Post ID. Defaults to current loop post.
	 * @param string   $classes Additional CSS classes.
	 */
	function hasibshah_news_post_thumbnail( $size = 'hasibshah-news-card', $post_id = null, $classes = '' ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		if ( has_post_thumbnail( $post_id ) ) {
			the_post_thumbnail(
				$size,
				array(
					'class'   => esc_attr( 'news-card-img ' . $classes ),
					'loading' => 'lazy',
				)
			);
		} else {
			// Subtle editorial placeholder SVG matching aspect ratio
			$is_lead  = ( 'hasibshah-news-lead' === $size );
			$aspect   = $is_lead ? 'aspect-16-9' : ( 'hasibshah-news-thumb' === $size ? 'aspect-1-1' : 'aspect-3-2' );
			?>
			<div class="news-thumbnail-placeholder <?php echo esc_attr( $aspect . ' ' . $classes ); ?>" aria-hidden="true">
				<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="placeholder-icon">
					<path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"></path>
					<path d="M18 14h-8"></path>
					<path d="M15 18h-5"></path>
					<path d="M10 6h8v4h-8V6Z"></path>
				</svg>
			</div>
			<?php
		}
	}
endif;

