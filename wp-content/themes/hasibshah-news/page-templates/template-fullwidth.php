<?php
/**
 * Template Name: Full Width (No Sidebar)
 * Template Post Type: page
 *
 * A template for displaying full-width pages without a sidebar.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main page-main page-fullwidth-main">
	<div class="page-fullwidth-container">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</div><!-- .page-fullwidth-container -->
</main><!-- #primary -->

<?php
get_footer();
