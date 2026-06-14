<?php
/**
 * Sekcja "Jak pracuję" — proces współpracy w 4 krokach (redukcja niepewności).
 *
 * @package FlowInstal
 */
$steps = array(
	array( __( 'Kontakt i rozmowa', 'flowinstal' ), __( 'Dzwonisz lub zostawiasz zgłoszenie. Wstępnie omawiamy zakres i termin — także po godzinach.', 'flowinstal' ) ),
	array( __( 'Pomiar i wycena', 'flowinstal' ), __( 'Przyjeżdżam na oględziny (popołudniu lub w sobotę) i przygotowuję przejrzysty, bezpłatny kosztorys.', 'flowinstal' ) ),
	array( __( 'Realizacja', 'flowinstal' ), __( 'Dostarczam materiał z rabatem i wykonuję montaż zgodnie ze sztuką — czysto i terminowo.', 'flowinstal' ) ),
	array( __( 'Odbiór i gwarancja', 'flowinstal' ), __( 'Robimy próby i rozruch, sprzątam po sobie, a Ty odbierasz sprawną instalację z dokumentem.', 'flowinstal' ) ),
);
?>
<section class="fi-section fi-section--alt" id="proces">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'document' ); ?><?php esc_html_e( 'Współpraca krok po kroku', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Jak wygląda współpraca?', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Prosty, przewidywalny proces — wiesz dokładnie, czego się spodziewać na każdym etapie.', 'flowinstal' ); ?></p>
		</div>

		<div class="fi-steps">
			<?php $n = 1; foreach ( $steps as $step ) : ?>
				<div class="fi-step fi-reveal">
					<div class="fi-step-num"><?php echo esc_html( $n ); ?></div>
					<h3><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</div>
			<?php $n++; endforeach; ?>
		</div>
	</div>
</section>
