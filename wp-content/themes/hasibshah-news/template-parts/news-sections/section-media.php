<?php
/**
 * Multimedia Hub Section Template Part: ভিডিও ও ছবি
 *
 * Displays dark-themed multimedia story cards with video play overlay,
 * photo gallery count badges, and rich dark paper background.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Query 4 posts for multimedia hub
$media_query = hasibshah_news_get_section_posts(
	array(
		'posts_per_page' => 4,
	),
	'multimedia_hub'
);
?>

<section class="editorial-section section-multimedia dark-theme-surface" id="section-media" aria-label="<?php esc_attr_e( 'Multimedia Video and Photo Gallery', 'hasibshah-news' ); ?>">
	<div class="site-container">
		<!-- Section Header with White / Inverse Typography on Dark Surface -->
		<div class="section-heading-bar heading-accent-media">
			<div class="heading-title-wrap">
				<span class="heading-accent-bar" aria-hidden="true"></span>
				<div class="media-header-icon" aria-hidden="true">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polygon points="23 7 16 12 23 17 23 7"></polygon>
						<rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
					</svg>
				</div>
				<h2 class="section-title text-inverse"><?php esc_html_e( 'ভিডিও ও ছবি', 'hasibshah-news' ); ?></h2>
				<span class="section-subtitle text-inverse-muted"><?php esc_html_e( 'মাল্টিমিডিয়া বিশেষ আয়োজন', 'hasibshah-news' ); ?></span>
			</div>
		</div><!-- .section-heading-bar -->

		<!-- 4-Column Multimedia Cards Grid -->
		<div class="media-cards-grid news-grid-12">
			<?php if ( $media_query->have_posts() ) : ?>
				<?php
				$index = 0;
				while ( $media_query->have_posts() ) :
					$media_query->the_post();
					$index++;
					$is_video = ( 0 === $index % 2 ); // Alternate video and photo badges for visual diversity
					?>
					<article id="media-post-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-media col-span-12 col-span-md-6 col-span-lg-3' ); ?>>
						<div class="card-media media-frame">
							<a href="<?php the_permalink(); ?>" class="card-thumb-link" tabindex="-1" aria-hidden="true">
								<?php hasibshah_news_post_thumbnail( 'hasibshah-news-card' ); ?>
							</a>

							<!-- Multimedia Overlay Badge -->
							<div class="media-overlay-badge">
								<?php if ( $is_video ) : ?>
									<span class="media-type-pill pill-video">
										<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
											<polygon points="5 3 19 12 5 21 5 3"></polygon>
										</svg>
										<span class="pill-text"><?php esc_html_e( 'ভিডিও', 'hasibshah-news' ); ?></span>
									</span>
								<?php else : ?>
									<span class="media-type-pill pill-photo">
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
											<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
											<circle cx="12" cy="13" r="4"></circle>
										</svg>
										<span class="pill-text"><?php esc_html_e( 'ছবি', 'hasibshah-news' ); ?></span>
									</span>
								<?php endif; ?>
							</div><!-- .media-overlay-badge -->
						</div><!-- .card-media -->

						<div class="card-body media-body">
							<h3 class="card-title news-card-title-clamp-2 text-inverse">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="card-meta">
								<span class="meta-time text-inverse-muted">
									<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
									<?php echo esc_html( hasibshah_news_time_ago() ); ?>
								</span>
							</div>
						</div><!-- .card-body -->
					</article><!-- #media-post-<?php the_ID(); ?> -->
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<div class="col-span-12">
					<div class="news-card card-placeholder">
						<p class="text-inverse-muted"><?php esc_html_e( 'মাল্টিমিডিয়া ভিডিও ও ছবির গ্যালারি শীঘ্রই যুক্ত হবে।', 'hasibshah-news' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .media-cards-grid -->
	</div><!-- .site-container -->
</section><!-- #section-media -->

