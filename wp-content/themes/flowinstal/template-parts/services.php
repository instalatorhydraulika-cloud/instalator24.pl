<?php
/**
 * Sekcja oferty — siatka usług.
 *
 * @package FlowInstal
 */
$services = array(
	array(
		'icon'  => 'thermometer',
		'title' => __( 'Ogrzewanie podłogowe', 'flowinstal' ),
		'desc'  => __( 'Profesjonalne projektowanie i układanie pętli podłogowych, montaż rozdzielaczy i próby ciśnieniowe.', 'flowinstal' ),
		'list'  => array( __( 'Rozplanowanie i układanie pętli', 'flowinstal' ), __( 'Montaż rozdzielaczy i szafek', 'flowinstal' ), __( 'Próby ciśnieniowe i rozruch', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'flame',
		'title' => __( 'Kotłownie i technika grzewcza', 'flowinstal' ),
		'desc'  => __( 'Montaż i modernizacja kotłów na pelet oraz ekogroszek — zgodnie ze sztuką instalatorską.', 'flowinstal' ),
		'list'  => array( __( 'Kotły na pelet i ekogroszek', 'flowinstal' ), __( 'Modernizacja starych kotłowni', 'flowinstal' ), __( 'Podłączenia bezawaryjne', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'droplet',
		'title' => __( 'Instalacje wod-kan', 'flowinstal' ),
		'desc'  => __( 'Kompleksowe wykonawstwo instalacji wodno-kanalizacyjnych, modernizacje pionów i zgrzewanie PP.', 'flowinstal' ),
		'list'  => array( __( 'Nowe instalacje w budynkach', 'flowinstal' ), __( 'Wymiana pionów i podejść', 'flowinstal' ), __( 'Zgrzewanie rur PP', 'flowinstal' ) ),
	),
	array(
		'icon'  => 'home',
		'title' => __( 'Oczyszczalnie i przyłącza', 'flowinstal' ),
		'desc'  => __( 'Montaż przydomowych oczyszczalni ścieków, przyłączy wodociągowych i instalacji zewnętrznych.', 'flowinstal' ),
		'list'  => array( __( 'Przydomowe oczyszczalnie', 'flowinstal' ), __( 'Przyłącza wodociągowe', 'flowinstal' ), __( 'Instalacje zewnętrzne', 'flowinstal' ) ),
	),
);
?>
<section class="fi-section fi-section--alt" id="uslugi">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'wrench' ); ?><?php esc_html_e( 'Zakres usług', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Kompleksowe usługi instalatorskie', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Działam lokalnie — w Brzezinach i w promieniu 20 km. Od pojedynczej usterki po pełną instalację w domu w stanie surowym.', 'flowinstal' ); ?></p>
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
