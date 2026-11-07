<?php
/**
 * Template part for displaying posts in archive, search, and category feeds
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-archive-card' ); ?>>
	<div class="archive-card-media">
		<a href="<?php the_permalink(); ?>" class="archive-card-thumbnail-link" aria-hidden="true" tabindex="-1">
			<?php
			if ( function_exists( 'hasibshah_news_post_thumbnail' ) ) {
				hasibshah_news_post_thumbnail( 'hasibshah-news-card', get_the_ID(), 'archive-card-img' );
			} elseif ( has_post_thumbnail() ) {
				the_post_thumbnail( 'hasibshah-news-card', array( 'class' => 'archive-card-img', 'loading' => 'lazy' ) );
			}
			?>
		</a>
		<?php if ( function_exists( 'hasibshah_news_post_badge' ) ) : ?>
			<div class="archive-card-badge-wrap">
				<?php hasibshah_news_post_badge( get_the_ID() ); ?>
			</div>
		<?php endif; ?>
	</div><!-- .archive-card-media -->

	<div class="archive-card-body">
		<header class="archive-card-header">
			<?php the_title( sprintf( '<h2 class="archive-card-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<div class="archive-card-meta">
				<span class="archive-meta-author">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="meta-icon">
						<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
						<circle cx="12" cy="7" r="4"></circle>
					</svg>
					<?php the_author_posts_link(); ?>
				</span>

				<span class="meta-sep" aria-hidden="true">&bull;</span>

				<span class="archive-meta-date">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="meta-icon">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					<?php
					if ( function_exists( 'hasibshah_news_time_ago' ) ) {
						echo esc_html( hasibshah_news_time_ago( get_the_ID() ) );
					} else {
						echo esc_html( get_the_date() );
					}
					?>
				</span>

				<span class="meta-sep" aria-hidden="true">&bull;</span>

				<span class="archive-meta-reading-time">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="meta-icon">
						<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
						<path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
					</svg>
					<?php
					if ( function_exists( 'hasibshah_news_reading_time' ) ) {
						echo esc_html( hasibshah_news_reading_time( get_the_ID() ) );
					}
					?>
				</span>
			</div><!-- .archive-card-meta -->
		</header><!-- .archive-card-header -->

		<div class="archive-card-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .archive-card-excerpt -->
	</div><!-- .archive-card-body -->
</article><!-- #post-<?php the_ID(); ?> -->

