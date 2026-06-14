<?php
/**
 * Sekcja obszaru działania — mocny sygnał lokalnego SEO + mapa Google.
 *
 * @package FlowInstal
 */
$cities = array(
	__( 'Brzeziny', 'flowinstal' ),
	__( 'Stryków', 'flowinstal' ),
	__( 'Andrespol', 'flowinstal' ),
	__( 'Koluszki', 'flowinstal' ),
	__( 'Nowosolna', 'flowinstal' ),
	__( 'Łódź Widzew', 'flowinstal' ),
	__( 'Rogów', 'flowinstal' ),
	__( 'Jeżów', 'flowinstal' ),
	__( 'Dmosin', 'flowinstal' ),
	__( 'Kołacin', 'flowinstal' ),
);
$map = get_theme_mod( 'flowinstal_map_embed', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d39000!2d19.75!3d51.80!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471bcb!2sBrzeziny!5e0!3m2!1spl!2spl!4v1700000000000' );
?>
<section class="fi-section" id="obszar">
	<div class="fi-container">
		<div class="fi-area">
			<div class="fi-reveal">
				<span class="fi-eyebrow"><?php flowinstal_icon( 'pin' ); ?><?php esc_html_e( 'Obszar działania', 'flowinstal' ); ?></span>
				<h2><?php esc_html_e( 'Brzeziny i okolice w promieniu 20 km', 'flowinstal' ); ?></h2>
				<p><?php esc_html_e( 'Działam lokalnie, dlatego dojeżdżam szybko i nie doliczam wysokich kosztów transportu. Realizuję zlecenia m.in. w miejscowościach:', 'flowinstal' ); ?></p>
				<ul class="fi-area-list">
					<?php foreach ( $cities as $c ) : ?>
						<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php echo esc_html( $c ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<div class="fi-area-highlight"><?php flowinstal_icon( 'truck' ); ?><span><?php esc_html_e( 'Dojazd na terenie powiatu brzezińskiego — bezpłatny!', 'flowinstal' ); ?></span></div>
			</div>

			<div class="fi-area-map fi-reveal">
				<iframe src="<?php echo esc_url( $map ); ?>" title="<?php esc_attr_e( 'Mapa obszaru działania FlowInstal — Brzeziny i okolice', 'flowinstal' ); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</div>
</section>
