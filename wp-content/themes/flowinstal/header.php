<?php
/**
 * Nagłówek motywu: <head>, górny pasek, pasek promo, nawigacja.
 *
 * @package FlowInstal
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// ---- Górny pasek promocyjny (konwersja / urgency) ----
$promo_on   = get_theme_mod( 'flowinstal_promo_on', true );
$promo_text = get_theme_mod( 'flowinstal_promo_text', 'Promocja na czerwiec: -10% na ogrzewanie podłogowe + bezpłatny dojazd na terenie powiatu brzezińskiego!' );
$promo_end  = get_theme_mod( 'flowinstal_promo_end', '' );
if ( $promo_on && $promo_text ) : ?>
	<div class="fi-promo-bar" id="fi-promo-bar">
		<?php flowinstal_icon( 'gift' ); ?>
		<span><?php echo esc_html( $promo_text ); ?></span>
		<?php if ( $promo_end ) : ?>
			<span class="fi-promo-countdown" id="fi-countdown" data-end="<?php echo esc_attr( $promo_end ); ?>" aria-label="<?php esc_attr_e( 'Pozostały czas promocji', 'flowinstal' ); ?>"></span>
		<?php endif; ?>
	</div>
<?php endif; ?>

<header class="fi-header" id="fi-header">
	<div class="fi-container">
		<a class="fi-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="FlowInstal — strona główna">
			<span class="fi-logo-mark"><?php flowinstal_icon( 'droplet' ); ?></span>
			<span><b>Flow</b><span>Instal</span></span>
		</a>

		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => 'nav',
				'container_class'=> 'fi-nav',
				'container_id'   => 'fi-nav',
				'menu_class'     => 'fi-nav-list',
				'depth'          => 1,
				'fallback_cb'    => 'flowinstal_fallback_menu',
			) );
		} else {
			flowinstal_fallback_menu();
		}
		?>

		<div class="fi-header-cta">
			<a class="fi-header-phone" href="tel:<?php echo esc_attr( flowinstal_phone_link() ); ?>">
				<span class="fi-phone-ico"><?php flowinstal_icon( 'phone' ); ?></span>
				<span>
					<small><?php esc_html_e( 'Zadzwoń teraz', 'flowinstal' ); ?></small>
					<?php echo esc_html( flowinstal_phone_display() ); ?>
				</span>
			</a>
			<button class="fi-burger" id="fi-burger" aria-label="<?php esc_attr_e( 'Otwórz menu', 'flowinstal' ); ?>" aria-expanded="false" aria-controls="fi-nav">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</header>
