<?php
/**
 * Sekcja oferty — zakres usług skupiony wokół ogrzewania podłogowego.
 *
 * @package FlowInstal
 */
$services = array(
	array(
		'icon'  => 'thermometer',
		'title' => __( 'Ogrzewanie podłogowe wodne', 'flowinstal' ),
		'desc'  => __( 'Kompleksowy montaż od podstaw: izolacja, folia, układanie i mocowanie pętli, obróbki dylatacyjne.', 'flowinstal' ),
		'list'  => array( __( 'Projekt i dobór rozstawu pętli', 'flowinstal' ), __( 'Układanie rur PE-RT / PE-Xa', 'flowinstal' ), __( 'Izolacja i taśmy brzegowe', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'tool',
		'title' => __( 'Rozdzielacze i strefy grzewcze', 'flowinstal' ),
		'desc'  => __( 'Montaż rozdzielaczy, szafek podtynkowych i podział domu na strefy z osobną regulacją.', 'flowinstal' ),
		'list'  => array( __( 'Rozdzielacze z przepływomierzami', 'flowinstal' ), __( 'Szafki podtynkowe i natynkowe', 'flowinstal' ), __( 'Równoważenie obiegów', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'zap',
		'title' => __( 'Podłączenie źródła ciepła', 'flowinstal' ),
		'desc'  => __( 'Spięcie podłogówki z pompą ciepła lub kotłem na pelet — bufor, mieszacze, grupa pompowa.', 'flowinstal' ),
		'list'  => array( __( 'Pompa ciepła i kotły na pelet', 'flowinstal' ), __( 'Grupy mieszające i bufory', 'flowinstal' ), __( 'Automatyka i termostaty', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'droplet',
		'title' => __( 'Wod-kan i instalacje uzupełniające', 'flowinstal' ),
		'desc'  => __( 'Budujesz dom? Wykonam też instalację wodno-kanalizacyjną, zgrzewanie PP i przyłącza.', 'flowinstal' ),
		'list'  => array( __( 'Instalacje wod-kan w budynkach', 'flowinstal' ), __( 'Zgrzewanie rur PP', 'flowinstal' ), __( 'Przyłącza i oczyszczalnie', 'flowinstal' ) ),
	),
);
?>
<section class="fi-section fi-section--alt" id="uslugi">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'wrench' ); ?><?php esc_html_e( 'Zakres usług', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Ogrzewanie podłogowe — kompleksowo', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Specjalizuję się w wodnym ogrzewaniu podłogowym: od projektu pętli, przez montaż, po rozruch. Uzupełniająco wykonuję instalacje wod-kan. Działam w Brzezinach i w promieniu 20 km.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-services-grid">
			<?php foreach ( $services as $s ) : ?>
				<article class="fi-service-card fi-reveal">
					<div class="fi-service-ico"><?php flowinstal_icon( $s['icon'] ); ?></div>
					<h3><?php echo esc_html( $s['title'] ); ?></h3>
					<p><?php echo esc_html( $s['desc'] ); ?></p>
					<ul class="fi-service-list">
						<?php foreach ( $s['list'] as $li ) : ?>
							<li><?php flowinstal_icon( 'check' ); ?><span><?php echo esc_html( $li ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<a class="fi-service-link" href="#kontakt"><?php esc_html_e( 'Zapytaj o wycenę', 'flowinstal' ); ?><?php flowinstal_icon( 'arrow' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
