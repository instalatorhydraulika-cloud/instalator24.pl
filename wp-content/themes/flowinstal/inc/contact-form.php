<?php
/**
 * Formularz kontaktowy (lead) — render + obsługa AJAX
 *
 * @package FlowInstal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renderuje formularz kontaktowy.
 *
 * @param string $variant 'full' (sekcja kontakt) lub 'compact' (hero / pop-up).
 * @param string $context Identyfikator źródła leada (np. hero, popup, kontakt).
 */
function flowinstal_contact_form( $variant = 'full', $context = 'kontakt' ) {
	$compact = ( 'compact' === $variant );
	$uid     = 'fi-form-' . esc_attr( $context );
	?>
	<form class="fi-form" id="<?php echo esc_attr( $uid ); ?>" method="post" novalidate data-context="<?php echo esc_attr( $context ); ?>">
		<div class="fi-form-feedback" role="status" aria-live="polite"></div>

		<?php if ( ! $compact ) : ?>
		<div class="fi-form-row">
		<?php endif; ?>

			<div class="fi-field">
				<label for="<?php echo esc_attr( $uid ); ?>-name"><?php esc_html_e( 'Imię i nazwisko', 'flowinstal' ); ?> <span class="req">*</span></label>
				<input type="text" id="<?php echo esc_attr( $uid ); ?>-name" name="fi_name" required placeholder="<?php esc_attr_e( 'np. Jan Kowalski', 'flowinstal' ); ?>">
				<span class="fi-field-error"><?php esc_html_e( 'Podaj imię i nazwisko.', 'flowinstal' ); ?></span>
			</div>

			<div class="fi-field">
				<label for="<?php echo esc_attr( $uid ); ?>-phone"><?php esc_html_e( 'Telefon', 'flowinstal' ); ?> <span class="req">*</span></label>
				<input type="tel" id="<?php echo esc_attr( $uid ); ?>-phone" name="fi_phone" required inputmode="tel" placeholder="<?php esc_attr_e( 'np. 600 000 000', 'flowinstal' ); ?>">
				<span class="fi-field-error"><?php esc_html_e( 'Podaj poprawny numer telefonu (min. 9 cyfr).', 'flowinstal' ); ?></span>
			</div>

		<?php if ( ! $compact ) : ?>
		</div>
		<div class="fi-form-row">
			<div class="fi-field">
				<label for="<?php echo esc_attr( $uid ); ?>-loc"><?php esc_html_e( 'Lokalizacja inwestycji', 'flowinstal' ); ?></label>
				<input type="text" id="<?php echo esc_attr( $uid ); ?>-loc" name="fi_location" placeholder="<?php esc_attr_e( 'np. Brzeziny, Stryków…', 'flowinstal' ); ?>">
			</div>
			<div class="fi-field">
				<label for="<?php echo esc_attr( $uid ); ?>-type"><?php esc_html_e( 'Typ instalacji', 'flowinstal' ); ?></label>
				<select id="<?php echo esc_attr( $uid ); ?>-type" name="fi_type">
					<option value=""><?php esc_html_e( '— wybierz —', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Ogrzewanie podłogowe', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Kotłownia / kocioł (pelet, ekogroszek)', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Instalacja wod-kan', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Przydomowa oczyszczalnia ścieków', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Inne / nie wiem', 'flowinstal' ); ?></option>
				</select>
			</div>
		</div>
		<div class="fi-field">
			<label for="<?php echo esc_attr( $uid ); ?>-msg"><?php esc_html_e( 'Treść wiadomości', 'flowinstal' ); ?></label>
			<textarea id="<?php echo esc_attr( $uid ); ?>-msg" name="fi_message" placeholder="<?php esc_attr_e( 'Opisz krótko zakres prac, metraż, termin…', 'flowinstal' ); ?>"></textarea>
		</div>
		<?php else : ?>
			<div class="fi-field">
				<label for="<?php echo esc_attr( $uid ); ?>-type"><?php esc_html_e( 'Czego dotyczy zlecenie?', 'flowinstal' ); ?></label>
				<select id="<?php echo esc_attr( $uid ); ?>-type" name="fi_type">
					<option value=""><?php esc_html_e( '— wybierz —', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Ogrzewanie podłogowe', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Kotłownia / kocioł', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Instalacja wod-kan', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Oczyszczalnia ścieków', 'flowinstal' ); ?></option>
					<option><?php esc_html_e( 'Inne', 'flowinstal' ); ?></option>
				</select>
			</div>
		<?php endif; ?>

		<!-- Pole-pułapka na boty (honeypot) -->
		<div class="fi-hp" aria-hidden="true">
			<label for="<?php echo esc_attr( $uid ); ?>-website"><?php esc_html_e( 'Nie wypełniaj tego pola', 'flowinstal' ); ?></label>
			<input type="text" id="<?php echo esc_attr( $uid ); ?>-website" name="fi_website" tabindex="-1" autocomplete="off">
		</div>

		<label class="fi-consent">
			<input type="checkbox" name="fi_consent" required>
			<span><?php esc_html_e( 'Wyrażam zgodę na kontakt telefoniczny w sprawie wyceny oraz akceptuję politykę prywatności. *', 'flowinstal' ); ?></span>
		</label>

		<input type="hidden" name="fi_source" value="<?php echo esc_attr( $context ); ?>">
		<button type="submit" class="fi-btn fi-btn--primary fi-btn--block fi-btn--lg">
			<?php flowinstal_icon( 'arrow' ); ?>
			<span><?php echo $compact ? esc_html__( 'Oddzwońcie do mnie', 'flowinstal' ) : esc_html__( 'Wyślij zapytanie o wycenę', 'flowinstal' ); ?></span>
		</button>
		<p class="fi-form-note">
			<?php flowinstal_icon( 'shield' ); ?>
			<?php esc_html_e( 'Odpowiadam zwykle tego samego dnia. Twoje dane są bezpieczne.', 'flowinstal' ); ?>
		</p>
	</form>
	<?php
}

/* =========================================================================
 * Obsługa wysyłki (AJAX) — zalogowani i niezalogowani
 * ===================================================================== */
function flowinstal_handle_contact() {
	check_ajax_referer( 'flowinstal_contact', 'nonce' );

	// Honeypot — jeśli wypełniony, to bot.
	if ( ! empty( $_POST['fi_website'] ) ) {
		wp_send_json_error( array( 'message' => __( 'Wykryto spam.', 'flowinstal' ) ) );
	}

	$name    = isset( $_POST['fi_name'] ) ? sanitize_text_field( wp_unslash( $_POST['fi_name'] ) ) : '';
	$phone   = isset( $_POST['fi_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['fi_phone'] ) ) : '';
	$loc     = isset( $_POST['fi_location'] ) ? sanitize_text_field( wp_unslash( $_POST['fi_location'] ) ) : '';
	$type    = isset( $_POST['fi_type'] ) ? sanitize_text_field( wp_unslash( $_POST['fi_type'] ) ) : '';
	$message = isset( $_POST['fi_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['fi_message'] ) ) : '';
	$source  = isset( $_POST['fi_source'] ) ? sanitize_text_field( wp_unslash( $_POST['fi_source'] ) ) : '';
	$consent = ! empty( $_POST['fi_consent'] );

	$digits = preg_replace( '/[^0-9]/', '', $phone );
	if ( '' === $name || strlen( $digits ) < 9 || ! $consent ) {
		wp_send_json_error( array( 'message' => __( 'Uzupełnij wymagane pola: imię, telefon i zgodę na kontakt.', 'flowinstal' ) ) );
	}

	$lead_email = get_theme_mod( 'flowinstal_lead_email', '' );
	if ( empty( $lead_email ) || ! is_email( $lead_email ) ) {
		$lead_email = get_option( 'admin_email' );
	}

	$subject = sprintf( __( '[FlowInstal] Nowe zapytanie od: %s', 'flowinstal' ), $name );
	$body  = __( 'Nowe zapytanie o wycenę ze strony FlowInstal:', 'flowinstal' ) . "\n\n";
	$body .= __( 'Imię i nazwisko: ', 'flowinstal' ) . $name . "\n";
	$body .= __( 'Telefon: ', 'flowinstal' ) . $phone . "\n";
	$body .= __( 'Lokalizacja: ', 'flowinstal' ) . ( $loc ? $loc : '—' ) . "\n";
	$body .= __( 'Typ instalacji: ', 'flowinstal' ) . ( $type ? $type : '—' ) . "\n";
	$body .= __( 'Wiadomość: ', 'flowinstal' ) . ( $message ? $message : '—' ) . "\n";
	$body .= __( 'Źródło: ', 'flowinstal' ) . ( $source ? $source : '—' ) . "\n";
	$body .= "\n" . __( 'Data: ', 'flowinstal' ) . current_time( 'Y-m-d H:i' ) . "\n";

	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	$sent    = wp_mail( $lead_email, $subject, $body, $headers );

	// Zapis leada jako wpis prywatny (kopia bezpieczeństwa, gdyby mail nie doszedł).
	wp_insert_post( array(
		'post_type'    => 'flowinstal_lead',
		'post_status'  => 'private',
		'post_title'   => $name . ' — ' . $phone,
		'post_content' => $body,
	) );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( 'Dziękuję! Zapytanie wysłane — odezwę się najszybciej, jak to możliwe.', 'flowinstal' ) ) );
	}
	wp_send_json_error( array( 'message' => __( 'Nie udało się wysłać wiadomości. Zadzwoń proszę bezpośrednio.', 'flowinstal' ) ) );
}
add_action( 'wp_ajax_flowinstal_contact', 'flowinstal_handle_contact' );
add_action( 'wp_ajax_nopriv_flowinstal_contact', 'flowinstal_handle_contact' );

/* Rejestracja typu wpisu na leady (podgląd w kółku Kokpit → Zapytania). */
function flowinstal_register_lead_cpt() {
	register_post_type( 'flowinstal_lead', array(
		'labels'       => array(
			'name'          => __( 'Zapytania', 'flowinstal' ),
			'singular_name' => __( 'Zapytanie', 'flowinstal' ),
			'menu_name'     => __( 'Zapytania (leady)', 'flowinstal' ),
		),
		'public'       => false,
		'show_ui'      => true,
		'menu_icon'    => 'dashicons-email-alt',
		'supports'     => array( 'title', 'editor' ),
		'capability_type' => 'post',
	) );
}
add_action( 'init', 'flowinstal_register_lead_cpt' );
