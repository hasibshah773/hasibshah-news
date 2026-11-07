<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
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

<main id="primary" class="site-main index-main">
	<div class="site-container">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="page-header index-page-header">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

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
