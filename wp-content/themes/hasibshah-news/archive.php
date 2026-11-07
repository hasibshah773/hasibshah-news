<?php
/**
 * The template for displaying archive pages
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
?>

<main id="primary" class="site-main archive-main">
	<div class="site-container">
		<header class="archive-header">
			<div class="archive-header-inner">
				<span class="archive-eyebrow"><?php esc_html_e( 'সংবাদ আর্কাইভ', 'hasibshah-news' ); ?></span>
				<?php
				the_archive_title( '<h1 class="archive-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div>
		</header><!-- .archive-header -->

		<div class="layout-content-sidebar">
			<div class="editorial-main">
				<?php
				if ( have_posts() ) :
					echo '<div class="news-archive-feed">';

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
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

