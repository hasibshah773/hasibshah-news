<?php
/**
 * Masthead template part for HasibShah News
 *
 * Displays the newspaper branding, logo, site tagline,
 * and header leaderboard sponsorship slot.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="news-masthead">
	<div class="site-container news-masthead-container">
		<div class="news-branding-block">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<div class="news-title-wrap">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</p>
					<?php endif; ?>

					<?php
					$hasibshah_news_description = get_bloginfo( 'description', 'display' );
					if ( $hasibshah_news_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo esc_html( $hasibshah_news_description ); ?></p>
						<?php
					endif;
					?>
				</div><!-- .news-title-wrap -->
				<?php
			endif;
			?>
		</div><!-- .news-branding-block -->

		<div class="news-masthead-ad-slot">
			<?php
			if ( has_action( 'hasibshah_news_header_ad' ) ) :
				do_action( 'hasibshah_news_header_ad' );
			else :
				?>
				<div class="news-header-banner-placeholder" aria-label="<?php esc_attr_e( 'Advertisement Area', 'hasibshah-news' ); ?>">
					<span class="banner-label"><?php esc_html_e( 'বিজ্ঞাপন স্থান / Header Banner Slot (728x90)', 'hasibshah-news' ); ?></span>
				</div>
				<?php
			endif;
			?>
		</div><!-- .news-masthead-ad-slot -->
	</div><!-- .site-container -->
</div><!-- .news-masthead -->

