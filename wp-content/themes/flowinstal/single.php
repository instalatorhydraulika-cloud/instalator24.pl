<?php
/**
 * Szablon pojedynczego wpisu.
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
			<p style="color:#94a3b8;margin:0"><?php echo esc_html( get_the_date() ); ?></p>
		</div>
	</section>
	<div class="fi-container">
		<article class="fi-content">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			the_content();
			wp_link_pages();
			?>
			<p style="margin-top:40px"><a class="fi-btn fi-btn--primary" href="<?php echo esc_url( home_url( '/#kontakt' ) ); ?>"><?php esc_html_e( 'Zamów bezpłatną wycenę', 'flowinstal' ); ?></a></p>
		</article>
	</div>
	<?php
endwhile;
get_footer();
