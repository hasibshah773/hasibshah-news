<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $wp_query;
$hasibshah_news_total_results = (int) $wp_query->found_posts;
$hasibshah_news_bn_count      = function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $hasibshah_news_total_results ) : $hasibshah_news_total_results;
?>

<main id="primary" class="site-main search-main">
	<div class="site-container">
		<header class="search-header">
			<div class="search-header-inner">
				<span class="search-eyebrow"><?php esc_html_e( 'অনুসন্ধানের ফলাফল', 'hasibshah-news' ); ?></span>

				<h1 class="search-title">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( '&ldquo;%s&rdquo; সম্পর্কিত ফলাফল', 'hasibshah-news' ),
						'<span class="search-query-highlight">' . esc_html( get_search_query() ) . '</span>'
					);
					?>
				</h1>

				<div class="search-count-badge">
					<?php
					printf(
						/* translators: %s: total count of results found */
						esc_html__( 'মোট %s টি সংবাদ পাওয়া গেছে', 'hasibshah-news' ),
						'<strong class="count-number">' . esc_html( $hasibshah_news_bn_count ) . '</strong>'
					);
					?>
				</div>

				<div class="search-header-refine">
					<?php get_search_form(); ?>
				</div>
			</div>
		</header><!-- .search-header -->

		<div class="layout-content-sidebar">
			<div class="editorial-main">
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

