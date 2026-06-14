<?php
/**
 * Szablon strony statycznej.
 *
 * @package FlowInstal
 */
get_header();
while ( have_posts() ) : the_post();
	?>
	<section class="fi-page-hero">
		<div class="fi-container">
			<nav class="fi-breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'flowinstal' ); ?></a> / <?php the_title(); ?></nav>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="fi-container">
		<article class="fi-content">
			<?php
			the_content();
			wp_link_pages();
			?>
		</article>
	</div>
	<?php
endwhile;
get_footer();
