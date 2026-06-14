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
		$desc = 'FlowInstal — instalator z Brzezin. Ogrzewanie podłogowe, kotłownie na pelet, instalacje wod-kan, przydomowe oczyszczalnie ścieków. Brzeziny, Łódź i okolice (20 km).';
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
			flowinstal_offer( 'Montaż ogrzewania podłogowego' ),
			flowinstal_offer( 'Montaż i modernizacja kotłowni na pelet i ekogroszek' ),
			flowinstal_offer( 'Instalacje wod-kan i zgrzewanie PP' ),
			flowinstal_offer( 'Montaż przydomowych oczyszczalni ścieków' ),
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
			'q' => 'Na jakim obszarze realizujesz zlecenia?',
			'a' => 'Działam w Brzezinach (95-060) oraz w promieniu do 20 km — m.in. Stryków, Andrespol, Koluszki, Nowosolna, Rogów, Jeżów oraz wschodnia część Łodzi (Widzew). Na terenie powiatu brzezińskiego dojazd jest bezpłatny.',
		),
		array(
			'q' => 'Pracuję w tygodniu — czy dopasujesz się do mojego grafiku?',
			'a' => 'Tak. Pomiary, wyceny i montaże realizuję w elastycznych terminach: popołudniami w dni robocze (zwykle od 16:00) oraz w soboty. To idealne rozwiązanie dla klientów indywidualnych, którzy pracują na etacie.',
		),
		array(
			'q' => 'Czy muszę sam kupować materiały?',
			'a' => 'Nie musisz. Współpracuję z zaufaną lokalną hurtownią, dzięki czemu dostarczam sprawdzony materiał wysokiej jakości z rabatami wykonawczymi — bez konieczności przedpłat z Twojej strony. Posiadam też własne, profesjonalne narzędzia.',
		),
		array(
			'q' => 'Ile kosztuje wycena?',
			'a' => 'Wycena jest całkowicie bezpłatna i niezobowiązująca. Po krótkiej rozmowie telefonicznej lub oględzinach na miejscu przygotowuję przejrzysty kosztorys z podziałem na robociznę i materiał.',
		),
		array(
			'q' => 'Jakich instalacji nie wykonujesz?',
			'a' => 'Do czasu uzyskania uprawnień gazowych (SEP E i D) nie podejmuję się instalacji gazowych. Skupiam się na instalacjach wod-kan, ogrzewaniu podłogowym, kotłach na paliwa stałe (pelet, ekogroszek) oraz przydomowych oczyszczalniach ścieków.',
		),
		array(
			'q' => 'Czy wystawiasz dokument potwierdzający wykonanie usługi?',
			'a' => 'Tak. Rozliczenia są transparentne, a po zakończeniu prac otrzymujesz dokument potwierdzający wykonanie usługi. Wszystkie ustalenia potwierdzam wcześniej na piśmie/SMS.',
		),
	);
}
