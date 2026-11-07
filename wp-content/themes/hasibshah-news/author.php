<?php
/**
 * The template for displaying journalist/author profile pages and their articles
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hasibshah_news_author = get_queried_object();
$hasibshah_news_author_id = $hasibshah_news_author instanceof WP_User ? $hasibshah_news_author->ID : 0;
$hasibshah_news_post_count = $hasibshah_news_author_id ? count_user_posts( $hasibshah_news_author_id, 'post', true ) : 0;
$hasibshah_news_bn_count = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $hasibshah_news_post_count ) : $hasibshah_news_post_count;
?>

<main id="primary" class="site-main author-main">
	<div class="site-container">
		<header class="author-profile-card">
			<div class="author-profile-grid">
				<div class="author-profile-media">
					<?php
					echo get_avatar(
						$hasibshah_news_author_id,
						96,
						'',
						esc_attr( $hasibshah_news_author instanceof WP_User ? $hasibshah_news_author->display_name : '' ),
						array( 'class' => 'author-profile-avatar' )
					);
					?>
				</div><!-- .author-profile-media -->

				<div class="author-profile-details">
					<div class="author-profile-eyebrow">
						<span class="eyebrow-badge"><?php esc_html_e( 'সাংবাদিক ও লেখক পরিচিতি', 'hasibshah-news' ); ?></span>
					</div>

					<h1 class="author-profile-name">
						<?php echo esc_html( $hasibshah_news_author instanceof WP_User ? $hasibshah_news_author->display_name : '' ); ?>
					</h1>

					<?php
					$hasibshah_news_designation = get_the_author_meta( 'designation', $hasibshah_news_author_id );
					if ( empty( $hasibshah_news_designation ) ) {
						$hasibshah_news_designation = __( 'সাংবাদিক ও প্রতিবেদক / Staff Reporter', 'hasibshah-news' );
					}
					?>
					<p class="author-profile-role"><?php echo esc_html( $hasibshah_news_designation ); ?></p>

					<?php
					$hasibshah_news_bio = get_the_author_meta( 'description', $hasibshah_news_author_id );
					if ( ! empty( $hasibshah_news_bio ) ) :
						?>
						<div class="author-profile-bio">
							<p><?php echo esc_html( $hasibshah_news_bio ); ?></p>
						</div>
					<?php endif; ?>

					<div class="author-profile-meta">
						<span class="author-meta-count">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Z"></path>
							</svg>
							<?php
							printf(
								/* translators: %s: number of published posts */
								esc_html__( 'মোট সংবাদ: %s টি', 'hasibshah-news' ),
								esc_html( $hasibshah_news_bn_count )
							);
							?>
						</span>

						<?php
						$hasibshah_news_website = get_the_author_meta( 'user_url', $hasibshah_news_author_id );
						if ( ! empty( $hasibshah_news_website ) ) :
							?>
							<span class="author-meta-website">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<circle cx="12" cy="12" r="10"></circle>
									<line x1="2" y1="12" x2="22" y2="12"></line>
									<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
								</svg>
								<a href="<?php echo esc_url( $hasibshah_news_website ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo esc_html( wp_parse_url( $hasibshah_news_website, PHP_URL_HOST ) ); ?>
								</a>
							</span>
						<?php endif; ?>
					</div><!-- .author-profile-meta -->
				</div><!-- .author-profile-details -->
			</div><!-- .author-profile-grid -->
		</header><!-- .author-profile-card -->

		<div class="layout-content-sidebar">
			<div class="editorial-main">
				<div class="author-feed-header">
					<h2 class="author-feed-title">
						<?php
						printf(
							/* translators: %s: author name */
							esc_html__( '%s-এর প্রকাশিত সংবাদ ও প্রতিবেদন', 'hasibshah-news' ),
							esc_html( $hasibshah_news_author instanceof WP_User ? $hasibshah_news_author->display_name : '' )
						);
						?>
					</h2>
				</div>

				<?php
				if ( have_posts() ) :
					echo '<div class="news-archive-feed">';

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', get_post_format() );
					endwhile;

					echo '</div><!-- .news-archive-feed -->';

					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => sprintf(
								'<span class="pagination-arrow" aria-hidden="true">&larr;</span> <span class="pagination-text">%s</span>',
								esc_html__( 'পূর্ববর্তী', 'hasibshah-news' )
							),
							'next_text'          => sprintf(
								'<span class="pagination-text">%s</span> <span class="pagination-arrow" aria-hidden="true">&rarr;</span>',
								esc_html__( 'পরবর্তী', 'hasibshah-news' )
							),
							'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'পৃষ্ঠা', 'hasibshah-news' ) . ' </span>',
						)
					);

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif;
				?>
			</div><!-- .editorial-main -->

			<?php get_sidebar(); ?>
		</div><!-- .layout-content-sidebar -->
	</div><!-- .site-container -->
</main><!-- #primary -->

<?php
get_footer();

