<?php
/**
 * Sekcja opinii — social proof (fokus: ogrzewanie podłogowe).
 *
 * @package FlowInstal
 */
$reviews = array(
	array(
		'text' => __( 'Pan Maciej robił nam ogrzewanie podłogowe w całym domu pod Brzezinami. Wszystko policzone, pętle równiutkie, próba ciśnieniowa z protokołem. Podłoga grzeje idealnie, rachunki z pompą ciepła bardzo niskie. Polecam!', 'flowinstal' ),
		'name' => __( 'Tomasz W.', 'flowinstal' ),
		'loc'  => __( 'Brzeziny', 'flowinstal' ),
		'src'  => 'google',
	),
	array(
		'text' => __( 'Podłogówka w parterze plus rozdzielacz z podziałem na strefy. Konkret, fachowe podejście i porządek po pracy. Dojazd na Widzew bez problemu, terminy popołudniowe — dla mnie idealnie.', 'flowinstal' ),
		'name' => __( 'Agnieszka K.', 'flowinstal' ),
		'loc'  => __( 'Łódź Widzew', 'flowinstal' ),
		'src'  => 'facebook',
	),
	array(
		'text' => __( 'Kompleksowo: ułożenie pętli, rozdzielacze i spięcie z pompą ciepła. Wszystko wyjaśnione, materiał dobrej jakości z hurtowni, wycena po obejrzeniu budowy. Ciepła podłoga w całym domu — super komfort.', 'flowinstal' ),
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
