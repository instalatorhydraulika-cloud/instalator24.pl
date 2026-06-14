<?php
/**
 * Sekcja cennika orientacyjnego — transparentność buduje zaufanie i kwalifikuje leady.
 *
 * @package FlowInstal
 */
$plans = array(
	array(
		'title'    => __( 'Drobne usługi i naprawy', 'flowinstal' ),
		'desc'     => __( 'Szybkie interwencje i pojedyncze prace', 'flowinstal' ),
		'amount'   => '120',
		'unit'     => __( 'zł / godz.', 'flowinstal' ),
		'from'     => __( 'wycena z góry, bez niespodzianek', 'flowinstal' ),
		'featured' => false,
		'list'     => array(
			__( 'Wymiana baterii, syfonów, zaworów', 'flowinstal' ),
			__( 'Usuwanie przecieków', 'flowinstal' ),
			__( 'Podłączenie pralki / zmywarki', 'flowinstal' ),
			__( 'Drobne modernizacje', 'flowinstal' ),
		),
	),
	array(
		'title'    => __( 'Instalacje — wycena indywidualna', 'flowinstal' ),
		'desc'     => __( 'Kompleksowe realizacje od podstaw', 'flowinstal' ),
		'amount'   => __( 'Wycena', 'flowinstal' ),
		'unit'     => '',
		'from'     => __( 'bezpłatny kosztorys po pomiarze', 'flowinstal' ),
		'featured' => true,
		'list'     => array(
			__( 'Ogrzewanie podłogowe (m² pętli)', 'flowinstal' ),
			__( 'Pełna instalacja wod-kan', 'flowinstal' ),
			__( 'Montaż kotłowni na pelet', 'flowinstal' ),
			__( 'Materiał z rabatem hurtowym', 'flowinstal' ),
			__( 'Próby ciśnieniowe i rozruch', 'flowinstal' ),
		),
	),
	array(
		'title'    => __( 'Oczyszczalnie i przyłącza', 'flowinstal' ),
		'desc'     => __( 'Instalacje zewnętrzne i przydomowe', 'flowinstal' ),
		'amount'   => __( 'Wycena', 'flowinstal' ),
		'unit'     => '',
		'from'     => __( 'po oględzinach działki', 'flowinstal' ),
		'featured' => false,
		'list'     => array(
			__( 'Przydomowa oczyszczalnia ścieków', 'flowinstal' ),
			__( 'Przyłącze wodociągowe', 'flowinstal' ),
			__( 'Instalacje zewnętrzne', 'flowinstal' ),
			__( 'Doradztwo w doborze rozwiązań', 'flowinstal' ),
		),
	),
);
?>
<section class="fi-section fi-section--alt" id="cennik">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'banknote' ); ?><?php esc_html_e( 'Przejrzyste ceny', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Cennik orientacyjny', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Żadnych ukrytych kosztów. Ostateczną cenę poznajesz przed rozpoczęciem prac — w formie czytelnego kosztorysu.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-pricing">
			<?php foreach ( $plans as $plan ) : ?>
				<article class="fi-price-card fi-reveal<?php echo $plan['featured'] ? ' is-featured' : ''; ?>">
					<?php if ( $plan['featured'] ) : ?><span class="fi-price-popular"><?php esc_html_e( 'Najczęściej wybierane', 'flowinstal' ); ?></span><?php endif; ?>
					<h3><?php echo esc_html( $plan['title'] ); ?></h3>
					<p><?php echo esc_html( $plan['desc'] ); ?></p>
					<div class="fi-price-amount"><?php echo esc_html( $plan['amount'] ); ?> <small><?php echo esc_html( $plan['unit'] ); ?></small></div>
					<div class="fi-price-from"><?php echo esc_html( $plan['from'] ); ?></div>
					<ul class="fi-price-list">
						<?php foreach ( $plan['list'] as $li ) : ?>
							<li><?php flowinstal_icon( 'check' ); ?><span><?php echo esc_html( $li ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<a class="fi-btn <?php echo $plan['featured'] ? 'fi-btn--primary' : 'fi-btn--outline'; ?> fi-btn--block" href="#kontakt"><?php esc_html_e( 'Zapytaj o wycenę', 'flowinstal' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="fi-pricing-note"><?php flowinstal_icon( 'shield' ); ?> <?php esc_html_e( 'Ceny mają charakter orientacyjny. Dojazd na terenie powiatu brzezińskiego jest bezpłatny.', 'flowinstal' ); ?></p>
	</div>
</section>
