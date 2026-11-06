<?php
/**
 * The template for displaying the editorial front page
 *
 * Implements a modern broadsheet newspaper layout with modular section loaders:
 * - Hero Cover Section (Lead, secondary, latest headlines)
 * - District News Grid (সারাদেশ)
 * - Category News Blocks (রাজনীতি, অর্থনীতি, খেলাধুলা)
 * - Multimedia Hub (ভিডিও ও ছবি)
 * - Opinion & Editorial Section (মতামত ও সম্পাদকীয়)
 *
 * Fully Elementor-friendly, WCAG 2.1 AA accessible, and optimized for performance.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main homepage-editorial-feed">

	<?php
	/**
	 * Hook: hasibshah_news_before_homepage.
	 *
	 * Allows plugins, widgets, or child themes to insert content before the homepage sections.
	 */
	do_action( 'hasibshah_news_before_homepage' );
	?>

	<?php
	// 1. Broadsheet Hero Cover (Primary Lead Story + Secondary Stack + Latest News Feed)
	get_template_part( 'template-parts/news-sections/section-hero' );

	// 2. Nationwide / District News Section (সারাদেশ)
	get_template_part( 'template-parts/news-sections/section-district' );

	// 3. Category News Blocks (রাজনীতি, অর্থনীতি, খেলাধুলা)
	get_template_part( 'template-parts/news-sections/section-grid' );

	// 4. Multimedia Video and Photo Gallery Hub (ভিডিও ও ছবি)
	get_template_part( 'template-parts/news-sections/section-media' );

	// 5. Opinion and Columnist Editorial Section (মতামত ও সম্পাদকীয়)
	get_template_part( 'template-parts/news-sections/section-opinion' );
	?>

	<?php
	/**
	 * Hook: hasibshah_news_after_homepage.
	 *
	 * Allows plugins, widgets, or child themes to insert content after the homepage sections.
	 */
	do_action( 'hasibshah_news_after_homepage' );
	?>

</main><!-- #primary -->

<?php
get_footer();

