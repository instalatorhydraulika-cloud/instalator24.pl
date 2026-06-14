<?php
/**
 * Sekcja "Dlaczego ja" — unikalna propozycja sprzedaży (USP).
 *
 * @package FlowInstal
 */
$points = array(
	array(
		'icon'  => 'calendar',
		'title' => __( 'Elastyczny czas pracy', 'flowinstal' ),
		'desc'  => __( 'Pracujesz w tygodniu? Rozumiem to. Pomiary, wyceny oraz realizacje dopasowuję do Twojego grafiku — popołudnia oraz soboty.', 'flowinstal' ),
	),
	array(
		'icon'  => 'truck',
		'title' => __( 'Materiał i sprzęt bez stresu', 'flowinstal' ),
		'desc'  => __( 'Współpracuję z zaufaną hurtownią. Dostarczam sprawdzony materiał najwyższej jakości z rabatami wykonawczymi i mam pełne zaplecze profesjonalnych narzędzi.', 'flowinstal' ),
	),
	array(
		'icon'  => 'sparkles',
		'title' => __( 'Czystość i słowność', 'flowinstal' ),
		'desc'  => __( 'Zawsze zjawiam się o ustalonej godzinie. Dbam o porządek w miejscu pracy i zostawiam pomieszczenia posprzątane po montażu.', 'flowinstal' ),
	),
);
?>
<section class="fi-section fi-section--dark" id="dlaczego">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'award' ); ?><?php esc_html_e( 'Przewaga', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Dlaczego warto wybrać FlowInstal?', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Rozmawiasz bezpośrednio z wykonawcą — bez pośredników, bez ukrytych kosztów, z pełną odpowiedzialnością za jakość.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-why-grid">
			<?php $i = 1; foreach ( $points as $p ) : ?>
				<article class="fi-why-card fi-reveal">
					<span class="fi-why-num"><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="fi-why-ico"><?php flowinstal_icon( $p['icon'] ); ?></div>
					<h3><?php echo esc_html( $p['title'] ); ?></h3>
					<p><?php echo esc_html( $p['desc'] ); ?></p>
				</article>
			<?php $i++; endforeach; ?>
		</div>
	</div>
</section>
