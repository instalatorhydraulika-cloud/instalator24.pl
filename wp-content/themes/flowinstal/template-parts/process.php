<?php
/**
 * Sekcja "Jak pracuję" — proces montażu ogrzewania podłogowego w 4 krokach.
 *
 * @package FlowInstal
 */
$steps = array(
	array( __( 'Kontakt i wizja lokalna', 'flowinstal' ), __( 'Dzwonisz lub zostawiasz zgłoszenie. Umawiam się na oględziny — także po godzinach — i sprawdzam stan surowy oraz źródło ciepła.', 'flowinstal' ) ),
	array( __( 'Projekt pętli i wycena', 'flowinstal' ), __( 'Dobieram rozstaw i strefy, liczę długości obiegów i przygotowuję przejrzystą, bezpłatną wycenę. Wycena zawsze po wizji lokalnej — bez cenników „z sufitu".', 'flowinstal' ) ),
	array( __( 'Montaż podłogówki', 'flowinstal' ), __( 'Układam izolację, folię i pętle, montuję rozdzielacze i spinam ze źródłem ciepła. Materiał dostarczam z rabatem hurtowym.', 'flowinstal' ) ),
	array( __( 'Próby, rozruch i protokół', 'flowinstal' ), __( 'Napełniam instalację, wykonuję próbę ciśnieniową i rozruch, równoważę obiegi. Otrzymujesz dokumentację i sprawną instalację.', 'flowinstal' ) ),
);
?>
<section class="fi-section fi-section--alt" id="proces">
	<div class="fi-container">
		<div class="fi-section-head fi-reveal">
			<span class="fi-eyebrow"><?php flowinstal_icon( 'document' ); ?><?php esc_html_e( 'Współpraca krok po kroku', 'flowinstal' ); ?></span>
			<h2><?php esc_html_e( 'Jak wygląda montaż podłogówki?', 'flowinstal' ); ?></h2>
			<p><?php esc_html_e( 'Prosty, przewidywalny proces — wiesz dokładnie, czego się spodziewać na każdym etapie, od pierwszego telefonu po odbiór.', 'flowinstal' ); ?></p>
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
