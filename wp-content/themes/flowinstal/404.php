<?php
/**
 * Szablon błędu 404.
 *
 * @package FlowInstal
 */
get_header();
?>
<div class="fi-container">
	<div class="fi-404">
		<div class="fi-404-num">404</div>
		<h1><?php esc_html_e( 'Nie znaleziono strony', 'flowinstal' ); ?></h1>
		<p style="max-width:520px;margin:0 auto 28px;color:var(--fi-text-light)"><?php esc_html_e( 'Strona, której szukasz, nie istnieje lub została przeniesiona. Wróć na stronę główną albo zadzwoń — chętnie pomogę.', 'flowinstal' ); ?></p>
		<div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
			<a class="fi-btn fi-btn--primary fi-btn--lg" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'flowinstal' ); ?></a>
			<a class="fi-btn fi-btn--outline fi-btn--lg" href="tel:<?php echo esc_attr( flowinstal_phone_link() ); ?>"><?php echo esc_html( flowinstal_phone_display() ); ?></a>
		</div>
	</div>
</div>
<?php
get_footer();
