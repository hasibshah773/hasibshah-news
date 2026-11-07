<?php
/**
 * The template for displaying search forms in HasibShah News
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hasibshah_news_unique_id = wp_unique_id( 'search-form-' );
?>

<form role="search" method="get" class="search-form news-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $hasibshah_news_unique_id ); ?>" class="screen-reader-text">
		<?php esc_html_e( 'অনুসন্ধান করুন / Search for:', 'hasibshah-news' ); ?>
	</label>
	<div class="search-form-input-wrap">
		<input
			type="search"
			id="<?php echo esc_attr( $hasibshah_news_unique_id ); ?>"
			class="search-field"
			placeholder="<?php echo esc_attr__( 'সংবাদ খুঁজুন... / Search news...', 'hasibshah-news' ); ?>"
			value="<?php echo get_search_query(); ?>"
			name="s"
			required
		/>
		<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'hasibshah-news' ); ?>">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="search-btn-icon">
				<circle cx="11" cy="11" r="8"></circle>
				<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
			</svg>
			<span class="search-btn-text"><?php esc_html_e( 'অনুসন্ধান', 'hasibshah-news' ); ?></span>
		</button>
	</div>
</form>

