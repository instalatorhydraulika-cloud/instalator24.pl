/**
 * Podgląd na żywo zmian w Customizerze (selektywne odświeżanie).
 */
(function () {
	'use strict';
	if (!window.wp || !wp.customize) return;

	wp.customize('flowinstal_hero_title', function (value) {
		value.bind(function (to) {
			var el = document.querySelector('.fi-hero h1');
			if (el) el.innerHTML = to;
		});
	});
	wp.customize('flowinstal_hero_lead', function (value) {
		value.bind(function (to) {
			var el = document.querySelector('.fi-hero-lead');
			if (el) el.innerHTML = to;
		});
	});
	wp.customize('flowinstal_promo_text', function (value) {
		value.bind(function (to) {
			var el = document.querySelector('#fi-promo-bar span');
			if (el) el.textContent = to;
		});
	});
})();
