<?php
/**
 * Breaking News Ticker template part for HasibShah News
 *
 * Displays an urgent breaking news ticker strip with
 * pause-on-hover accessibility and query optimization.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Query parameters for breaking news strip
$ticker_query_args = apply_filters(
	'hasibshah_news_breaking_ticker_args',
	array(
		'posts_per_page'      => 5,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => true, // Performance optimization: no pagination needed
	)
);

$ticker_posts = new WP_Query( $ticker_query_args );
?>
<div class="news-breaking-ticker" id="news-breaking-ticker" role="region" aria-label="<?php esc_attr_e( 'Breaking News Ticker', 'hasibshah-news' ); ?>">
	<div class="site-container news-ticker-container">
		<div class="ticker-badge">
			<span class="ticker-pulse-dot" aria-hidden="true"></span>
			<span class="ticker-label-text"><?php esc_html_e( 'ব্রেকিং নিউজ', 'hasibshah-news' ); ?></span>
		</div><!-- .ticker-badge -->

		<div class="ticker-content-viewport" aria-live="polite">
			<?php if ( $ticker_posts->have_posts() ) : ?>
				<ul class="ticker-track" id="ticker-track">
					<?php
					while ( $ticker_posts->have_posts() ) :
						$ticker_posts->the_post();
						?>
						<li class="ticker-item">
							<a href="<?php the_permalink(); ?>" class="ticker-link">
								<span class="ticker-bullet" aria-hidden="true">&bull;</span>
								<span class="ticker-title"><?php the_title(); ?></span>
							</a>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</ul>
			<?php else : ?>
				<div class="ticker-empty-placeholder">
					<span class="ticker-title"><?php esc_html_e( 'হাসিবশাহ নিউজে স্বাগতম — বস্তুনিষ্ঠ ও সত্যনিষ্ঠ সংবাদ পরিবেশনে আমরা অঙ্গীকারবদ্ধ।', 'hasibshah-news' ); ?></span>
				</div>
			<?php endif; ?>
		</div><!-- .ticker-content-viewport -->

		<div class="ticker-controls">
			<button id="ticker-pause-toggle" class="ticker-pause-toggle" aria-label="<?php esc_attr_e( 'Pause Breaking News', 'hasibshah-news' ); ?>" title="<?php esc_attr_e( 'Pause / Play', 'hasibshah-news' ); ?>">
				<svg class="icon-pause" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<rect x="6" y="4" width="4" height="16"></rect>
					<rect x="14" y="4" width="4" height="16"></rect>
				</svg>
				<svg class="icon-play" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="display:none;">
					<polygon points="5 3 19 12 5 21 5 3"></polygon>
				</svg>
			</button>
		</div><!-- .ticker-controls -->
	</div><!-- .site-container -->
</div><!-- .news-breaking-ticker -->

