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

<main id="primary" class="site-main">
	<div class="site-container">
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card-scaffold' ); ?>>
					<header class="entry-header">
						<?php
						if ( has_post_thumbnail() ) :
							?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'hasibshah-news-card' ); ?>
								</a>
							</div>
							<?php
						endif;

						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
						?>

						<div class="entry-meta">
							<?php
							hasibshah_news_posted_on();
							hasibshah_news_posted_by();
							?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php
			endwhile;

			the_posts_pagination(
				array(
					'prev_text'          => sprintf( '<span class="nav-prev-text">%s</span>', esc_html__( '&larr; Previous', 'hasibshah-news' ) ),
					'next_text'          => sprintf( '<span class="nav-next-text">%s</span>', esc_html__( 'Next &rarr;', 'hasibshah-news' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'hasibshah-news' ) . ' </span>',
				)
			);

		else :
			?>
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'hasibshah-news' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'hasibshah-news' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .no-results -->
			<?php
		endif;
		?>
	</div><!-- .site-container -->
</main><!-- #primary -->

<?php
get_footer();
