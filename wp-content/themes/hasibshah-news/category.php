<?php
/**
 * The template for displaying category archives (including District & Section news)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hasibshah_news_cat = get_queried_object();
$hasibshah_news_slug = $hasibshah_news_cat instanceof WP_Term ? $hasibshah_news_cat->slug : '';

// Map category slug to design token accent class
$hasibshah_news_accent_class = 'cat-accent-default';
if ( preg_match( '/(bangladesh|জাতীয়|বাংলাদেশ|desh|saradesh)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-bangladesh';
} elseif ( preg_match( '/(politic|রাজনীতি|rajniti)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-politics';
} elseif ( preg_match( '/(business|অর্থনীতি|বাণিজ্য|economy)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-business';
} elseif ( preg_match( '/(sport|খেলা|khela)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-sports';
} elseif ( preg_match( '/(entertainment|বিনোদন|binodon)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-entertainment';
} elseif ( preg_match( '/(opinion|মতামত|সম্পাদকীয়|editorial)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-opinion';
} elseif ( preg_match( '/(tech|প্রযুক্তি|বিজ্ঞান)/i', $hasibshah_news_slug ) ) {
	$hasibshah_news_accent_class = 'cat-accent-tech';
}

// Check for child categories or sibling district categories
$hasibshah_news_subcats = array();
if ( $hasibshah_news_cat instanceof WP_Term ) {
	$hasibshah_news_subcats = get_categories(
		array(
			'parent'     => $hasibshah_news_cat->term_id,
			'hide_empty' => false,
		)
	);

	// If current is a child category, offer siblings from parent
	if ( empty( $hasibshah_news_subcats ) && $hasibshah_news_cat->parent ) {
		$hasibshah_news_subcats = get_categories(
			array(
				'parent'     => $hasibshah_news_cat->parent,
				'hide_empty' => false,
			)
		);
	}
}
?>

<main id="primary" class="site-main category-main <?php echo esc_attr( $hasibshah_news_accent_class ); ?>">
	<div class="site-container">
		<header class="category-header">
			<div class="category-header-top">
				<span class="category-eyebrow"><?php esc_html_e( 'বিভাগীয় সংবাদ', 'hasibshah-news' ); ?></span>
				<?php if ( $hasibshah_news_cat instanceof WP_Term && $hasibshah_news_cat->parent ) : ?>
					<?php $hasibshah_news_parent = get_term( $hasibshah_news_cat->parent, 'category' ); ?>
					<?php if ( $hasibshah_news_parent && ! is_wp_error( $hasibshah_news_parent ) ) : ?>
						<span class="category-parent-trail">
							<a href="<?php echo esc_url( get_category_link( $hasibshah_news_parent->term_id ) ); ?>">
								<?php echo esc_html( $hasibshah_news_parent->name ); ?>
							</a>
							<span class="trail-sep" aria-hidden="true">&rsaquo;</span>
						</span>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<h1 class="category-title">
				<span class="category-title-accent" aria-hidden="true"></span>
				<?php single_cat_title(); ?>
			</h1>

			<?php
			$hasibshah_news_cat_desc = category_description();
			if ( ! empty( $hasibshah_news_cat_desc ) ) :
				?>
				<div class="category-description">
					<?php echo wp_kses_post( $hasibshah_news_cat_desc ); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $hasibshah_news_subcats ) ) : ?>
				<nav class="category-subnav" aria-label="<?php esc_attr_e( 'Subcategories', 'hasibshah-news' ); ?>">
					<div class="category-subnav-scroll">
						<span class="subnav-label"><?php esc_html_e( 'উপ-বিভাগ / জেলা:', 'hasibshah-news' ); ?></span>
						<ul class="subnav-list">
							<?php foreach ( $hasibshah_news_subcats as $hasibshah_news_sub ) : ?>
								<?php $hasibshah_news_is_active = ( $hasibshah_news_cat instanceof WP_Term && $hasibshah_news_cat->term_id === $hasibshah_news_sub->term_id ); ?>
								<li class="subnav-item<?php if ( $hasibshah_news_is_active ) : ?> is-active<?php endif; ?>">
									<a href="<?php echo esc_url( get_category_link( $hasibshah_news_sub->term_id ) ); ?>"<?php if ( $hasibshah_news_is_active ) : ?> aria-current="page"<?php endif; ?>>
										<?php echo esc_html( $hasibshah_news_sub->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</nav>
			<?php endif; ?>
		</header><!-- .category-header -->

		<div class="layout-content-sidebar">
			<div class="editorial-main">
				<?php
				if ( have_posts() ) :
					echo '<div class="news-archive-feed">';

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', get_post_format() );
					endwhile;

					echo '</div><!-- .news-archive-feed -->';

					the_posts_pagination(
						array(
							'mid_size'           => 2,
							'prev_text'          => sprintf(
								'<span class="pagination-arrow" aria-hidden="true">&larr;</span> <span class="pagination-text">%s</span>',
								esc_html__( 'পূর্ববর্তী', 'hasibshah-news' )
							),
							'next_text'          => sprintf(
								'<span class="pagination-text">%s</span> <span class="pagination-arrow" aria-hidden="true">&rarr;</span>',
								esc_html__( 'পরবর্তী', 'hasibshah-news' )
							),
							'before_page_number' => '<span class="screen-reader-text">' . esc_html__( 'পৃষ্ঠা', 'hasibshah-news' ) . ' </span>',
						)
					);

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif;
				?>
			</div><!-- .editorial-main -->

			<?php get_sidebar(); ?>
		</div><!-- .layout-content-sidebar -->
	</div><!-- .site-container -->
</main><!-- #primary -->

<?php
get_footer();

