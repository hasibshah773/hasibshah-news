<?php
/**
 * Category News Grid Section Template Part: রাজনীতি, অর্থনীতি ও খেলাধুলা
 *
 * Implements a 3-column broadsheet category block layout:
 * - Politics (রাজনীতি) with Deep Maroon accent
 * - Business (অর্থনীতি) with Sapphire Blue accent
 * - Sports (খেলাধুলা) with Vibrant Amber accent
 *
 * Each block presents 1 Primary featured card + compact headline list.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Category block configurations with slug matching and design tokens
$category_blocks = array(
	array(
		'id'          => 'politics',
		'title'       => esc_html__( 'রাজনীতি', 'hasibshah-news' ),
		'slug'        => 'politics',
		'accent_cls'  => 'heading-accent-politics',
		'badge_cls'   => 'badge-cat-politics',
	),
	array(
		'id'          => 'business',
		'title'       => esc_html__( 'অর্থনীতি ও বাণিজ্য', 'hasibshah-news' ),
		'slug'        => 'business',
		'accent_cls'  => 'heading-accent-business',
		'badge_cls'   => 'badge-cat-business',
	),
	array(
		'id'          => 'sports',
		'title'       => esc_html__( 'খেলাধুলা', 'hasibshah-news' ),
		'slug'        => 'sports',
		'accent_cls'  => 'heading-accent-sports',
		'badge_cls'   => 'badge-cat-sports',
	),
);
?>

<section class="editorial-section section-category-grid" id="section-category-grid" aria-label="<?php esc_attr_e( 'Category News Blocks', 'hasibshah-news' ); ?>">
	<div class="site-container">
		<div class="category-columns-wrapper news-grid-12">
			<?php foreach ( $category_blocks as $block ) : ?>
				<?php
				// Query posts for this specific category, or fallback to general posts
				$query_args = array(
					'posts_per_page' => 4,
				);

				$cat_obj = get_category_by_slug( $block['slug'] );
				if ( $cat_obj ) {
					$query_args['cat'] = $cat_obj->term_id;
				}

				$block_query = hasibshah_news_get_section_posts( $query_args, 'category_' . $block['id'] );
				?>
				<div class="category-block-col col-span-12 col-span-lg-4">
					<!-- Category Block Header -->
					<div class="section-heading-bar <?php echo esc_attr( $block['accent_cls'] ); ?>">
						<div class="heading-title-wrap">
							<span class="heading-accent-bar" aria-hidden="true"></span>
							<h3 class="section-title"><?php echo esc_html( $block['title'] ); ?></h3>
						</div>
						<div class="heading-more-link">
							<?php if ( $cat_obj ) : ?>
								<a href="<?php echo esc_url( get_category_link( $cat_obj->term_id ) ); ?>" class="category-view-all">
									<?php esc_html_e( 'আরও', 'hasibshah-news' ); ?> &rarr;
								</a>
							<?php endif; ?>
						</div>
					</div><!-- .section-heading-bar -->

					<div class="category-block-content">
						<?php if ( $block_query->have_posts() ) : ?>
							<?php
							$item_count = 0;
							while ( $block_query->have_posts() ) :
								$block_query->the_post();
								$item_count++;

								if ( 1 === $item_count ) :
									// 1. Featured Primary Card
									?>
									<article id="cat-lead-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-cat-lead' ); ?>>
										<div class="card-media">
											<a href="<?php the_permalink(); ?>" class="card-thumb-link" tabindex="-1" aria-hidden="true">
												<?php hasibshah_news_post_thumbnail( 'hasibshah-news-card' ); ?>
											</a>
											<div class="card-badge-wrap">
												<span class="news-category-badge <?php echo esc_attr( $block['badge_cls'] ); ?>">
													<?php echo esc_html( $block['title'] ); ?>
												</span>
											</div>
										</div>
										<div class="card-body">
											<h4 class="card-title news-card-title-clamp-2">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h4>
											<div class="card-meta">
												<span class="meta-time">
													<?php echo esc_html( hasibshah_news_time_ago() ); ?>
												</span>
											</div>
										</div>
									</article>
									<ul class="cat-compact-list">
								<?php else : ?>
									<!-- 2. Compact Headline Items -->
									<li class="cat-compact-item">
										<a href="<?php the_permalink(); ?>" class="compact-thumb-link" tabindex="-1" aria-hidden="true">
											<?php hasibshah_news_post_thumbnail( 'hasibshah-news-thumb', null, 'compact-thumb-img' ); ?>
										</a>
										<div class="compact-body">
											<h5 class="compact-title news-card-title-clamp-2">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
											<span class="compact-time"><?php echo esc_html( hasibshah_news_time_ago() ); ?></span>
										</div>
									</li>
								<?php
								endif;
							endwhile;
							wp_reset_postdata();

							if ( $item_count > 1 ) {
								echo '</ul>';
							}
							?>
						<?php else : ?>
							<div class="news-card card-placeholder">
								<p><?php esc_html_e( 'এই বিভাগের নতুন সংবাদ শীঘ্রই প্রকাশিত হবে।', 'hasibshah-news' ); ?></p>
							</div>
						<?php endif; ?>
					</div><!-- .category-block-content -->
				</div><!-- .category-block-col -->
			<?php endforeach; ?>
		</div><!-- .category-columns-wrapper -->
	</div><!-- .site-container -->
</section><!-- #section-category-grid -->

