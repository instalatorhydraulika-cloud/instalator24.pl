<?php
/**
 * Sekcja "O mnie" — budowanie zaufania, twarz wykonawcy.
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
						<img src="<?php echo esc_url( $photo ); ?>" alt="<?php esc_attr_e( 'Maciej Kolasa — FlowInstal', 'flowinstal' ); ?>">
					<?php else : ?>
						<?php flowinstal_icon( 'users' ); ?>
						<span><?php esc_html_e( 'Tu wstaw swoje zdjęcie (Wygląd → Dostosuj)', 'flowinstal' ); ?></span>
					<?php endif; ?>
				</div>
				<div class="fi-about-badge">
					<div class="fi-about-badge-ico"><?php flowinstal_icon( 'award' ); ?></div>
					<div><strong>4 <?php esc_html_e( 'lata', 'flowinstal' ); ?></strong><span><?php esc_html_e( 'doświadczenia w fachu', 'flowinstal' ); ?></span></div>
				</div>
			</div>

			<div class="fi-about-content fi-reveal">
				<span class="fi-eyebrow"><?php flowinstal_icon( 'users' ); ?><?php esc_html_e( 'Poznaj wykonawcę', 'flowinstal' ); ?></span>
				<h2><?php esc_html_e( 'Za marką FlowInstal stoi konkretny fachowiec', 'flowinstal' ); ?></h2>
				<p><?php esc_html_e( 'Za marką FlowInstal stoi 4-letnie doświadczenie na placach budowy, setki połączonych rur i dziesiątki uruchomionych kotłowni. Nie jestem teoretykiem — mam fach w ręku.', 'flowinstal' ); ?></p>
				<p><?php esc_html_e( 'Stawiam na nowoczesne technologie, precyzję wykonania i transparentne rozliczenia. Wybierając mnie, rozmawiasz bezpośrednio z wykonawcą Twojej instalacji — od pierwszego telefonu po odbiór prac.', 'flowinstal' ); ?></p>

				<ul class="fi-checklist">
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Kotły peletowe i ekogroszek', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Ogrzewanie podłogowe', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Instalacje wod-kan', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Zgrzewanie PP', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Przydomowe oczyszczalnie', 'flowinstal' ); ?></span></li>
					<li><?php flowinstal_icon( 'check-circle' ); ?><span><?php esc_html_e( 'Przyłącza wodociągowe', 'flowinstal' ); ?></span></li>
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
