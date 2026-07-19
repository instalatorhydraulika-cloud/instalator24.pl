<?php
/**
 * Pasek CTA — mocne wezwanie do działania przed sekcją kontaktu.
 *
 * @package FlowInstal
 */
?>
<section class="fi-section" style="padding-top:0">
	<div class="fi-container">
		<div class="fi-cta-band fi-reveal">
			<div class="fi-cta-inner">
				<div>
					<h2><?php esc_html_e( 'Planujesz ogrzewanie podłogowe? Porozmawiajmy.', 'flowinstal' ); ?></h2>
					<p><?php esc_html_e( 'Bezpłatna wycena po wizji lokalnej, elastyczne terminy i konkretny fachowiec. Zadzwoń lub napisz — odpowiadam tego samego dnia.', 'flowinstal' ); ?></p>
				</div>
				<div class="fi-cta-band-actions">
					<a class="fi-btn fi-btn--white fi-btn--lg" href="tel:<?php echo esc_attr( flowinstal_phone_link() ); ?>"><?php flowinstal_icon( 'phone' ); ?><?php echo esc_html( flowinstal_phone_display() ); ?></a>
					<a class="fi-btn fi-btn--ghost-light fi-btn--lg" href="<?php echo esc_url( flowinstal_whatsapp_link() ); ?>" target="_blank" rel="noopener"><?php flowinstal_icon( 'whatsapp' ); ?><?php esc_html_e( 'Napisz na WhatsApp', 'flowinstal' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
