<?php
/**
 * Sekcja "Dlaczego ja" — USP w kontekście ogrzewania podłogowego.
 *
 * @package FlowInstal
 */
$points = array(
	array(
		'icon'  => 'document',
		'title' => __( 'Projekt, nie „na oko"', 'flowinstal' ),
		'desc'  => __( 'Dobieram rozstaw pętli, długości obiegów i strefy pod konkretne pomieszczenia. Dobrze policzona podłogówka grzeje równomiernie i tanio — bez zimnych miejsc i przegrzewania.', 'flowinstal' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'Szczelność z protokołem', 'flowinstal' ),
		'desc'  => __( 'Każdą instalację poddaję próbie ciśnieniowej przed wylewką i po niej. Otrzymujesz protokół — pewność, że pod posadzką nie czeka Cię żadna niespodzianka.', 'flowinstal' ),
	),
	array(
		'icon'  => 'calendar',
		'title' => __( 'Elastyczny czas pracy', 'flowinstal' ),
		'desc'  => __( 'Pracujesz w tygodniu? Rozumiem to. Wizję lokalną, wycenę i montaż dopasowuję do Twojego grafiku — popołudnia oraz soboty. Materiał dostarczam z rabatem hurtowym.', 'flowinstal' ),
	),
);
?>
<section class="fi-section fi-section--dark" id="dlaczego">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'award' ); ?><?php esc_html_e( 'Przewaga', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Dlaczego warto wybrać FlowInstal?', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Rozmawiasz bezpośrednio z wykonawcą — bez pośredników i ukrytych kosztów. Podłogówka to instalacja na dekady, dlatego liczy się precyzja na każdym etapie.', 'flowinstal' ); ?></p>
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
