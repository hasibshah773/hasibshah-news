<?php
/**
 * Topbar template part for HasibShah News
 *
 * Displays localized date, edition indicator, and secondary top navigation.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$date_data = hasibshah_news_get_editorial_date();
?>
<div class="news-topbar" id="news-topbar">
	<div class="site-container news-topbar-container">
		<div class="news-topbar-left">
			<div class="news-date-display">
				<span class="news-date-icon" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
				</span>
				<span class="news-date-bangla"><?php echo esc_html( $date_data['bangla'] ); ?></span>
				<span class="news-date-separator" aria-hidden="true">|</span>
				<span class="news-date-english"><?php echo esc_html( $date_data['english'] ); ?></span>
			</div>
			<div class="news-edition-badge">
				<?php esc_html_e( 'ঢাকা সংস্করণ', 'hasibshah-news' ); ?>
			</div>
		</div><!-- .news-topbar-left -->

		<div class="news-topbar-right">
			<?php if ( has_nav_menu( 'topbar' ) ) : ?>
				<nav class="topbar-navigation" aria-label="<?php esc_attr_e( 'Secondary Top Navigation', 'hasibshah-news' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'topbar',
							'menu_id'        => 'topbar-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>

			<?php do_action( 'hasibshah_news_topbar_extras' ); ?>
		</div><!-- .news-topbar-right -->
	</div><!-- .site-container -->
</div><!-- .news-topbar -->

