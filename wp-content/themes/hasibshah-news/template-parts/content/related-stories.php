<?php
/**
 * Related Stories Template Part
 *
 * Queries and displays related articles based on the primary category of the current post.
 * Includes 'no_found_rows' => true for performance optimization.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_post_id = get_the_ID();
$categories      = get_the_category( $current_post_id );

if ( empty( $categories ) ) {
	return;
}

$cat_ids = wp_list_pluck( $categories, 'term_id' );

$related_count = apply_filters( 'hasibshah_news_related_posts_count', 3 );

$related_args = array(
	'category__in'        => $cat_ids,
	'post__not_in'        => array( $current_post_id ),
	'posts_per_page'      => $related_count,
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => true,
);

$related_query = new WP_Query( $related_args );

// If no posts found in the exact category, fallback to latest news
if ( ! $related_query->have_posts() ) {
	$fallback_args = array(
		'post__not_in'        => array( $current_post_id ),
		'posts_per_page'      => $related_count,
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => true,
	);
	$related_query = new WP_Query( $fallback_args );
}

if ( ! $related_query->have_posts() ) {
	return;
}
?>

<section class="related-stories-section" aria-label="<?php esc_attr_e( 'Related Articles', 'hasibshah-news' ); ?>">
	<div class="section-heading-bar heading-accent-bangladesh">
		<div class="heading-title-wrap">
			<span class="heading-accent-bar" aria-hidden="true"></span>
			<h2 class="section-title"><?php esc_html_e( 'সম্পর্কিত সংবাদ', 'hasibshah-news' ); ?></h2>
		</div>
	</div>

	<div class="related-stories-grid news-grid-12">
		<?php
		while ( $related_query->have_posts() ) :
			$related_query->the_post();
			?>
			<article id="related-post-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-grid col-span-12 col-span-md-4' ); ?>>
				<div class="card-media">
					<a href="<?php the_permalink(); ?>" class="card-thumb-link" tabindex="-1" aria-hidden="true">
						<?php hasibshah_news_post_thumbnail( 'hasibshah-news-card' ); ?>
					</a>
					<div class="card-badge-wrap">
						<?php hasibshah_news_post_badge(); ?>
					</div>
				</div>

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
				</div>
			</article>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div><!-- .related-stories-grid -->
</section><!-- .related-stories-section -->
