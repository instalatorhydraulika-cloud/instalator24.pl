<?php
/**
 * FlowInstal — funkcje motywu
 *
 * Motyw konwersyjny dla lokalnej firmy instalatorskiej (Brzeziny, woj. łódzkie).
 *
 * @package FlowInstal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Brak bezpośredniego dostępu.
}

define( 'FLOWINSTAL_VERSION', '1.0.0' );

/* =========================================================================
 * 1. Konfiguracja motywu
 * ===================================================================== */
if ( ! function_exists( 'flowinstal_setup' ) ) {
	function flowinstal_setup() {
		load_theme_textdomain( 'flowinstal', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
		) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );

		register_nav_menus( array(
			'primary' => __( 'Menu główne', 'flowinstal' ),
			'footer'  => __( 'Menu w stopce', 'flowinstal' ),
		) );

		// Rozmiary obrazów dla realizacji.
		add_image_size( 'flowinstal-gallery', 600, 450, true );
	}
}
add_action( 'after_setup_theme', 'flowinstal_setup' );

/* =========================================================================
 * 2. Skrypty i style
 * ===================================================================== */
function flowinstal_assets() {
	// Font Inter (Google Fonts) — preconnect dla szybkości.
	wp_enqueue_style(
		'flowinstal-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'flowinstal-style', get_stylesheet_uri(), array( 'flowinstal-fonts' ), FLOWINSTAL_VERSION );

	wp_enqueue_script(
		'flowinstal-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		FLOWINSTAL_VERSION,
		true
	);

	// Dane dla AJAX-owego formularza kontaktowego.
	wp_localize_script( 'flowinstal-main', 'flowinstalData', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'flowinstal_contact' ),
		'promoEnd'=> get_theme_mod( 'flowinstal_promo_end', '' ),
		'msgSending' => __( 'Wysyłanie…', 'flowinstal' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'flowinstal_assets' );

// Preconnect do Google Fonts dla wydajności.
function flowinstal_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'flowinstal_resource_hints', 10, 2 );

/* =========================================================================
 * 3. Klasy <body>
 * ===================================================================== */
function flowinstal_body_classes( $classes ) {
	$classes[] = 'has-mobile-bar';
	return $classes;
}
add_filter( 'body_class', 'flowinstal_body_classes' );

/* =========================================================================
 * 4. Pomocnicze: pobieranie danych kontaktowych (z Customizera)
 * ===================================================================== */

/** Numer telefonu w formacie do wyświetlenia. */
function flowinstal_phone_display() {
	return get_theme_mod( 'flowinstal_phone', '+48 600 000 000' );
}

/** Numer telefonu w formacie do tel: (same cyfry i +). */
function flowinstal_phone_link() {
	$raw = get_theme_mod( 'flowinstal_phone', '+48 600 000 000' );
	return preg_replace( '/[^0-9+]/', '', $raw );
}

/** Numer do WhatsApp (same cyfry, bez +). */
function flowinstal_whatsapp_number() {
	$raw = get_theme_mod( 'flowinstal_whatsapp', get_theme_mod( 'flowinstal_phone', '+48 600 000 000' ) );
	return preg_replace( '/[^0-9]/', '', $raw );
}

/** Adres e-mail. */
function flowinstal_email() {
	return get_theme_mod( 'flowinstal_email', 'kontakt@flowinstal.pl' );
}

/** Link WhatsApp z gotową wiadomością. */
function flowinstal_whatsapp_link() {
	$num = flowinstal_whatsapp_number();
	$msg = rawurlencode( __( 'Dzień dobry, piszę ze strony FlowInstal w sprawie wyceny instalacji.', 'flowinstal' ) );
	return 'https://wa.me/' . $num . '?text=' . $msg;
}

/* =========================================================================
 * 5. Dołączenie modułów
 * ===================================================================== */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/contact-form.php';
require get_template_directory() . '/inc/schema.php';

/* =========================================================================
 * 6. Wyłączenie zbędnych elementów (lekkość / wydajność)
 * ===================================================================== */
function flowinstal_cleanup() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	// Usuń emoji (oszczędność zapytań).
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'flowinstal_cleanup' );

/* =========================================================================
 * 7. Ikony SVG — biblioteka (zwraca <svg> jako string)
 * ===================================================================== */
function flowinstal_icon( $name, $echo = true ) {
	$icons = array(
		'phone'   => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'    => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'pin'     => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
		'clock'   => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'check'   => '<polyline points="20 6 9 17 4 12"/>',
		'check-circle' => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>',
		'arrow'   => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
		'arrow-up'=> '<line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/>',
		'star'    => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
		'plus'    => '<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>',
		'close'   => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
		'flame'   => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
		'droplet' => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>',
		'thermometer' => '<path d="M14 14.76V3.5a2.5 2.5 0 0 0-5 0v11.26a4.5 4.5 0 1 0 5 0z"/>',
		'wrench'  => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
		'tool'    => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
		'home'    => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
		'shield'  => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/>',
		'truck'   => '<path d="M10 17h4V5H2v12h3"/><path d="M20 17h2v-3.34a4 4 0 0 0-1.17-2.83L19 9h-5v8h1"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/>',
		'sparkles'=> '<path d="M12 3l1.9 4.6L18.5 9l-4.6 1.9L12 15l-1.9-4.1L5.5 9l4.6-1.4L12 3z"/><path d="M19 14l.8 2 2 .8-2 .8-.8 2-.8-2-2-.8 2-.8.8-2z"/>',
		'award'   => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>',
		'users'   => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'calendar'=> '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
		'document'=> '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>',
		'chat'    => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
		'whatsapp'=> '<path d="M17.6 6.32A7.85 7.85 0 0 0 12.05 4a7.94 7.94 0 0 0-6.9 11.9L4 20l4.2-1.1a7.9 7.9 0 0 0 3.8 1 7.94 7.94 0 0 0 5.6-13.58zM12.05 18.5a6.6 6.6 0 0 1-3.36-.92l-.24-.14-2.5.65.67-2.43-.16-.25a6.59 6.59 0 1 1 5.59 3.09zm3.62-4.93c-.2-.1-1.17-.58-1.35-.64s-.31-.1-.45.1-.51.64-.63.78-.23.15-.43.05a5.39 5.39 0 0 1-1.59-.98 6 6 0 0 1-1.1-1.37c-.11-.2 0-.3.09-.4s.2-.23.3-.35a1.34 1.34 0 0 0 .2-.33.37.37 0 0 0 0-.35c0-.1-.45-1.08-.61-1.48s-.32-.34-.45-.34h-.38a.73.73 0 0 0-.53.25 2.23 2.23 0 0 0-.69 1.65 3.86 3.86 0 0 0 .81 2.05 8.84 8.84 0 0 0 3.39 3 11.4 11.4 0 0 0 1.13.42 2.72 2.72 0 0 0 1.25.08 2.04 2.04 0 0 0 1.34-.95 1.65 1.65 0 0 0 .12-.94c-.05-.09-.18-.14-.38-.24z"/>',
		'facebook'=> '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'instagram'=> '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
		'google'  => '<path d="M12 11v2.8h3.9a3.4 3.4 0 0 1-1.5 2.2 4.2 4.2 0 0 1-2.4.7 4.5 4.5 0 0 1 0-9 4 4 0 0 1 2.9 1.1l1.9-1.9A7 7 0 0 0 12 5a7 7 0 1 0 6.9 8.1 8.5 8.5 0 0 0-.1-1.6z"/>',
		'star-filled' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
		'zap'     => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
		'gift'    => '<polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>',
		'banknote'=> '<rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/>',
		'pipe'    => '<path d="M4 8V6a2 2 0 0 1 2-2h2"/><path d="M4 12v4a2 2 0 0 0 2 2h2"/><rect x="8" y="4" width="8" height="16" rx="1"/><path d="M16 8h2a2 2 0 0 1 2 2v0"/>',
	);

	$icon  = isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['check'];
	// Atrybuty width/height="24" działają jako bezpieczny fallback rozmiaru —
	// zapobiegają "puchnięciu" ikony, gdy w danym miejscu brakuje reguły CSS.
	$svg   = '<svg class="fi-ico" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icon . '</svg>';

	// Ikony wypełniane (gwiazdki, soc-media) lepiej wyglądają z fill.
	if ( in_array( $name, array( 'star-filled', 'whatsapp', 'facebook', 'instagram', 'google' ), true ) ) {
		$svg = '<svg class="fi-ico" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">' . $icon . '</svg>';
	}

	if ( $echo ) {
		echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}
	return $svg;
}

/* =========================================================================
 * 8. Excerpt — długość i znacznik
 * ===================================================================== */
function flowinstal_excerpt_length( $length ) { return 24; }
add_filter( 'excerpt_length', 'flowinstal_excerpt_length' );

function flowinstal_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'flowinstal_excerpt_more' );

/* =========================================================================
 * 9. Awaryjne menu (gdy menu nie jest przypisane)
 * ===================================================================== */
function flowinstal_fallback_menu() {
	$items = array(
		'#uslugi'    => __( 'Oferta', 'flowinstal' ),
		'#korzysci'  => __( 'Korzyści', 'flowinstal' ),
		'#proces'    => __( 'Jak pracuję', 'flowinstal' ),
		'#o-nas'     => __( 'O mnie', 'flowinstal' ),
		'#realizacje'=> __( 'Realizacje', 'flowinstal' ),
		'#opinie'    => __( 'Opinie', 'flowinstal' ),
		'#kontakt'   => __( 'Kontakt', 'flowinstal' ),
	);
	echo '<nav class="fi-nav" id="fi-nav">';
	foreach ( $items as $href => $label ) {
		echo '<a href="' . esc_attr( $href ) . '">' . esc_html( $label ) . '</a>';
	}
	echo '<a class="fi-btn fi-btn--primary fi-nav-cta" href="#kontakt">' . esc_html__( 'Bezpłatna wycena', 'flowinstal' ) . '</a>';
	echo '</nav>';
}
