<?php
/**
 * Pasek zaufania pod hero — szybkie sygnały budujące wiarygodność.
 *
 * @package FlowInstal
 */
$items = array(
	array( 'check-circle', __( 'Materiał z rabatem hurtowym', 'flowinstal' ) ),
	array( 'shield', __( 'Bez przedpłat za materiał', 'flowinstal' ) ),
	array( 'sparkles', __( 'Czystość i porządek po pracy', 'flowinstal' ) ),
	array( 'clock', __( 'Punktualność i słowność', 'flowinstal' ) ),
	array( 'banknote', __( 'Transparentne rozliczenia', 'flowinstal' ) ),
);
?>
<div class="fi-trustbar">
	<div class="fi-container">
		<?php foreach ( $items as $it ) : ?>
			<div class="fi-trustbar-item"><?php flowinstal_icon( $it[0] ); ?><span><?php echo esc_html( $it[1] ); ?></span></div>
		<?php endforeach; ?>
	</div>
</div>
