<?php
/**
 * Domyślny szablon (blog / archiwum / fallback).
 *
 * @package FlowInstal
 */
get_header();
?>
<section class="fi-page-hero">
	<div class="fi-container">
		<h1><?php is_home() ? bloginfo( 'name' ) : the_archive_title(); ?></h1>
	</div>
</section>

<div class="fi-container">
	<div class="fi-content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> style="margin-bottom:48px;border-bottom:1px solid var(--fi-border);padding-bottom:32px">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p style="color:var(--fi-text-light);font-size:.9rem"><?php echo esc_html( get_the_date() ); ?></p>
					<?php the_excerpt(); ?>
					<a class="fi-btn fi-btn--outline" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Czytaj dalej', 'flowinstal' ); ?></a>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Brak wpisów do wyświetlenia.', 'flowinstal' ); ?></p>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
