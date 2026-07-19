<?php
/**
 * Sekcja kontaktu z formularzem — zorientowana na Local SEO i konwersję.
 *
 * @package FlowInstal
 */
?>
<section class="fi-section fi-section--alt" id="kontakt">
	<div class="fi-container">
		<div class="fi-contact">
			<div class="fi-contact-info fi-reveal">
				<span class="fi-eyebrow"><?php flowinstal_icon( 'phone' ); ?><?php esc_html_e( 'Kontakt', 'flowinstal' ); ?></span>
				<h2><?php esc_html_e( 'Wyceń ogrzewanie podłogowe — bezpłatnie', 'flowinstal' ); ?></h2>
				<p><?php esc_html_e( 'Zadzwoń, napisz lub wypełnij formularz. Umówię wizję lokalną i przygotuję rzetelną wycenę. Najszybciej skontaktujesz się ze mną telefonicznie — odbieram po godzinach pracy etatowej.', 'flowinstal' ); ?></p>

				<ul class="fi-contact-list">
					<li>
						<span class="fi-contact-ico"><?php flowinstal_icon( 'phone' ); ?></span>
						<div><strong><?php esc_html_e( 'Telefon', 'flowinstal' ); ?></strong>
						<a href="tel:<?php echo esc_attr( flowinstal_phone_link() ); ?>"><?php echo esc_html( flowinstal_phone_display() ); ?></a></div>
					</li>
					<li>
						<span class="fi-contact-ico"><?php flowinstal_icon( 'mail' ); ?></span>
						<div><strong><?php esc_html_e( 'E-mail', 'flowinstal' ); ?></strong>
						<a href="mailto:<?php echo esc_attr( flowinstal_email() ); ?>"><?php echo esc_html( flowinstal_email() ); ?></a></div>
					</li>
					<li>
						<span class="fi-contact-ico"><?php flowinstal_icon( 'pin' ); ?></span>
						<div><strong><?php esc_html_e( 'Obszar działania', 'flowinstal' ); ?></strong>
						<p><?php esc_html_e( 'Brzeziny, Stryków, Andrespol, Koluszki, Łódź Widzew', 'flowinstal' ); ?><span><?php echo esc_html( get_theme_mod( 'flowinstal_address', 'Brzeziny 95-060, woj. łódzkie' ) ); ?></span></p></div>
					</li>
					<li>
						<span class="fi-contact-ico"><?php flowinstal_icon( 'clock' ); ?></span>
						<div><strong><?php esc_html_e( 'Godziny kontaktu', 'flowinstal' ); ?></strong>
						<p><?php echo esc_html( get_theme_mod( 'flowinstal_hours', 'Pon–Pt: 16:00–21:00 • Sob: 8:00–18:00' ) ); ?></p></div>
					</li>
				</ul>

				<a class="fi-btn fi-btn--primary fi-btn--lg" href="<?php echo esc_url( flowinstal_whatsapp_link() ); ?>" target="_blank" rel="noopener"><?php flowinstal_icon( 'whatsapp' ); ?><?php esc_html_e( 'Szybki kontakt przez WhatsApp', 'flowinstal' ); ?></a>
			</div>

			<div class="fi-form-wrap fi-reveal">
				<h3><?php esc_html_e( 'Formularz zapytania', 'flowinstal' ); ?></h3>
				<p><?php esc_html_e( 'Wypełnij pola — oddzwonię i bezpłatnie wycenię zakres prac. Pola oznaczone * są wymagane.', 'flowinstal' ); ?></p>
				<?php flowinstal_contact_form( 'full', 'kontakt' ); ?>
			</div>
		</div>
	</div>
</section>
