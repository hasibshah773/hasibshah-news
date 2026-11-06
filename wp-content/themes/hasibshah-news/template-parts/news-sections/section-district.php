<?php
/**
 * District / Regional News Section Template Part: সারাদেশ
 *
 * Displays a 4-column regional news grid with Bangladeshi administrative
 * division chips and National Green accent headers.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Query 4 posts for regional / nationwide section
$district_query = hasibshah_news_get_section_posts(
	array(
		'posts_per_page' => 4,
	),
	'district_news'
);

$divisions = array(
	'ঢাকা'       => 'dhaka',
	'চট্টগ্রাম'   => 'chittagong',
	'রাজশাহী'    => 'rajshahi',
	'খুলনা'      => 'khulna',
	'বরিশাল'     => 'barishal',
	'সিলেট'      => 'sylhet',
	'রংপুর'      => 'rangpur',
	'ময়মনসিংহ'   => 'mymensingh',
);
?>

<section class="editorial-section section-district" id="section-district" aria-label="<?php esc_attr_e( 'District News Section', 'hasibshah-news' ); ?>">
	<div class="site-container">
		<!-- Section Header with National Green Accent -->
		<div class="section-heading-bar heading-accent-bangladesh">
			<div class="heading-title-wrap">
				<span class="heading-accent-bar" aria-hidden="true"></span>
				<h2 class="section-title"><?php esc_html_e( 'সারাদেশ', 'hasibshah-news' ); ?></h2>
				<span class="section-subtitle"><?php esc_html_e( 'বিভাগীয় ও জেলা সংবাদ', 'hasibshah-news' ); ?></span>
			</div>

			<!-- Division Chips / Filter Pills -->
			<div class="district-chips-wrapper" role="navigation" aria-label="<?php esc_attr_e( 'Division filters', 'hasibshah-news' ); ?>">
				<ul class="district-chips-list">
					<?php foreach ( $divisions as $name => $slug ) : ?>
						<li class="district-chip-item">
							<a href="<?php echo esc_url( get_category_link( get_category_by_slug( $slug ) ) ?: home_url( '/?s=' . rawurlencode( $name ) ) ); ?>" class="district-chip-link">
								<?php echo esc_html( $name ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div><!-- .section-heading-bar -->

		<!-- 4-Column News Grid -->
		<div class="district-news-grid news-grid-12">
			<?php if ( $district_query->have_posts() ) : ?>
				<?php
				while ( $district_query->have_posts() ) :
					$district_query->the_post();
					?>
					<article id="district-post-<?php the_ID(); ?>" <?php post_class( 'news-card news-card-grid col-span-12 col-span-md-6 col-span-lg-3' ); ?>>
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
					</article><!-- #district-post-<?php the_ID(); ?> -->
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<div class="col-span-12">
					<div class="news-card card-placeholder">
						<p><?php esc_html_e( 'জেলা সংবাদের তথ্য সংগ্রহ করা হচ্ছে...', 'hasibshah-news' ); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div><!-- .district-news-grid -->
	</div><!-- .site-container -->
</section><!-- #section-district -->

