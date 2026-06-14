<?php
/**
 * Sekcja opinii — social proof z gwiazdkami.
 *
 * @package FlowInstal
 */
$reviews = array(
	array(
		'text' => __( 'Pan Maciej robił nam ogrzewanie podłogowe w nowym domu pod Brzezinami. Wszystko dopięte na ostatni guzik, po pracy posprzątane. Polecam każdemu, kto ceni porządek i terminowość.', 'flowinstal' ),
		'name' => __( 'Tomasz W.', 'flowinstal' ),
		'loc'  => __( 'Brzeziny', 'flowinstal' ),
		'src'  => 'google',
	),
	array(
		'text' => __( 'Wymiana całej instalacji wod-kan w remontowanym mieszkaniu. Konkret, fachowe podejście i uczciwa cena. Dojazd na Widzew bez problemu, terminy popołudniowe — dla mnie idealnie.', 'flowinstal' ),
		'name' => __( 'Agnieszka K.', 'flowinstal' ),
		'loc'  => __( 'Łódź Widzew', 'flowinstal' ),
		'src'  => 'facebook',
	),
	array(
		'text' => __( 'Montaż kotła na pelet i podłączenie kotłowni. Wszystko wyjaśnione, materiał dobrej jakości z hurtowni, bez żadnych przedpłat. Kotłownia wygląda jak z katalogu. Polecam!', 'flowinstal' ),
		'name' => __( 'Marek S.', 'flowinstal' ),
		'loc'  => __( 'Stryków', 'flowinstal' ),
		'src'  => 'google',
	),
);
?>
<section class="fi-section" id="opinie">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'star' ); ?><?php esc_html_e( 'Opinie klientów', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Zaufali mi mieszkańcy okolicy', 'flowinstal' ); ?></h2>
			<div class="fi-reviews-head">
				<span class="fi-stars">
					<?php for ( $i = 0; $i < 5; $i++ ) { flowinstal_icon( 'star-filled' ); } ?>
				</span>
				<span class="fi-reviews-rating"><?php esc_html_e( '5,0 / 5,0 — na podstawie opinii klientów', 'flowinstal' ); ?></span>
			</div>
		</div>

		<div class="fi-reviews">
			<?php foreach ( $reviews as $r ) : ?>
				<article class="fi-review fi-reveal">
					<span class="fi-stars">
						<?php for ( $i = 0; $i < 5; $i++ ) { flowinstal_icon( 'star-filled' ); } ?>
					</span>
					<p class="fi-review-text">„<?php echo esc_html( $r['text'] ); ?>”</p>
					<div class="fi-review-author">
						<span class="fi-review-avatar"><?php echo esc_html( mb_substr( $r['name'], 0, 1 ) ); ?></span>
						<div>
							<strong><?php echo esc_html( $r['name'] ); ?></strong>
							<span><?php flowinstal_icon( 'pin' ); ?> <?php echo esc_html( $r['loc'] ); ?></span>
						</div>
						<span class="fi-review-source"><?php flowinstal_icon( $r['src'] ); ?></span>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
