<?php
/**
 * Template part for displaying a message that posts cannot be found
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

<section class="no-results not-found editorial-empty-state">
	<header class="page-header empty-state-header">
		<div class="empty-state-icon" aria-hidden="true">
			<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="8"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
				<line x1="8" y1="11" x2="14" y2="11"></line>
			</svg>
		</div>

		<h1 class="page-title empty-state-title">
			<?php
			if ( is_search() ) :
				printf(
					/* translators: %s: search query string */
					esc_html__( 'কোনো ফলাফল পাওয়া যায়নি: &ldquo;%s&rdquo;', 'hasibshah-news' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
			else :
				esc_html_e( 'এই বিভাগে কোনো সংবাদ পাওয়া যায়নি', 'hasibshah-news' );
			endif;
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content empty-state-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p class="empty-state-text">
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'প্রথম সংবাদ প্রকাশ করতে প্রস্তুত? <a href="%1$s">এখানে ক্লিক করে শুরু করুন</a>।', 'hasibshah-news' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p class="empty-state-text">
				<?php esc_html_e( 'আপনার কাঙ্ক্ষিত শব্দের সাথে মিলে এমন কোনো প্রতিবেদন বা সংবাদ খুঁজে পাওয়া যায়নি। বানান পরীক্ষা করে অথবা ভিন্ন কোনো শব্দ দিয়ে আবার চেষ্টা করুন।', 'hasibshah-news' ); ?>
			</p>
			<div class="empty-search-form-wrap">
				<?php get_search_form(); ?>
			</div>

			<?php
			$categories = get_categories(
				array(
					'number'     => 6,
					'orderby'    => 'count',
					'order'      => 'DESC',
					'hide_empty' => true,
				)
			);
			if ( ! empty( $categories ) ) :
				?>
				<div class="empty-state-suggestions">
					<h2 class="suggestions-heading"><?php esc_html_e( 'জনপ্রিয় বিভাগসমূহ ঘুরে দেখুন:', 'hasibshah-news' ); ?></h2>
					<div class="suggestions-chips">
						<?php foreach ( $categories as $category ) : ?>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="suggestion-chip">
								<?php echo esc_html( $category->name ); ?>
								<span class="chip-count"><?php echo esc_html( function_exists( 'hasibshah_news_to_bangla_number' ) ? hasibshah_news_to_bangla_number( $category->count ) : $category->count ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

		<?php else : ?>
			<p class="empty-state-text">
				<?php esc_html_e( 'দুঃখিত, এই পাতায় প্রদর্শনের মতো কোনো সংবাদ পাওয়া যায়নি। আপনি নিচের অনুসন্ধান বাক্স ব্যবহার করে কাঙ্ক্ষিত সংবাদটি খুঁজতে পারেন:', 'hasibshah-news' ); ?>
			</p>
			<div class="empty-search-form-wrap">
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->

