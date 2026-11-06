<?php
/**
 * Hero Section Template Part: The Broadsheet Cover
 *
 * Implements a 3-column broadsheet layout:
 * - Left (3 cols): Secondary Feature Stories Stack
 * - Center (6 cols): Primary Lead Story with large image and excerpt
 * - Right (3 cols): Latest Headlines Feed ("সর্বশেষ")
 *
 * Includes focused in-memory post deduplication strictly within the Hero.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// In-memory deduplication tracker strictly for the Hero Section
$hero_excluded_ids = array();

// 1. Query for Primary Lead Story (1 post)
$lead_query = hasibshah_news_get_section_posts(
	array(
		'posts_per_page' => 1,
	),
	'hero_lead'
);

$has_lead = $lead_query->have_posts();
if ( $has_lead ) {
	$hero_lead_id        = $lead_query->posts[0]->ID;
	$hero_excluded_ids[] = $hero_lead_id;
}

// 2. Query for Secondary Feature Stories (2 posts, excluding lead)
$secondary_query = hasibshah_news_get_section_posts(
	array(
		'posts_per_page' => 2,
		'post__not_in'   => $hero_excluded_ids,
	),
	'hero_secondary'
);

if ( $secondary_query->have_posts() ) {
	foreach ( $secondary_query->posts as $sec_post ) {
		$hero_excluded_ids[] = $sec_post->ID;
	}
}

// 3. Query for Latest Headlines Feed (5 posts, excluding lead & secondary)
$latest_query = hasibshah_news_get_section_posts(
	array(
		'posts_per_page' => 5,
		'post__not_in'   => $hero_excluded_ids,
	),
	'hero_latest'
);
?>

<section class="editorial-section section-hero" id="section-hero" aria-label="<?php esc_attr_e( 'Hero Lead Stories', 'hasibshah-news' ); ?>">
	<div class="site-container">
		<div class="hero-cover-grid news-grid-12">

			<!-- LEFT COLUMN: Secondary Feature Stories (3 Cols) -->
			<div class="hero-col hero-secondary-col col-span-12 col-span-lg-3">
				<div class="secondary-stories-stack">
					<?php if ( $secondary_query->have_posts() ) : ?>
						<?php
						while ( $secondary_query->have_posts() ) :
							$secondary_query->the_post();
							?>
							<article id="hero-secondary-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-secondary' ); ?>>
								<div class="card-media">
									<a href="<?php the_permalink(); ?>" class="card-thumb-link" tabindex="-1" aria-hidden="true">
										<?php hasibshah_news_post_thumbnail( 'hasibshah-news-card' ); ?>
									</a>
									<div class="card-badge-wrap">
										<?php hasibshah_news_post_badge(); ?>
									</div>
								</div><!-- .card-media -->

								<div class="card-body">
									<h3 class="card-title news-card-title-clamp-2">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="card-meta">
										<span class="meta-time">
											<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
											<?php echo esc_html( hasibshah_news_time_ago() ); ?>
										</span>
									</div>
								</div><!-- .card-body -->
							</article><!-- #hero-secondary-<?php the_ID(); ?> -->
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					<?php else : ?>
						<!-- Clean editorial fallback card if few posts exist -->
						<div class="news-card news-card-secondary card-placeholder">
							<div class="card-body">
								<span class="news-category-badge badge-cat-default"><?php esc_html_e( 'বিশেষ প্রতিবেদন', 'hasibshah-news' ); ?></span>
								<h3 class="card-title"><?php esc_html_e( 'দেশ ও বিদেশের গুরুত্বপূর্ণ সংবাদের জন্য চোখ রাখুন।', 'hasibshah-news' ); ?></h3>
							</div>
						</div>
					<?php endif; ?>
				</div><!-- .secondary-stories-stack -->
			</div><!-- .hero-secondary-col -->

			<!-- CENTER COLUMN: Primary Lead Story (6 Cols) -->
			<div class="hero-col hero-lead-col col-span-12 col-span-lg-6">
				<?php if ( $has_lead ) : ?>
					<?php
					$lead_query->the_post();
					?>
					<article id="hero-lead-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-lead' ); ?>>
						<div class="card-media lead-media">
							<a href="<?php the_permalink(); ?>" class="card-thumb-link" tabindex="-1" aria-hidden="true">
								<?php hasibshah_news_post_thumbnail( 'hasibshah-news-lead' ); ?>
							</a>
							<div class="card-badge-wrap">
								<?php hasibshah_news_post_badge(); ?>
							</div>
						</div><!-- .card-media -->

						<div class="card-body lead-body">
							<h2 class="lead-headline">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="lead-excerpt">
								<?php the_excerpt(); ?>
							</div>

							<div class="card-meta lead-meta">
								<span class="meta-author">
									<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
									<?php echo esc_html( get_the_author() ); ?>
								</span>
								<span class="meta-separator" aria-hidden="true">&bull;</span>
								<span class="meta-time">
									<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
									<?php echo esc_html( hasibshah_news_time_ago() ); ?>
								</span>
								<span class="meta-separator" aria-hidden="true">&bull;</span>
								<span class="meta-reading-time">
									<?php echo esc_html( hasibshah_news_reading_time() ); ?>
								</span>
							</div><!-- .lead-meta -->
						</div><!-- .card-body -->
					</article><!-- #hero-lead-<?php the_ID(); ?> -->
					<?php
					wp_reset_postdata();
					?>
				<?php else : ?>
					<div class="news-card news-card-lead lead-empty">
						<div class="card-body lead-body">
							<h2 class="lead-headline"><?php esc_html_e( 'শীর্ষ সংবাদ শীঘ্রই প্রকাশিত হবে', 'hasibshah-news' ); ?></h2>
							<p class="lead-excerpt"><?php esc_html_e( 'হাসিবশাহ নিউজে স্বাগতম। সর্বশেষ এবং বস্তুনিষ্ঠ সংবাদের জন্য আমাদের সাথেই থাকুন।', 'hasibshah-news' ); ?></p>
						</div>
					</div>
				<?php endif; ?>
			</div><!-- .hero-lead-col -->

			<!-- RIGHT COLUMN: Latest Headlines Feed (3 Cols) -->
			<div class="hero-col hero-latest-col col-span-12 col-span-lg-3">
				<div class="latest-headlines-feed">
					<div class="feed-header">
						<span class="feed-pulse-dot" aria-hidden="true"></span>
						<h3 class="feed-title"><?php esc_html_e( 'সর্বশেষ সংবাদ', 'hasibshah-news' ); ?></h3>
					</div><!-- .feed-header -->

					<ul class="latest-feed-list">
						<?php if ( $latest_query->have_posts() ) : ?>
							<?php
							while ( $latest_query->have_posts() ) :
								$latest_query->the_post();
								?>
								<li class="latest-feed-item">
									<div class="feed-item-time">
										<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
										<?php echo esc_html( hasibshah_news_time_ago() ); ?>
									</div>
									<h4 class="feed-item-title news-card-title-clamp-2">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h4>
								</li>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						<?php else : ?>
							<li class="latest-feed-item feed-empty-item">
								<h4 class="feed-item-title"><?php esc_html_e( 'আরও খবর প্রকাশের অপেক্ষায়...', 'hasibshah-news' ); ?></h4>
							</li>
						<?php endif; ?>
					</ul><!-- .latest-feed-list -->

					<div class="feed-footer">
						<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>" class="feed-more-link">
							<?php esc_html_e( 'সব খবর পড়ুন', 'hasibshah-news' ); ?> &rarr;
						</a>
					</div>
				</div><!-- .latest-headlines-feed -->
			</div><!-- .hero-latest-col -->

		</div><!-- .hero-cover-grid -->
	</div><!-- .site-container -->
</section><!-- #section-hero -->
