<?php
/**
 * Panel personalizacji (Customizer) — FlowInstal
 *
 * Pozwala właścicielowi (bez znajomości kodu) zmienić telefon, e-mail,
 * teksty promocyjne, linki social media itp. z poziomu:
 * Wygląd → Dostosuj → FlowInstal.
 *
 * @package FlowInstal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function flowinstal_customize_register( $wp_customize ) {

	/* ---- Panel główny ---- */
	$wp_customize->add_panel( 'flowinstal_panel', array(
		'title'    => __( 'FlowInstal — ustawienia', 'flowinstal' ),
		'priority' => 5,
	) );

	/* =====================================================================
	 * Sekcja: Dane kontaktowe
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_contact', array(
		'title' => __( 'Dane kontaktowe', 'flowinstal' ),
		'panel' => 'flowinstal_panel',
	) );

	$contact_fields = array(
		'flowinstal_phone'    => array( __( 'Telefon (wyświetlany)', 'flowinstal' ), '+48 600 000 000' ),
		'flowinstal_whatsapp' => array( __( 'Numer WhatsApp (jeśli inny niż telefon)', 'flowinstal' ), '+48 600 000 000' ),
		'flowinstal_email'    => array( __( 'Adres e-mail', 'flowinstal' ), 'kontakt@flowinstal.pl' ),
		'flowinstal_address'  => array( __( 'Adres / baza', 'flowinstal' ), 'Brzeziny 95-060, woj. łódzkie' ),
		'flowinstal_hours'    => array( __( 'Godziny pracy (opis)', 'flowinstal' ), 'Pon–Pt: 16:00–21:00 • Sob: 8:00–18:00' ),
		'flowinstal_nip'      => array( __( 'NIP (opcjonalnie)', 'flowinstal' ), '' ),
	);
	foreach ( $contact_fields as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $data[1],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $data[0],
			'section' => 'flowinstal_contact',
			'type'    => 'text',
		) );
	}

	/* =====================================================================
	 * Sekcja: Social media
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_social', array(
		'title' => __( 'Social media i wizytówka Google', 'flowinstal' ),
		'panel' => 'flowinstal_panel',
	) );

	$social_fields = array(
		'flowinstal_facebook'  => array( __( 'Link do Facebooka', 'flowinstal' ), '' ),
		'flowinstal_instagram' => array( __( 'Link do Instagrama', 'flowinstal' ), '' ),
		'flowinstal_google'    => array( __( 'Link do wizytówki Google Maps', 'flowinstal' ), '' ),
		'flowinstal_olx'       => array( __( 'Link do profilu OLX', 'flowinstal' ), '' ),
	);
	foreach ( $social_fields as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $data[1],
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $data[0],
			'section' => 'flowinstal_social',
			'type'    => 'url',
		) );
	}

	/* =====================================================================
	 * Sekcja: Sekcja Hero (główna)
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_hero', array(
		'title' => __( 'Sekcja główna (Hero)', 'flowinstal' ),
		'panel' => 'flowinstal_panel',
	) );

	$hero_fields = array(
		'flowinstal_hero_eyebrow' => array( __( 'Etykieta nad nagłówkiem', 'flowinstal' ), 'Instalator z Brzezin • Maciej Kolasa', 'text' ),
		'flowinstal_hero_title'   => array( __( 'Nagłówek H1', 'flowinstal' ), 'Nowoczesne instalacje grzewcze i wod-kan w Brzezinach', 'text' ),
		'flowinstal_hero_lead'    => array( __( 'Podnagłówek', 'flowinstal' ), 'Planujesz budowę lub remont w Brzezinach, Łodzi lub okolicach? Oferuję 4 lata praktycznego doświadczenia, własne zaplecze sprzętowe oraz elastyczne terminy popołudniowe i weekendowe dopasowane do Twojego czasu.', 'textarea' ),
	);
	foreach ( $hero_fields as $id => $data ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $data[1],
			'sanitize_callback' => 'wp_kses_post',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $data[0],
			'section' => 'flowinstal_hero',
			'type'    => $data[2],
		) );
	}

	/* =====================================================================
	 * Sekcja: Pasek promocyjny i pop-up
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_promo', array(
		'title'       => __( 'Promocja, pasek i pop-up', 'flowinstal' ),
		'panel'       => 'flowinstal_panel',
		'description' => __( 'Elementy budujące konwersję: górny pasek z promocją, licznik czasu oraz wyskakujące okienko z ofertą.', 'flowinstal' ),
	) );

	// Włącz/wyłącz pasek promo.
	$wp_customize->add_setting( 'flowinstal_promo_on', array(
		'default'           => true,
		'sanitize_callback' => 'flowinstal_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'flowinstal_promo_on', array(
		'label'   => __( 'Pokaż górny pasek promocyjny', 'flowinstal' ),
		'section' => 'flowinstal_promo',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'flowinstal_promo_text', array(
		'default'           => 'Promocja na czerwiec: -10% na ogrzewanie podłogowe + bezpłatny dojazd na terenie powiatu brzezińskiego!',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'flowinstal_promo_text', array(
		'label'   => __( 'Treść paska promocyjnego', 'flowinstal' ),
		'section' => 'flowinstal_promo',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'flowinstal_promo_end', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'flowinstal_promo_end', array(
		'label'       => __( 'Data końca promocji (licznik)', 'flowinstal' ),
		'description' => __( 'Format: RRRR-MM-DD (np. 2026-06-30). Zostaw puste, aby ukryć licznik.', 'flowinstal' ),
		'section'     => 'flowinstal_promo',
		'type'        => 'text',
	) );

	// Pop-up.
	$wp_customize->add_setting( 'flowinstal_popup_on', array(
		'default'           => true,
		'sanitize_callback' => 'flowinstal_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'flowinstal_popup_on', array(
		'label'   => __( 'Pokaż wyskakujące okienko z ofertą', 'flowinstal' ),
		'section' => 'flowinstal_promo',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'flowinstal_popup_title', array(
		'default'           => 'Odbierz bezpłatną wycenę',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'flowinstal_popup_title', array(
		'label'   => __( 'Nagłówek pop-upu', 'flowinstal' ),
		'section' => 'flowinstal_promo',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'flowinstal_popup_text', array(
		'default'           => 'Zostaw numer telefonu — oddzwonię po godzinach i bezpłatnie wycenię Twoją instalację. Bez zobowiązań.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'flowinstal_popup_text', array(
		'label'   => __( 'Treść pop-upu', 'flowinstal' ),
		'section' => 'flowinstal_promo',
		'type'    => 'textarea',
	) );

	/* =====================================================================
	 * Sekcja: Mapa i obszar
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_map', array(
		'title' => __( 'Mapa Google (obszar działania)', 'flowinstal' ),
		'panel' => 'flowinstal_panel',
	) );

	$wp_customize->add_setting( 'flowinstal_map_embed', array(
		'default'           => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d39000!2d19.75!3d51.80!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471bcb!2sBrzeziny!5e0!3m2!1spl!2spl!4v1700000000000',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'flowinstal_map_embed', array(
		'label'       => __( 'Adres URL osadzenia mapy (src z iframe Google Maps)', 'flowinstal' ),
		'description' => __( 'W Mapach Google: Udostępnij → Umieść mapę → skopiuj wartość z atrybutu src.', 'flowinstal' ),
		'section'     => 'flowinstal_map',
		'type'        => 'url',
	) );

	/* =====================================================================
	 * Sekcja: Powiadomienia o leadach
	 * ================================================================= */
	$wp_customize->add_section( 'flowinstal_leads', array(
		'title'       => __( 'Zapytania z formularza', 'flowinstal' ),
		'panel'       => 'flowinstal_panel',
		'description' => __( 'Gdzie mają trafiać zapytania wysłane przez formularze na stronie.', 'flowinstal' ),
	) );

	$wp_customize->add_setting( 'flowinstal_lead_email', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'flowinstal_lead_email', array(
		'label'       => __( 'E-mail do odbioru zapytań', 'flowinstal' ),
		'description' => __( 'Jeśli puste — użyty zostanie adres administratora WordPress.', 'flowinstal' ),
		'section'     => 'flowinstal_leads',
		'type'        => 'email',
	) );
}
add_action( 'customize_register', 'flowinstal_customize_register' );

/** Sanityzacja checkboxa. */
function flowinstal_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === (bool) $checked );
}

/** Podgląd na żywo w Customizerze. */
function flowinstal_customize_preview_js() {
	wp_enqueue_script( 'flowinstal-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), FLOWINSTAL_VERSION, true );
}
add_action( 'customize_preview_init', 'flowinstal_customize_preview_js' );
