<?php
/**
 * Sekcja korzyści ogrzewania podłogowego — edukacja i budowanie pożądania.
 *
 * @package FlowInstal
 */
$benefits = array(
	array( 'thermometer', __( 'Komfort cieplny', 'flowinstal' ), __( 'Równomierne ciepło rozchodzące się od podłogi w górę — bez zimnych stref i przeciągów. Najbardziej naturalny rozkład temperatury w domu.', 'flowinstal' ) ),
	array( 'banknote', __( 'Niższe rachunki', 'flowinstal' ), __( 'Niska temperatura zasilania (35–45°C) to realne oszczędności — zwłaszcza w parze z pompą ciepła. Ciepło trzyma się dłużej po wyłączeniu.', 'flowinstal' ) ),
	array( 'zap', __( 'Idealne pod pompę ciepła', 'flowinstal' ), __( 'Ogrzewanie podłogowe pracuje na niskich parametrach, więc pompa ciepła osiąga najwyższą efektywność (COP). To najlepszy duet dla nowego domu.', 'flowinstal' ) ),
	array( 'home', __( 'Więcej miejsca i estetyki', 'flowinstal' ), __( 'Żadnych grzejników na ścianach — pełna swoboda aranżacji wnętrza i ustawienia mebli. Instalacja jest całkowicie niewidoczna.', 'flowinstal' ) ),
	array( 'droplet', __( 'Zdrowszy mikroklimat', 'flowinstal' ), __( 'Mniejszy ruch powietrza to mniej unoszonego kurzu i roztoczy. Docenią to zwłaszcza alergicy oraz rodziny z małymi dziećmi.', 'flowinstal' ) ),
	array( 'sparkles', __( 'Ciepła podłoga pod stopami', 'flowinstal' ), __( 'Przyjemne ciepło płytek i paneli przez cały sezon, a łazienka szybciej schnie. Komfort, który czuć każdego dnia.', 'flowinstal' ) ),
);
?>
<section class="fi-section" id="korzysci">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'sparkles' ); ?><?php esc_html_e( 'Dlaczego podłogówka', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Korzyści ogrzewania podłogowego', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'To dziś standard w nowych domach — komfort, oszczędność i estetyka w jednym. Dobrze zaprojektowana i ułożona podłogówka służy bezawaryjnie przez dekady.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-benefits">
			<?php foreach ( $benefits as $b ) : ?>
				<article class="fi-benefit fi-reveal">
					<div class="fi-benefit-ico"><?php flowinstal_icon( $b[0] ); ?></div>
					<div>
						<h3><?php echo esc_html( $b[1] ); ?></h3>
						<p><?php echo esc_html( $b[2] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
