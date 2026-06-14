<?php
/**
 * Sekcja Hero — pierwszy ekran z propozycją wartości i formularzem szybkiej wyceny.
 *
 * @package FlowInstal
 */
$eyebrow = get_theme_mod( 'flowinstal_hero_eyebrow', 'Instalator z Brzezin • Maciej Kolasa' );
$title   = get_theme_mod( 'flowinstal_hero_title', 'Nowoczesne instalacje grzewcze i wod-kan w Brzezinach' );
$lead    = get_theme_mod( 'flowinstal_hero_lead', 'Planujesz budowę lub remont w Brzezinach, Łodzi lub okolicach? Oferuję 4 lata praktycznego doświadczenia, własne zaplecze sprzętowe oraz elastyczne terminy popołudniowe i weekendowe dopasowane do Twojego czasu.' );
?>
<section class="fi-hero" id="start">
	<div class="fi-container">
		<div class="fi-hero-content">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'pin' ); ?><?php echo esc_html( $eyebrow ); ?></span>
			<h1><?php echo wp_kses_post( $title ); ?></h1>
			<p class="fi-hero-lead"><?php echo wp_kses_post( $lead ); ?></p>

			<div class="fi-hero-cta">
				<a class="fi-btn fi-btn--primary fi-btn--lg" href="#kontakt"><?php flowinstal_icon( 'document' ); ?><?php esc_html_e( 'Bezpłatna wycena', 'flowinstal' ); ?></a>
				<a class="fi-btn fi-btn--outline fi-btn--lg" href="#uslugi" style="color:#fff;border-color:rgba(255,255,255,.3)"><?php esc_html_e( 'Zobacz ofertę', 'flowinstal' ); ?></a>
			</div>

			<div class="fi-hero-trust">
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'award' ); ?>
					<div><strong><?php esc_html_e( '4 lata', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'praktyki na budowie', 'flowinstal' ); ?></span></div>
				</div>
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'truck' ); ?>
					<div><strong><?php esc_html_e( 'Darmowy dojazd', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'powiat brzeziński', 'flowinstal' ); ?></span></div>
				</div>
				<div class="fi-hero-trust-item">
					<?php flowinstal_icon( 'calendar' ); ?>
					<div><strong><?php esc_html_e( 'Popołudnia i soboty', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'elastyczne terminy', 'flowinstal' ); ?></span></div>
				</div>
			</div>
		</div>

		<div class="fi-hero-card">
			<span class="fi-hero-card-badge"><?php esc_html_e( 'Bezpłatnie', 'flowinstal' ); ?></span>
			<h3><?php esc_html_e( 'Zamów szybką wycenę', 'flowinstal' ); ?></h3>
			<p><?php esc_html_e( 'Zostaw kontakt — oddzwonię i bezpłatnie wycenię Twoją instalację.', 'flowinstal' ); ?></p>
			<?php flowinstal_contact_form( 'compact', 'hero' ); ?>
		</div>
	</div>
</section>
