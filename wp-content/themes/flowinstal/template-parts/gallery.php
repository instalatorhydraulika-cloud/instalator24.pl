<?php
/**
 * Sekcja realizacji — galeria prac przy ogrzewaniu podłogowym.
 *
 * @package FlowInstal
 */
$items = array(
	array( 'tag' => __( 'Pętle', 'flowinstal' ), 'title' => __( 'Ogrzewanie podłogowe — dom 140 m²', 'flowinstal' ), 'loc' => __( 'Brzeziny', 'flowinstal' ) ),
	array( 'tag' => __( 'Rozdzielacz', 'flowinstal' ), 'title' => __( 'Rozdzielacz 9-obiegowy z przepływomierzami', 'flowinstal' ), 'loc' => __( 'Stryków', 'flowinstal' ) ),
	array( 'tag' => __( 'Pompa ciepła', 'flowinstal' ), 'title' => __( 'Podłogówka spięta z pompą ciepła', 'flowinstal' ), 'loc' => __( 'Nowosolna', 'flowinstal' ) ),
	array( 'tag' => __( 'Izolacja', 'flowinstal' ), 'title' => __( 'Ułożona izolacja i folia pod pętle', 'flowinstal' ), 'loc' => __( 'Koluszki', 'flowinstal' ) ),
	array( 'tag' => __( 'Próba', 'flowinstal' ), 'title' => __( 'Próba ciśnieniowa przed wylewką', 'flowinstal' ), 'loc' => __( 'Andrespol', 'flowinstal' ) ),
	array( 'tag' => __( 'Łazienka', 'flowinstal' ), 'title' => __( 'Strefa łazienki — gęsty rozstaw pętli', 'flowinstal' ), 'loc' => __( 'Łódź Widzew', 'flowinstal' ) ),
);
?>
<section class="fi-section fi-section--alt" id="realizacje">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'sparkles' ); ?><?php esc_html_e( 'Nasze prace', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Realizacje ogrzewania podłogowego', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Równe pętle, estetyczne rozdzielacze i porządek na budowie. Tak wygląda praca, za którą biorę pełną odpowiedzialność.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-gallery">
			<?php foreach ( $items as $it ) : ?>
				<figure class="fi-gallery-item fi-reveal">
					<div class="fi-gallery-ph"><?php flowinstal_icon( 'thermometer' ); ?></div>
					<span class="fi-gallery-tag"><?php echo esc_html( $it['tag'] ); ?></span>
					<figcaption class="fi-gallery-cap">
						<strong><?php echo esc_html( $it['title'] ); ?></strong>
						<span><?php flowinstal_icon( 'pin' ); ?> <?php echo esc_html( $it['loc'] ); ?></span>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>

		<div style="text-align:center;margin-top:38px" class="fi-reveal">
			<?php
			$gg = get_theme_mod( 'flowinstal_google', '' );
			$fb = get_theme_mod( 'flowinstal_facebook', '' );
			$link = $fb ? $fb : ( $gg ? $gg : '#kontakt' );
			?>
			<a class="fi-btn fi-btn--outline fi-btn--lg" href="<?php echo esc_url( $link ); ?>"<?php echo ( '#kontakt' !== $link ) ? ' target="_blank" rel="noopener"' : ''; ?>>
				<?php flowinstal_icon( 'sparkles' ); ?><?php esc_html_e( 'Więcej zdjęć na profilu', 'flowinstal' ); ?>
			</a>
		</div>
	</div>
</section>
