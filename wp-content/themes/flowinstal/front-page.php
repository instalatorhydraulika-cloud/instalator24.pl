<?php
/**
 * Strona główna (Landing Page) FlowInstal.
 * Sekcje ładowane z katalogu /template-parts.
 *
 * @package FlowInstal
 */
get_header();
?>

<main id="main">
	<?php
	get_template_part( 'template-parts/hero' );
	get_template_part( 'template-parts/trustbar' );
	get_template_part( 'template-parts/services' );
	get_template_part( 'template-parts/stats' );
	get_template_part( 'template-parts/why' );
	get_template_part( 'template-parts/process' );
	get_template_part( 'template-parts/about' );
	get_template_part( 'template-parts/gallery' );
	get_template_part( 'template-parts/reviews' );
	get_template_part( 'template-parts/pricing' );
	get_template_part( 'template-parts/area' );
	get_template_part( 'template-parts/faq' );
	get_template_part( 'template-parts/cta' );
	get_template_part( 'template-parts/contact' );
	?>
</main>

<?php
get_footer();
