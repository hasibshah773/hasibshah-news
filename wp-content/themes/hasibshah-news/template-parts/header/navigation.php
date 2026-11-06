<?php
/**
 * Navigation template part for HasibShah News
 *
 * Displays the primary desktop navigation, accessible dropdowns,
 * mobile menu toggle, and mobile off-canvas drawer.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<nav id="site-navigation" class="news-main-navigation" aria-label="<?php esc_attr_e( 'Main Editorial Navigation', 'hasibshah-news' ); ?>">
	<div class="site-container news-nav-container">
		<!-- Mobile Menu Toggle Button -->
		<button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-controls="mobile-navigation-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'hasibshah-news' ); ?>">
			<span class="hamburger-box" aria-hidden="true">
				<span class="hamburger-inner"></span>
			</span>
			<span class="menu-toggle-label"><?php esc_html_e( 'মেনু', 'hasibshah-news' ); ?></span>
		</button>

		<!-- Home Button Link -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-home-icon" title="<?php esc_attr_e( 'Home', 'hasibshah-news' ); ?>" aria-label="<?php esc_attr_e( 'Homepage', 'hasibshah-news' ); ?>">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
				<polyline points="9 22 9 12 15 12 15 22"></polyline>
			</svg>
		</a>

		<!-- Desktop Navigation Menu -->
		<div class="desktop-navigation-wrapper">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'news-primary-nav-menu',
					'container'      => false,
					'fallback_cb'    => 'hasibshah_news_nav_fallback',
				)
			);
			?>
		</div><!-- .desktop-navigation-wrapper -->

		<!-- Search Trigger in Nav -->
		<div class="nav-actions-right">
			<button id="header-search-toggle" class="header-search-toggle" aria-expanded="false" aria-controls="header-search-dropdown" aria-label="<?php esc_attr_e( 'Search Form', 'hasibshah-news' ); ?>">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<circle cx="11" cy="11" r="8"></circle>
					<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
				</svg>
			</button>
		</div><!-- .nav-actions-right -->
	</div><!-- .site-container -->

	<!-- Dropdown Search Bar -->
	<div id="header-search-dropdown" class="header-search-dropdown" aria-hidden="true">
		<div class="site-container header-search-container">
			<?php get_search_form(); ?>
		</div>
	</div>
</nav><!-- #site-navigation -->

<!-- Mobile Off-Canvas Drawer (Accessible & Focus-Trapped) -->
<div id="mobile-navigation-drawer" class="mobile-navigation-drawer" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile Menu', 'hasibshah-news' ); ?>">
	<div class="mobile-drawer-header">
		<span class="drawer-title"><?php esc_html_e( 'সকল বিভাগ', 'hasibshah-news' ); ?></span>
		<button id="mobile-menu-close" class="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close Menu', 'hasibshah-news' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<line x1="18" y1="6" x2="6" y2="18"></line>
				<line x1="6" y1="6" x2="18" y2="18"></line>
			</svg>
		</button>
	</div><!-- .mobile-drawer-header -->

	<div class="mobile-drawer-content">
		<div class="mobile-drawer-search">
			<?php get_search_form(); ?>
		</div>

		<nav class="mobile-nav-tree" aria-label="<?php esc_attr_e( 'Mobile Navigation Tree', 'hasibshah-news' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'mobile-primary-menu',
					'menu_class'     => 'news-mobile-nav-menu',
					'container'      => false,
					'fallback_cb'    => 'hasibshah_news_nav_fallback',
				)
			);
			?>
		</nav>
	</div><!-- .mobile-drawer-content -->
</div><!-- #mobile-navigation-drawer -->

<div id="mobile-drawer-backdrop" class="mobile-drawer-backdrop" aria-hidden="true"></div>

