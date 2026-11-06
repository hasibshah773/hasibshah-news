<?php
/**
 * The template for displaying all single posts
 *
 * Implements a broadsheet long-form editorial layout with:
 * - Single article content (headline, byline, content, multi-page links, author bio)
 * - Previous & Next editorial navigation
 * - Category-based related news grid
 * - Accessible threaded comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main single-post-main">
	<div class="site-container single-article-container">
		<div class="single-article-layout-grid">
			<div class="single-article-content-column">
				<?php
				while ( have_posts() ) :
					the_post();

					/**
					 * Hook: hasibshah_news_single_before_article.
					 */
					do_action( 'hasibshah_news_single_before_article' );

					// 1. Single article details and long-form body copy
					get_template_part( 'template-parts/content/content-single' );

					// 2. Previous & Next post navigation
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( '&larr; পূর্ববর্তী সংবাদ', 'hasibshah-news' ) . '</span> <span class="nav-title news-card-title-clamp-2">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'পরবর্তী সংবাদ &rarr;', 'hasibshah-news' ) . '</span> <span class="nav-title news-card-title-clamp-2">%title</span>',
						)
					);

					// 3. Category-based related stories
					get_template_part( 'template-parts/content/related-stories' );

					/**
					 * Hook: hasibshah_news_single_after_article.
					 */
					do_action( 'hasibshah_news_single_after_article' );

					// 4. Threaded comments section (Addresses Theme Check RECOMMENDED)
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- .single-article-content-column -->
		</div><!-- .single-article-layout-grid -->
	</div><!-- .site-container -->
</main><!-- #primary -->

<?php
get_footer();

