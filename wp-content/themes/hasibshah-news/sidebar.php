<?php
/**
 * The sidebar containing the main widget area
 *
 * Displays widgets on archives, categories, search results, and single posts.
 * Returns early without empty HTML wrappers if no widgets are active.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area editorial-sidebar" aria-label="<?php esc_attr_e( 'Editorial Sidebar', 'hasibshah-news' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

