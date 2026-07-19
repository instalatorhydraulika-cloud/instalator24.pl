<?php
/**
 * Dane strukturalne (Schema.org) i meta SEO — lokalne pozycjonowanie Brzeziny.
 *
 * @package FlowInstal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Meta geo + Open Graph w <head>. */
function flowinstal_seo_meta() {
	$desc = get_bloginfo( 'description' );
	if ( empty( $desc ) ) {
		$desc = 'FlowInstal — ogrzewanie podłogowe w Brzezinach, Łodzi i okolicy. Projekt pętli, montaż, rozdzielacze, próby ciśnieniowe i rozruch. Pod pompę ciepła i kotły na pelet. Dojazd do 20 km od Brzezin.';
	}
	?>
	<meta name="description" content="<?php echo esc_attr( $desc ); ?>">
	<meta name="geo.region" content="PL-LD">
	<meta name="geo.placename" content="Brzeziny, Łódź, Stryków, Koluszki, Andrespol">
	<meta name="geo.position" content="51.802;19.751">
	<meta name="ICBM" content="51.802, 19.751">
	<meta name="robots" content="index, follow, max-image-preview:large">
	<meta property="og:type" content="business.business">
	<meta property="og:locale" content="pl_PL">
	<meta property="og:title" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
	<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
	<meta name="theme-color" content="#0f172a">
	<?php
}
add_action( 'wp_head', 'flowinstal_seo_meta', 1 );

/** JSON-LD: LocalBusiness (HVACBusiness) + obszar działania. */
function flowinstal_schema_localbusiness() {
	$phone = flowinstal_phone_display();
	$email = flowinstal_email();

	$areas = array( 'Brzeziny', 'Stryków', 'Andrespol', 'Koluszki', 'Nowosolna', 'Łódź', 'Rogów', 'Jeżów', 'Dmosin' );
	$area_served = array();
	foreach ( $areas as $a ) {
		$area_served[] = array( '@type' => 'City', 'name' => $a );
	}

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => array( 'LocalBusiness', 'HVACBusiness', 'Plumber' ),
		'@id'         => home_url( '/#business' ),
		'name'        => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
		'url'         => home_url( '/' ),
		'telephone'   => $phone,
		'email'       => $email,
		'image'       => get_template_directory_uri() . '/screenshot.png',
		'priceRange'  => '$$',
		'currenciesAccepted' => 'PLN',
		'paymentAccepted'    => 'Gotówka, Przelew',
		'founder'     => array( '@type' => 'Person', 'name' => 'Maciej Kolasa' ),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Brzeziny',
			'postalCode'      => '95-060',
			'addressRegion'   => 'łódzkie',
			'addressCountry'  => 'PL',
		),
		'geo' => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => '51.802',
			'longitude' => '19.751',
		),
		'areaServed' => $area_served,
		'serviceArea' => array(
			'@type'        => 'GeoCircle',
			'geoMidpoint'  => array( '@type' => 'GeoCoordinates', 'latitude' => '51.802', 'longitude' => '19.751' ),
			'geoRadius'    => '20000',
		),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '16:00',
				'closes'    => '21:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Saturday' ),
				'opens'     => '08:00',
				'closes'    => '18:00',
			),
		),
		'makesOffer' => array(
			flowinstal_offer( 'Montaż wodnego ogrzewania podłogowego' ),
			flowinstal_offer( 'Projekt pętli i dobór rozstawu ogrzewania podłogowego' ),
			flowinstal_offer( 'Montaż rozdzielaczy i stref grzewczych' ),
			flowinstal_offer( 'Podłączenie ogrzewania podłogowego pod pompę ciepła i kocioł na pelet' ),
			flowinstal_offer( 'Próby ciśnieniowe i rozruch instalacji grzewczej' ),
			flowinstal_offer( 'Instalacje wod-kan i zgrzewanie PP' ),
		),
		'aggregateRating' => array(
			'@type'       => 'AggregateRating',
			'ratingValue' => '5.0',
			'reviewCount' => '27',
			'bestRating'  => '5',
		),
	);

	$fb = get_theme_mod( 'flowinstal_facebook', '' );
	$ig = get_theme_mod( 'flowinstal_instagram', '' );
	$gg = get_theme_mod( 'flowinstal_google', '' );
	$same = array_filter( array( $fb, $ig, $gg ) );
	if ( ! empty( $same ) ) {
		$schema['sameAs'] = array_values( $same );
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'flowinstal_schema_localbusiness', 5 );

/** Pomocnik: oferta usługi do schematu. */
function flowinstal_offer( $name ) {
	return array(
		'@type'       => 'Offer',
		'itemOffered' => array( '@type' => 'Service', 'name' => $name ),
	);
}

/** JSON-LD: FAQPage — pytania i odpowiedzi (rich snippet w Google). */
function flowinstal_schema_faq() {
	$faqs = flowinstal_get_faqs();
	if ( empty( $faqs ) ) {
		return;
	}
	$items = array();
	foreach ( $faqs as $faq ) {
		$items[] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $faq['a'] ),
		);
	}
	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $items,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'flowinstal_schema_faq', 6 );

/** Lista FAQ (współdzielona przez sekcję FAQ i schemat). */
function flowinstal_get_faqs() {
	return array(
		array(
			'q' => 'Czy ogrzewanie podłogowe ogrzeje cały dom?',
			'a' => 'Tak. Dobrze zaprojektowana podłogówka z powodzeniem ogrzewa cały dom — pod warunkiem właściwego doboru rozstawu pętli, izolacji i źródła ciepła. Przy odpowiednim projekcie nie potrzebujesz grzejników, nawet w łazience czy sypialniach.',
		),
		array(
			'q' => 'Podłogówka współpracuje z pompą ciepła?',
			'a' => 'To wręcz najlepszy duet. Ogrzewanie podłogowe pracuje na niskiej temperaturze zasilania (35–45°C), dzięki czemu pompa ciepła osiąga wysoką efektywność (COP) i niskie rachunki. Spinam podłogówkę zarówno z pompą ciepła, jak i z kotłem na pelet.',
		),
		array(
			'q' => 'Jaki rozstaw rur i jaka temperatura będzie u mnie?',
			'a' => 'Rozstaw pętli (najczęściej 10–20 cm) i długości obiegów dobieram indywidualnie pod pomieszczenie i zapotrzebowanie na ciepło. W strefach brzegowych i łazienkach zagęszczam pętle. Wszystko liczę na etapie projektu — nie układam „na oko".',
		),
		array(
			'q' => 'Czy podłogówka pasuje pod płytki, panele i deskę?',
			'a' => 'Tak — trzeba tylko dobrać wykończenie z odpowiednim oporem cieplnym. Najlepiej przewodzą płytki, ale są też panele i deski dedykowane do ogrzewania podłogowego. Doradzę, co sprawdzi się w Twoim domu.',
		),
		array(
			'q' => 'Jak wygląda wycena ogrzewania podłogowego?',
			'a' => 'Wycena jest bezpłatna i przygotowuję ją zawsze po wizji lokalnej — bez cenników „z sufitu". Dopiero po obejrzeniu budowy, sprawdzeniu metrażu i źródła ciepła mogę podać rzetelny, wiążący kosztorys z podziałem na robociznę i materiał.',
		),
		array(
			'q' => 'Pracuję w tygodniu — czy dopasujesz się do mojego grafiku?',
			'a' => 'Tak. Wizję lokalną, wycenę i montaż realizuję w elastycznych terminach: popołudniami w dni robocze (zwykle od 16:00) oraz w soboty. To idealne rozwiązanie dla klientów indywidualnych pracujących na etacie.',
		),
		array(
			'q' => 'Czy dajesz gwarancję szczelności?',
			'a' => 'Każdą instalację poddaję próbie ciśnieniowej przed wylewką i po niej, a Ty otrzymujesz protokół. To pewność, że pod posadzką nie czeka Cię żadna niespodzianka. Rozliczenia są transparentne, a wszystkie ustalenia potwierdzam wcześniej.',
		),
	);
}
