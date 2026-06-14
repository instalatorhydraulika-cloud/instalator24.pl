<?php
/**
 * Sekcja statystyk — animowane liczniki budujące zaufanie.
 *
 * @package FlowInstal
 */
$stats = array(
	array( '4', '', __( 'lata doświadczenia', 'flowinstal' ) ),
	array( '250', '+', __( 'połączonych instalacji', 'flowinstal' ) ),
	array( '20', ' km', __( 'zasięg od Brzezin', 'flowinstal' ) ),
	array( '100', '%', __( 'zadowolonych klientów', 'flowinstal' ) ),
);
?>
<section class="fi-section" style="padding-top:clamp(40px,6vw,72px);padding-bottom:clamp(40px,6vw,72px)">
	<div class="fi-container">
		<div class="fi-stats">
			<?php foreach ( $stats as $st ) : ?>
				<div class="fi-stat fi-reveal">
					<div class="fi-stat-num" data-count="<?php echo esc_attr( $st[0] ); ?>"><?php echo esc_html( $st[0] ); ?><span><?php echo esc_html( $st[1] ); ?></span></div>
					<div class="fi-stat-label"><?php echo esc_html( $st[2] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
