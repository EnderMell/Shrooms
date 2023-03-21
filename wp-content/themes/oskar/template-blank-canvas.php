<?php
/**
 * Template Name: Blank Canvas
 *
 * A page template with no page title or sidebars, containing only the site title/logo, main menu and footer.
 *
 * @package Oskar
 */

get_header( 'blank-canvas' );

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page-blank-canvas' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer( 'blank-canvas' ); ?>
