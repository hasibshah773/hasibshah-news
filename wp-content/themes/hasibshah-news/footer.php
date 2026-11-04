<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content up to </body>
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</div><!-- #content -->

	<?php do_action( 'hasibshah_news_before_footer' ); ?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer-container">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hasibshah-news' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'hasibshah-news' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'hasibshah-news' ), 'HasibShah News', 'HasibShah Team' );
				?>
			</div><!-- .site-info -->
		</div><!-- .site-footer-container -->
	</footer><!-- #colophon -->

	<?php do_action( 'hasibshah_news_after_footer' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

