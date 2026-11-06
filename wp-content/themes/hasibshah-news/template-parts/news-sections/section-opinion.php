<?php
/**
 * Opinion & Editorial Section Template Part: মতামত ও সম্পাদকীয়
 *
 * Implements an authoritative broadsheet opinion section featuring:
 * - Circular author / columnist portraits (64x64px)
 * - Columnist byline and designation
 * - Thought-provoking editorial headlines
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Query 4 posts for opinion & editorial
$opinion_args = array(
	'posts_per_page' => 4,
);

$opinion_cat = get_category_by_slug( 'opinion' );
if ( $opinion_cat ) {
	$opinion_args['cat'] = $opinion_cat->term_id;
}

$opinion_query = hasibshah_news_get_section_posts( $opinion_args, 'opinion_section' );
?>

<section class="editorial-section section-opinion newspaper-double-border" id="section-opinion" aria-label="<?php esc_attr_e( 'Opinion and Editorial Columns', 'hasibshah-news' ); ?>">
	<div class="site-container">
		<!-- Section Header with Editorial Slate Accent -->
		<div class="section-heading-bar heading-accent-opinion">
			<div class="heading-title-wrap">
				<span class="heading-accent-bar" aria-hidden="true"></span>
				<div class="opinion-header-icon" aria-hidden="true">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 20h9"></path>
						<path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
					</svg>
				</div>
				<h2 class="section-title"><?php esc_html_e( 'মতামত ও সম্পাদকীয়', 'hasibshah-news' ); ?></h2>
				<span class="section-subtitle"><?php esc_html_e( 'মুক্তচিন্তা ও বিশ্লেষণধর্মী কলাম', 'hasibshah-news' ); ?></span>
			</div>
			<div class="heading-more-link">
				<?php if ( $opinion_cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $opinion_cat->term_id ) ); ?>" class="category-view-all">
						<?php esc_html_e( 'সব কলাম', 'hasibshah-news' ); ?> &rarr;
					</a>
				<?php endif; ?>
			</div>
		</div><!-- .section-heading-bar -->

		<!-- 4-Column Opinion Cards Grid -->
		<div class="opinion-cards-grid news-grid-12">
			<?php if ( $opinion_query->have_posts() ) : ?>
				<?php
				while ( $opinion_query->have_posts() ) :
					$opinion_query->the_post();
					$author_id = get_the_author_meta( 'ID' );
					?>
					<article id="opinion-post-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-opinion col-span-12 col-span-md-6 col-span-lg-3' ); ?>>
						<div class="opinion-card-header">
							<div class="author-avatar-wrap">
								<?php
								echo get_avatar(
									$author_id,
									64,
									'',
									get_the_author(),
									array( 'class' => 'opinion-author-avatar' )
								);
								?>
							</div>
							<div class="author-info">
								<h4 class="author-name">
									<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
										<?php echo esc_html( get_the_author() ); ?>
									</a>
								</h4>
								<span class="author-designation"><?php esc_html_e( 'কলামিস্ট ও লেখক', 'hasibshah-news' ); ?></span>
							</div>
						</div><!-- .opinion-card-header -->

						<div class="opinion-card-body">
							<div class="opinion-quote-mark" aria-hidden="true">&ldquo;</div>
							<h3 class="opinion-title news-card-title-clamp-3">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div><!-- .opinion-card-body -->

						<div class="opinion-card-footer">
							<span class="meta-time">
								<?php echo esc_html( hasibshah_news_time_ago() ); ?>
							</span>
							<span class="meta-separator" aria-hidden="true">&bull;</span>
							<span class="meta-reading-time">
								<?php echo esc_html( hasibshah_news_reading_time() ); ?>
							</span>
						</div>
					</article><!-- #opinion-post-<?php the_ID(); ?> -->
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<div class="col-span-12">
					<div class="news-card card-placeholder">
						<p><?php esc_html_e( 'সম্পাদকীয় ও কলাম শীঘ্রই প্রকাশিত হবে।', 'hasibshah-news' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .opinion-cards-grid -->
	</div><!-- .site-container -->
</section><!-- #section-opinion -->

