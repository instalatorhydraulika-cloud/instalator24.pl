<?php
/**
 * Sekcja FAQ — accordion. Treść współdzielona ze schematem FAQPage (SEO).
 *
 * @package FlowInstal
 */
$faqs = function_exists( 'flowinstal_get_faqs' ) ? flowinstal_get_faqs() : array();
?>
<section class="fi-section fi-section--alt" id="faq">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'chat' ); ?><?php esc_html_e( 'Pytania i odpowiedzi', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Najczęściej zadawane pytania', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Masz wątpliwości? Poniżej znajdziesz odpowiedzi na pytania, które słyszę najczęściej.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-faq">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<div class="fi-faq-item<?php echo 0 === $i ? ' is-open' : ''; ?>">
					<button class="fi-faq-q" type="button" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<span><?php echo esc_html( $faq['q'] ); ?></span>
						<span class="fi-faq-ico"><?php flowinstal_icon( 'plus' ); ?></span>
					</button>
					<div class="fi-faq-a"<?php echo 0 === $i ? ' style="max-height:400px"' : ''; ?>>
						<div class="fi-faq-a-inner"><?php echo esc_html( $faq['a'] ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
