<?php
/**
 * Sekcja Hero — propozycja wartości skupiona na ogrzewaniu podłogowym.
 *
 * @package FlowInstal
 */
$eyebrow = get_theme_mod( 'flowinstal_hero_eyebrow', 'Specjalista ogrzewania podłogowego • Brzeziny i okolice' );
$title   = get_theme_mod( 'flowinstal_hero_title', 'Ogrzewanie podłogowe od projektu po rozruch — <span class="fi-accent-text">ciepła podłoga w całym domu</span>' );
$lead    = get_theme_mod( 'flowinstal_hero_lead', 'Kompleksowy montaż wodnego ogrzewania podłogowego w Brzezinach, Łodzi i okolicy. Projekt pętli, rozdzielacze, próby ciśnieniowe i rozruch — pod pompę ciepła lub kocioł. Elastyczne terminy popołudniowe i weekendowe dopasowane do Twojego czasu.' );
?>
<section class="fi-hero" id="start">
	<div class="fi-container">
		<div class="fi-hero-content">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'thermometer' ); ?><?php echo esc_html( $eyebrow ); ?></span>
			<h1><?php echo wp_kses_post( $title ); ?></h1>
			<p class="fi-hero-lead"><?php echo wp_kses_post( $lead ); ?></p>

			<div class="fi-hero-cta">
				<a class="fi-btn fi-btn--primary fi-btn--lg" href="#kontakt"><?php flowinstal_icon( 'document' ); ?><?php esc_html_e( 'Bezpłatna wycena po wizji lokalnej', 'flowinstal' ); ?></a>
				<a class="fi-btn fi-btn--outline fi-btn--lg" href="#uslugi" style="color:#fff;border-color:rgba(255,255,255,.3)"><?php esc_html_e( 'Zobacz, jak działam', 'flowinstal' ); ?></a>
			</div>

			<div class="fi-hero-trust">
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'document' ); ?>
					<div><strong><?php esc_html_e( 'Projekt pętli', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'dobór rozstawu i stref', 'flowinstal' ); ?></span></div>
				</div>
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'shield' ); ?>
					<div><strong><?php esc_html_e( 'Próby ciśnieniowe', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'szczelność z protokołem', 'flowinstal' ); ?></span></div>
				</div>
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'zap' ); ?>
					<div><strong><?php esc_html_e( 'Pod pompę ciepła', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'i kotły na pelet', 'flowinstal' ); ?></span></div>
				</div>
			</div>
		</div>

		<div class="fi-hero-card">
			<span class="fi-hero-card-badge"><?php esc_html_e( 'Bezpłatnie', 'flowinstal' ); ?></span>
			<h3><?php esc_html_e( 'Wyceń ogrzewanie podłogowe', 'flowinstal' ); ?></h3>
			<p><?php esc_html_e( 'Zostaw kontakt — oddzwonię, umówię wizję lokalną i bezpłatnie wycenię instalację.', 'flowinstal' ); ?></p>
			<?php flowinstal_contact_form( 'compact', 'hero' ); ?>
		</div>
	</div>
</section>
