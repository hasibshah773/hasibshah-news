<?php
/**
 * Template part for displaying single article content
 *
 * Implements a high-readability broadsheet editorial layout for long-form journalism:
 * - Category badge, H1 headline, and optional sub-headline
 * - Reporter byline, publication & update timestamps, reading time badge
 * - Lightweight, privacy-focused social share buttons
 * - Featured image with caption & photographer credit
 * - Long-form editorial body copy with pullquotes & drop-caps
 * - Post pagination (wp_link_pages)
 * - Article tags and author bio box
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id          = get_the_ID();
$author_id        = get_the_author_meta( 'ID' );
$current_url      = get_permalink();
$encoded_url      = rawurlencode( $current_url );
$encoded_title    = rawurlencode( html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ) );
$author_desc      = get_the_author_meta( 'description' );
$has_thumb        = has_post_thumbnail();
$thumb_id         = $has_thumb ? get_post_thumbnail_id() : 0;
$thumb_caption    = $thumb_id ? wp_get_attachment_caption( $thumb_id ) : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-news-article' ); ?>>

	<!-- Article Header -->
	<header class="entry-header article-header">
		<div class="article-category-wrap">
			<?php hasibshah_news_post_badge( $post_id ); ?>
		</div>

		<?php the_title( '<h1 class="entry-title single-article-title">', '</h1>' ); ?>

		<?php if ( has_excerpt() ) : ?>
			<div class="article-lead-excerpt">
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>
		<?php endif; ?>

		<!-- Byline & Metadata Bar -->
		<div class="article-meta-bar">
			<div class="meta-author-wrap">
				<?php
				echo get_avatar(
					$author_id,
					40,
					'',
					get_the_author(),
					array( 'class' => 'byline-avatar' )
				);
				?>
				<div class="meta-author-text">
					<span class="byline-label"><?php esc_html_e( 'প্রতিবেদক:', 'hasibshah-news' ); ?></span>
					<span class="author vcard">
						<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
							<?php echo esc_html( get_the_author() ); ?>
						</a>
					</span>
				</div>
			</div><!-- .meta-author-wrap -->

			<div class="meta-timestamps">
				<span class="meta-item meta-published">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					<span class="meta-label"><?php esc_html_e( 'প্রকাশ:', 'hasibshah-news' ); ?></span>
					<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</span>

				<?php if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) : ?>
					<span class="meta-separator" aria-hidden="true">&bull;</span>
					<span class="meta-item meta-updated">
						<span class="meta-label"><?php esc_html_e( 'আপডেট:', 'hasibshah-news' ); ?></span>
						<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_modified_date() ); ?>
						</time>
					</span>
				<?php endif; ?>

				<span class="meta-separator" aria-hidden="true">&bull;</span>
				<span class="meta-item meta-reading-time">
					<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<circle cx="12" cy="12" r="10"></circle>
						<polyline points="12 6 12 12 16 14"></polyline>
					</svg>
					<?php echo esc_html( hasibshah_news_reading_time( $post_id ) ); ?>
				</span>
			</div><!-- .meta-timestamps -->
		</div><!-- .article-meta-bar -->

		<?php do_action( 'hasibshah_news_single_after_byline' ); ?>

		<!-- Lightweight Privacy-Focused Social Sharing Bar -->
		<div class="article-share-bar" aria-label="<?php esc_attr_e( 'Share this article', 'hasibshah-news' ); ?>">
			<span class="share-label"><?php esc_html_e( 'শেয়ার করুন:', 'hasibshah-news' ); ?></span>
			<ul class="share-buttons-list">
				<!-- Facebook -->
				<li>
					<a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-facebook" title="<?php esc_attr_e( 'Share on Facebook', 'hasibshah-news' ); ?>" aria-label="<?php esc_attr_e( 'Share on Facebook', 'hasibshah-news' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
					</a>
				</li>
				<!-- X / Twitter -->
				<li>
					<a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . $encoded_url . '&text=' . $encoded_title ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-twitter" title="<?php esc_attr_e( 'Share on X', 'hasibshah-news' ); ?>" aria-label="<?php esc_attr_e( 'Share on X', 'hasibshah-news' ); ?>">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
					</a>
				</li>
				<!-- WhatsApp -->
				<li>
					<a href="<?php echo esc_url( 'https://api.whatsapp.com/send?text=' . $encoded_title . '%20' . $encoded_url ); ?>" target="_blank" rel="noopener noreferrer" class="share-btn share-whatsapp" title="<?php esc_attr_e( 'Share on WhatsApp', 'hasibshah-news' ); ?>" aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'hasibshah-news' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.52 3.48A11.93 11.93 0 0 0 12.06 0C5.46 0 .09 5.37.09 11.97c0 2.11.55 4.17 1.6 6L0 24l6.23-1.63a11.92 11.92 0 0 0 5.83 1.51h.01c6.6 0 11.97-5.37 11.97-11.97 0-3.2-.1.25-6.28-3.48-8.43zm-8.46 18.38h-.01a9.92 9.92 0 0 1-5.06-1.39l-.36-.22-3.76.99 1-3.66-.24-.38a9.94 9.94 0 0 1-1.52-5.23c0-5.49 4.47-9.96 9.96-9.96 2.66 0 5.16 1.04 7.04 2.92a9.9 9.9 0 0 1 2.91 7.04c0 5.49-4.47 9.96-9.96 9.96zm5.46-7.46c-.3-.15-1.77-.87-2.04-.97-.28-.1-.48-.15-.68.15-.2.3-.78.97-.95 1.17-.18.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.68-1.64-.93-2.25-.24-.6-.5-.52-.68-.53l-.58-.01c-.2 0-.53.08-.8.38-.28.3-1.05 1.03-1.05 2.51s1.08 2.92 1.23 3.12c.15.2 2.12 3.24 5.14 4.54.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.18-1.42-.08-.12-.28-.2-.58-.35z"></path></svg>
					</a>
				</li>
				<!-- Print -->
				<li>
					<button type="button" onclick="window.print();" class="share-btn share-print" title="<?php esc_attr_e( 'Print Article', 'hasibshah-news' ); ?>" aria-label="<?php esc_attr_e( 'Print Article', 'hasibshah-news' ); ?>">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
					</button>
				</li>
			</ul>
		</div><!-- .article-share-bar -->
	</header><!-- .article-header -->

	<!-- Featured Media Block -->
	<?php if ( $has_thumb ) : ?>
		<figure class="article-featured-media">
			<?php
			the_post_thumbnail(
				'hasibshah-news-lead',
				array(
					'class'   => 'featured-image',
					'loading' => 'eager', // Lead article image is above the fold
				)
			);
			?>
			<?php if ( ! empty( $thumb_caption ) ) : ?>
				<figcaption class="featured-caption">
					<?php echo wp_kses_post( $thumb_caption ); ?>
				</figcaption>
			<?php endif; ?>
		</figure><!-- .article-featured-media -->
	<?php endif; ?>

	<!-- Article Body Content -->
	<div class="entry-content article-body-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'hasibshah-news' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		// Post Pagination for Multi-page Articles (Addresses Theme Check REQUIRED)
		wp_link_pages(
			array(
				'before'      => '<nav class="page-links article-page-links" aria-label="' . esc_attr__( 'Article Pages', 'hasibshah-news' ) . '"><span class="page-links-title">' . esc_html__( 'পৃষ্ঠা:', 'hasibshah-news' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<!-- Article Footer: Tags & Author Bio -->
	<footer class="entry-footer article-footer">
		<?php
		// Article Tags (Addresses Theme Check RECOMMENDED)
		$tags_list = get_the_tag_list(
			'<div class="article-tags-wrap"><span class="tags-title">' . esc_html__( 'বিষয়:', 'hasibshah-news' ) . '</span><ul class="article-tags-list"><li>',
			'</li><li>',
			'</li></ul></div>'
		);
		if ( $tags_list ) {
			echo $tags_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>

		<!-- Author Bio Box -->
		<div class="article-author-bio-box">
			<div class="author-bio-avatar-wrap">
				<?php
				echo get_avatar(
					$author_id,
					72,
					'',
					get_the_author(),
					array( 'class' => 'author-bio-avatar' )
				);
				?>
			</div>
			<div class="author-bio-content">
				<div class="author-bio-header">
					<span class="author-bio-label"><?php esc_html_e( 'লেখক পরিচিতি', 'hasibshah-news' ); ?></span>
					<h3 class="author-bio-name">
						<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
							<?php echo esc_html( get_the_author() ); ?>
						</a>
					</h3>
				</div>
				<?php if ( ! empty( $author_desc ) ) : ?>
					<p class="author-bio-description"><?php echo esc_html( $author_desc ); ?></p>
				<?php else : ?>
					<p class="author-bio-description">
						<?php
						printf(
							/* translators: %s: author name */
							esc_html__( '%s হাসিবশাহ নিউজের একজন নিয়মিত লেখক ও সাংবাদিক।', 'hasibshah-news' ),
							esc_html( get_the_author() )
						);
						?>
					</p>
				<?php endif; ?>
				<div class="author-bio-links">
					<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="author-all-posts-link">
						<?php
						printf(
							/* translators: %s: author name */
							esc_html__( '%s-এর সব সংবাদ ও কলাম পড়ুন', 'hasibshah-news' ),
							esc_html( get_the_author() )
						);
						?> &rarr;
					</a>
				</div>
			</div><!-- .author-bio-content -->
		</div><!-- .article-author-bio-box -->
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->

