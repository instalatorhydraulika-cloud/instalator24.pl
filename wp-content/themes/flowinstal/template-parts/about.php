<?php
/**
 * Sekcja "O mnie" — specjalista od ogrzewania podłogowego.
 *
 * @package FlowInstal
 */
?>
<section class="fi-section" id="o-nas">
	<div class="fi-container">
		<div class="fi-about">
			<div class="fi-about-media fi-reveal">
				<div class="fi-about-photo">
					<?php
					$photo = get_theme_mod( 'flowinstal_about_photo', '' );
					if ( $photo ) :
						?>
						<img src="<?php echo esc_url( $photo ); ?>" alt="<?php esc_attr_e( 'Maciej Kolasa — FlowInstal, specjalista ogrzewania podłogowego', 'flowinstal' ); ?>">
					<?php else : ?>
						<?php flowinstal_icon( 'users' ); ?>
						<span><?php esc_html_e( 'Tu wstaw swoje zdjęcie (Wygląd → Dostosuj)', 'flowinstal' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="fi-about-badge">
					<div class="fi-about-badge-ico"><?php flowinstal_icon( 'thermometer' ); ?></div>
					<div><strong>5 000 m²</strong><span><?php esc_html_e( 'ułożonej podłogówki', 'flowinstal' ); ?></span></div>
				</div>
			</div>

			<div class="fi-about-content fi-reveal">
				<span class="fi-eyebrow"><?php flowinstal_icon( 'users' ); ?><?php esc_html_e( 'Poznaj wykonawcę', 'flowinstal' ); ?></span>
				<h2><?php esc_html_e( 'Ogrzewanie podłogowe to moja specjalność', 'flowinstal' ); ?></h2>
				<p><?php esc_html_e( 'Za marką FlowInstal stoi 4-letnie doświadczenie na placach budowy, tysiące metrów ułożonych pętli i dziesiątki uruchomionych instalacji. Nie jestem teoretykiem — mam fach w ręku.', 'flowinstal' ); ?></p>
				<p><?php esc_html_e( 'Stawiam na precyzyjny projekt, staranny montaż i transparentne rozliczenia. Wiem, jak dobrać rozstaw pętli i strefy, by podłogówka grzała równomiernie i ekonomicznie — także w duecie z pompą ciepła. Wybierając mnie, rozmawiasz bezpośrednio z wykonawcą Twojej instalacji.', 'flowinstal' ); ?></p>

				<ul class="fi-checklist">
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Projekt i montaż pętli', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Rozdzielacze i strefy', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Pod pompę ciepła i kocioł', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Próby ciśnieniowe i rozruch', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Instalacje wod-kan', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Zgrzewanie PP', 'flowinstal' ); ?></span></li>
				</ul>

				<div class="fi-about-sign">
					<div class="fi-about-badge-ico" style="width:54px;height:54px"><?php flowinstal_icon( 'tool' ); ?></div>
					<div class="fi-about-sign-name">
						<strong>Maciej Kolasa</strong>
						<span><?php esc_html_e( 'Właściciel i wykonawca — FlowInstal', 'flowinstal' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
