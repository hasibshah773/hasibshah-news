<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up until <div id="content">
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site hasibshah-news-wrapper">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e( 'Skip to content', 'hasibshah-news' ); ?>
	</a>

	<?php do_action( 'hasibshah_news_before_header' ); ?>

	<header id="masthead" class="site-header">
		<?php
		// 1. Newspaper Topbar (Date, Edition, Secondary Menu).
		get_template_part( 'template-parts/header/topbar' );

		// 2. Main Newspaper Masthead (Branding, Logo, Tagline, Header Banner Slot).
		get_template_part( 'template-parts/header/masthead' );

		// 3. Primary Navigation Menu (Desktop bar, Dropdowns, Mobile Drawer, Search Trigger).
		get_template_part( 'template-parts/header/navigation' );

		// 4. Breaking News Ticker.
		get_template_part( 'template-parts/header/breaking-ticker' );
		?>
	</header><!-- #masthead -->

	<?php do_action( 'hasibshah_news_after_header' ); ?>

	<div id="content" class="site-content">

