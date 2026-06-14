<?php
/**
 * Stopka motywu: kolumny, pływające przyciski, pasek mobilny, pop-up, cookie.
 *
 * @package FlowInstal
 */
$phone_link = flowinstal_phone_link();
$phone_disp = flowinstal_phone_display();
$wa_link    = flowinstal_whatsapp_link();
$fb = get_theme_mod( 'flowinstal_facebook', '' );
$ig = get_theme_mod( 'flowinstal_instagram', '' );
$gg = get_theme_mod( 'flowinstal_google', '' );
$year = date( 'Y' );
?>

<footer class="fi-footer">
	<div class="fi-container">
		<div class="fi-footer-grid">
			<div>
				<a class="fi-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span class="fi-logo-mark"><?php flowinstal_icon( 'droplet' ); ?></span>
					<span><b>Flow</b><span>Instal</span></span>
				</a>
				<p><?php esc_html_e( 'Nowoczesne instalacje grzewcze, ogrzewanie podłogowe i wod-kan. Brzeziny, Łódź i okolice. Fachowość, słowność i czystość pracy.', 'flowinstal' ); ?></p>
				<div class="fi-footer-social">
					<?php if ( $fb ) : ?><a href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><?php flowinstal_icon( 'facebook' ); ?></a><?php endif; ?>
					<?php if ( $ig ) : ?><a href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><?php flowinstal_icon( 'instagram' ); ?></a><?php endif; ?>
					<?php if ( $gg ) : ?><a href="<?php echo esc_url( $gg ); ?>" target="_blank" rel="noopener" aria-label="Google Maps"><?php flowinstal_icon( 'google' ); ?></a><?php endif; ?>
					<a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?php flowinstal_icon( 'whatsapp' ); ?></a>
				</div>
			</div>

			<div>
				<h4><?php esc_html_e( 'Oferta', 'flowinstal' ); ?></h4>
				<ul class="fi-footer-links">
					<li><a href="#uslugi"><?php esc_html_e( 'Ogrzewanie podłogowe', 'flowinstal' ); ?></a></li>
					<li><a href="#uslugi"><?php esc_html_e( 'Kotłownie na pelet', 'flowinstal' ); ?></a></li>
					<li><a href="#uslugi"><?php esc_html_e( 'Instalacje wod-kan', 'flowinstal' ); ?></a></li>
					<li><a href="#uslugi"><?php esc_html_e( 'Oczyszczalnie ścieków', 'flowinstal' ); ?></a></li>
					<li><a href="#cennik"><?php esc_html_e( 'Cennik orientacyjny', 'flowinstal' ); ?></a></li>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Obszar', 'flowinstal' ); ?></h4>
				<ul class="fi-footer-links">
					<li><a href="#obszar"><?php esc_html_e( 'Brzeziny', 'flowinstal' ); ?></a></li>
					<li><a href="#obszar"><?php esc_html_e( 'Stryków', 'flowinstal' ); ?></a></li>
					<li><a href="#obszar"><?php esc_html_e( 'Koluszki', 'flowinstal' ); ?></a></li>
					<li><a href="#obszar"><?php esc_html_e( 'Andrespol', 'flowinstal' ); ?></a></li>
					<li><a href="#obszar"><?php esc_html_e( 'Łódź Widzew', 'flowinstal' ); ?></a></li>
				</ul>
			</div>

			<div>
				<h4><?php esc_html_e( 'Kontakt', 'flowinstal' ); ?></h4>
				<ul class="fi-footer-links fi-footer-contact">
					<li><?php flowinstal_icon( 'phone' ); ?><a href="tel:<?php echo esc_attr( $phone_link ); ?>"><?php echo esc_html( $phone_disp ); ?></a></li>
					<li><?php flowinstal_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( flowinstal_email() ); ?>"><?php echo esc_html( flowinstal_email() ); ?></a></li>
					<li><?php flowinstal_icon( 'pin' ); ?><span><?php echo esc_html( get_theme_mod( 'flowinstal_address', 'Brzeziny 95-060, woj. łódzkie' ) ); ?></span></li>
					<li><?php flowinstal_icon( 'clock' ); ?><span><?php echo esc_html( get_theme_mod( 'flowinstal_hours', 'Pon–Pt: 16:00–21:00 • Sob: 8:00–18:00' ) ); ?></span></li>
				</ul>
			</div>
		</div>

		<div class="fi-footer-bottom">
			<span>&copy; <?php echo esc_html( $year ); ?> FlowInstal — Maciej Kolasa. <?php esc_html_e( 'Wszystkie prawa zastrzeżone. Instalacje wod-kan i CO Brzeziny.', 'flowinstal' ); ?></span>
			<nav class="fi-footer-bottom-links">
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'depth'          => 1,
					) );
				}
				$privacy = get_privacy_policy_url();
				if ( $privacy ) {
					echo '<a href="' . esc_url( $privacy ) . '">' . esc_html__( 'Polityka prywatności', 'flowinstal' ) . '</a>';
				} else {
					echo '<a href="#kontakt">' . esc_html__( 'Polityka prywatności', 'flowinstal' ) . '</a>';
				}
				?>
			</nav>
		</div>
	</div>
</footer>

<!-- ===== Konwersja: pływające przyciski ===== -->
<div class="fi-float">
	<a class="fi-float-wa" href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?php flowinstal_icon( 'whatsapp' ); ?></a>
	<a class="fi-float-tel" href="tel:<?php echo esc_attr( $phone_link ); ?>" aria-label="<?php esc_attr_e( 'Zadzwoń', 'flowinstal' ); ?>"><?php flowinstal_icon( 'phone' ); ?></a>
</div>

<!-- ===== Konwersja: dolny pasek mobilny ===== -->
<div class="fi-mobile-bar">
	<a class="fi-mb-call" href="tel:<?php echo esc_attr( $phone_link ); ?>"><?php flowinstal_icon( 'phone' ); ?><?php esc_html_e( 'Zadzwoń', 'flowinstal' ); ?></a>
	<a class="fi-mb-quote" href="#kontakt"><?php flowinstal_icon( 'document' ); ?><?php esc_html_e( 'Bezpłatna wycena', 'flowinstal' ); ?></a>
</div>

<!-- ===== Back to top ===== -->
<button class="fi-totop" id="fi-totop" aria-label="<?php esc_attr_e( 'Do góry', 'flowinstal' ); ?>"><?php flowinstal_icon( 'arrow-up' ); ?></button>

<?php
// ---- Pop-up z ofertą (lead) ----
$popup_on = get_theme_mod( 'flowinstal_popup_on', true );
if ( $popup_on ) :
	$popup_title = get_theme_mod( 'flowinstal_popup_title', 'Odbierz bezpłatną wycenę' );
	$popup_text  = get_theme_mod( 'flowinstal_popup_text', 'Zostaw numer telefonu — oddzwonię po godzinach i bezpłatnie wycenię Twoją instalację. Bez zobowiązań.' );
	?>
	<div class="fi-popup-overlay" id="fi-popup">
		<div class="fi-popup" role="dialog" aria-modal="true" aria-labelledby="fi-popup-title">
			<div class="fi-popup-head">
				<button class="fi-popup-close" id="fi-popup-close" aria-label="<?php esc_attr_e( 'Zamknij', 'flowinstal' ); ?>"><?php flowinstal_icon( 'close' ); ?></button>
				<span class="fi-popup-badge"><?php esc_html_e( 'Oferta dnia', 'flowinstal' ); ?></span>
				<h3 id="fi-popup-title"><?php echo esc_html( $popup_title ); ?></h3>
				<p><?php echo esc_html( $popup_text ); ?></p>
			</div>
			<div class="fi-popup-body">
				<?php flowinstal_contact_form( 'compact', 'popup' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<!-- ===== Pasek cookie / RODO ===== -->
<div class="fi-cookie" id="fi-cookie">
	<p><?php esc_html_e( 'Ta strona używa plików cookies w celach statystycznych i poprawy działania serwisu. Korzystając z witryny, wyrażasz na to zgodę.', 'flowinstal' ); ?></p>
	<div class="fi-cookie-actions">
		<button class="fi-btn fi-btn--primary" id="fi-cookie-accept"><?php esc_html_e( 'Akceptuję', 'flowinstal' ); ?></button>
		<?php $privacy = get_privacy_policy_url(); ?>
		<a class="fi-btn fi-btn--outline" href="<?php echo $privacy ? esc_url( $privacy ) : '#kontakt'; ?>"><?php esc_html_e( 'Więcej', 'flowinstal' ); ?></a>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
