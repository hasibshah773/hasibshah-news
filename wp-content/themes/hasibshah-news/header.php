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
		<div class="site-header-container">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) :
					the_custom_logo();
				else :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$hasibshah_news_description = get_bloginfo( 'description', 'display' );
					if ( $hasibshah_news_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo esc_html( $hasibshah_news_description ); ?></p>
						<?php
					endif;
				endif;
				?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'hasibshah-news' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
				endif;
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .site-header-container -->
	</header><!-- #masthead -->

	<?php do_action( 'hasibshah_news_after_header' ); ?>

	<div id="content" class="site-content">

