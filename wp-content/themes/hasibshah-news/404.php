<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main error-404-main">
	<div class="site-container">
		<section class="error-404 not-found news-404-box">
			<div class="error-404-hero">
				<div class="error-code-badge" aria-hidden="true">
					<span class="code-digit">৪</span>
					<span class="code-digit code-accent">০</span>
					<span class="code-digit">৪</span>
				</div>

				<header class="page-header error-404-header">
					<h1 class="page-title error-404-title">
						<?php esc_html_e( 'পৃষ্ঠাটি খুঁজে পাওয়া যায়নি', 'hasibshah-news' ); ?>
					</h1>
					<p class="error-404-subtitle">
						<?php esc_html_e( 'Page Not Found', 'hasibshah-news' ); ?>
					</p>
				</header><!-- .page-header -->

				<div class="page-content error-404-content">
					<p class="error-404-description">
						<?php esc_html_e( 'আপনি যে সংবাদ বা পাতাটি খুঁজছেন তা হয়তো সরানো হয়েছে, নাম পরিবর্তন করা হয়েছে অথবা সাময়িকভাবে অনুপলব্ধ রয়েছে। নিচের অনুসন্ধান বাক্স ব্যবহার করে কাঙ্ক্ষিত সংবাদটি খুঁজে দেখতে পারেন:', 'hasibshah-news' ); ?>
					</p>

					<div class="error-404-search-wrap">
						<?php get_search_form(); ?>
					</div>

					<div class="error-404-actions">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-return-home">
							<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
								<polyline points="9 22 9 12 15 12 15 22"></polyline>
							</svg>
							<?php esc_html_e( 'প্রচ্ছদে ফিরে যান / Return to Homepage', 'hasibshah-news' ); ?>
						</a>
					</div>

					<?php
					$hasibshah_news_top_cats = get_categories(
						array(
							'number'     => 6,
							'orderby'    => 'count',
							'order'      => 'DESC',
							'hide_empty' => true,
						)
					);
					if ( ! empty( $hasibshah_news_top_cats ) ) :
						?>
						<div class="error-404-categories">
							<h2 class="quick-nav-title"><?php esc_html_e( 'জনপ্রিয় বিভাগসমূহ:', 'hasibshah-news' ); ?></h2>
							<div class="quick-nav-chips">
								<?php foreach ( $hasibshah_news_top_cats as $hasibshah_news_cat ) : ?>
									<a href="<?php echo esc_url( get_category_link( $hasibshah_news_cat->term_id ) ); ?>" class="quick-chip">
										<?php echo esc_html( $hasibshah_news_cat->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div><!-- .page-content -->
			</div><!-- .error-404-hero -->

			<?php
			// 4 Latest Top Stories fallback
			$hasibshah_news_latest = new WP_Query(
				array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      => 4,
					'ignore_sticky_posts' => 1,
					'no_found_rows'       => true,
				)
			);

			if ( $hasibshah_news_latest->have_posts() ) :
				?>
				<div class="error-404-top-stories">
					<div class="top-stories-header">
						<h2 class="top-stories-title">
							<span class="stories-accent" aria-hidden="true"></span>
							<?php esc_html_e( 'সর্বশেষ শীর্ষ সংবাদসমূহ / Latest Top Stories', 'hasibshah-news' ); ?>
						</h2>
					</div>

					<div class="news-grid-12 top-stories-grid">
						<?php
						while ( $hasibshah_news_latest->have_posts() ) :
							$hasibshah_news_latest->the_post();
							?>
							<article class="grid-card col-span-3">
								<div class="grid-card-media">
									<a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
										<?php
										if ( function_exists( 'hasibshah_news_post_thumbnail' ) ) {
											hasibshah_news_post_thumbnail( 'hasibshah-news-card', get_the_ID(), 'top-story-img' );
										}
										?>
									</a>
									<?php if ( function_exists( 'hasibshah_news_post_badge' ) ) : ?>
										<div class="grid-card-badge-wrap">
											<?php hasibshah_news_post_badge( get_the_ID() ); ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="grid-card-body">
									<h3 class="grid-card-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="grid-card-meta">
										<span class="meta-time">
											<?php
											if ( function_exists( 'hasibshah_news_time_ago' ) ) {
												echo esc_html( hasibshah_news_time_ago( get_the_ID() ) );
											} else {
												echo esc_html( get_the_date() );
											}
											?>
										</span>
									</div>
								</div>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div><!-- .error-404-top-stories -->
			<?php endif; ?>
		</section><!-- .error-404 -->
	</div><!-- .site-container -->
</main><!-- #primary -->

<?php
get_footer();

