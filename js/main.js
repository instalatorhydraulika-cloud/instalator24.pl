/**
 * FlowInstal — skrypty interakcji (statyczna strona, czysty Vanilla JS).
 * Menu mobilne, smooth scroll, walidacja + wysyłka formularza (Web3Forms),
 * FAQ, liczniki, reveal, pop-up, cookie, licznik promocji, back-to-top.
 *
 * ─────────────────────────────────────────────────────────────────────────
 *  KONFIGURACJA FORMULARZA (jedyne miejsce do edycji)
 *  Wklej darmowy klucz z https://web3forms.com (podajesz tylko e-mail,
 *  na który mają przychodzić zapytania — bez zakładania konta).
 * ─────────────────────────────────────────────────────────────────────────
 */
var WEB3FORMS_KEY = 'WKLEJ_TUTAJ_KLUCZ_WEB3FORMS';

(function () {
	'use strict';

	var d = document;
	function on(el, ev, fn) { if (el) el.addEventListener(ev, fn); }
	function $(s, c) { return (c || d).querySelector(s); }
	function $all(s, c) { return Array.prototype.slice.call((c || d).querySelectorAll(s)); }

	var keyReady = WEB3FORMS_KEY && WEB3FORMS_KEY.indexOf('WKLEJ') === -1;

	/* ---------- 1. Menu mobilne (hamburger) ---------- */
	var burger = $('#fi-burger');
	var nav = $('#fi-nav');
	on(burger, 'click', function () {
		var open = burger.classList.toggle('is-open');
		if (nav) nav.classList.toggle('is-open', open);
		burger.setAttribute('aria-expanded', open ? 'true' : 'false');
		d.body.style.overflow = open ? 'hidden' : '';
	});
	if (nav) {
		$all('a', nav).forEach(function (a) {
			on(a, 'click', function () {
				burger.classList.remove('is-open');
				nav.classList.remove('is-open');
				burger.setAttribute('aria-expanded', 'false');
				d.body.style.overflow = '';
			});
		});
	}

	/* ---------- 2. Smooth scroll ---------- */
	$all('a[href^="#"]').forEach(function (a) {
		on(a, 'click', function (e) {
			var id = a.getAttribute('href');
			if (id.length < 2) return;
			var target = $(id);
			if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
		});
	});

	/* ---------- 3. Nagłówek / back-to-top ---------- */
	var header = $('#fi-header');
	var totop = $('#fi-totop');
	function onScroll() {
		var y = window.pageYOffset;
		if (header) header.classList.toggle('is-scrolled', y > 10);
		if (totop) totop.classList.toggle('is-visible', y > 600);
	}
	window.addEventListener('scroll', onScroll, { passive: true });
	onScroll();
	on(totop, 'click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });

	/* ---------- 4. FAQ ---------- */
	$all('.fi-faq-q').forEach(function (btn) {
		on(btn, 'click', function () {
			var item = btn.closest('.fi-faq-item');
			var answer = $('.fi-faq-a', item);
			var open = item.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			answer.style.maxHeight = open ? answer.scrollHeight + 'px' : '0';
		});
	});

	/* ---------- 5. Walidacja + wysyłka (Web3Forms) ---------- */
	function validateField(field) {
		var input = $('input, select, textarea', field);
		if (!input || !input.required) return true;
		var val = input.value.trim();
		var ok = val !== '';
		if (ok && input.type === 'tel') { ok = (val.replace(/[^0-9]/g, '').length >= 9); }
		if (ok && input.type === 'email') { ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val); }
		field.classList.toggle('has-error', !ok);
		return ok;
	}

	$all('.fi-form').forEach(function (form) {
		$all('.fi-field', form).forEach(function (field) {
			var input = $('input, select, textarea', field);
			on(input, 'blur', function () { validateField(field); });
			on(input, 'input', function () { if (field.classList.contains('has-error')) validateField(field); });
		});

		on(form, 'submit', function (e) {
			e.preventDefault();
			var valid = true;
			$all('.fi-field', form).forEach(function (field) { if (!validateField(field)) valid = false; });
			var consent = $('input[name="fi_consent"]', form);
			var feedback = $('.fi-form-feedback', form);
			if (consent && !consent.checked) {
				valid = false;
				if (feedback) { feedback.className = 'fi-form-feedback is-error'; feedback.textContent = 'Zaznacz zgodę na kontakt, aby wysłać zapytanie.'; }
			}
			if (!valid) {
				var firstErr = $('.fi-field.has-error', form);
				if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
				return;
			}
			// Honeypot
			if (form.querySelector('[name="fi_website"]') && form.querySelector('[name="fi_website"]').value) { return; }

			var btn = $('button[type="submit"]', form);
			var btnLabel = btn ? btn.innerHTML : '';

			// Brak skonfigurowanego klucza — tryb demonstracyjny.
			if (!keyReady) {
				if (feedback) {
					feedback.className = 'fi-form-feedback is-success';
					feedback.textContent = 'Dziękuję! (wersja demonstracyjna) Aby formularz realnie wysyłał e-maile, wklej klucz Web3Forms w pliku js/main.js. W międzyczasie zadzwoń — chętnie pomogę.';
				}
				form.reset();
				return;
			}

			if (btn) { btn.disabled = true; btn.style.opacity = '.7'; btn.innerHTML = '<span>Wysyłanie…</span>'; }

			var body = new FormData(form);
			body.append('access_key', WEB3FORMS_KEY);
			body.append('subject', 'Nowe zapytanie o ogrzewanie podłogowe — FlowInstal');
			body.append('from_name', 'FlowInstal — strona WWW');

			fetch('https://api.web3forms.com/submit', { method: 'POST', body: body })
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (feedback) {
						feedback.className = 'fi-form-feedback ' + (res.success ? 'is-success' : 'is-error');
						feedback.textContent = res.success
							? 'Dziękuję! Zapytanie wysłane — odezwę się najszybciej, jak to możliwe.'
							: (res.message || 'Nie udało się wysłać. Zadzwoń proszę bezpośrednio.');
						feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
					if (res.success) form.reset();
				})
				.catch(function () {
					if (feedback) { feedback.className = 'fi-form-feedback is-error'; feedback.textContent = 'Błąd połączenia. Zadzwoń proszę bezpośrednio.'; }
				})
				.finally(function () { if (btn) { btn.disabled = false; btn.style.opacity = '1'; btn.innerHTML = btnLabel; } });
		});
	});

	/* ---------- 6. Liczniki ---------- */
	function animateCount(el) {
		var target = parseInt(el.getAttribute('data-count'), 10) || 0;
		var dur = 1400, start = null;
		function step(ts) {
			if (!start) start = ts;
			var p = Math.min((ts - start) / dur, 1);
			el.firstChild.nodeValue = Math.floor(p * target);
			if (p < 1) requestAnimationFrame(step); else el.firstChild.nodeValue = target;
		}
		requestAnimationFrame(step);
	}

	/* ---------- 7. Reveal + liczniki ---------- */
	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (en) {
				if (en.isIntersecting) {
					en.target.classList.add('is-in');
					if (en.target.classList.contains('fi-stat')) {
						var num = $('.fi-stat-num', en.target);
						if (num && !num.dataset.done) { num.dataset.done = '1'; animateCount(num); }
					}
					io.unobserve(en.target);
				}
			});
		}, { threshold: 0.15 });
		$all('.fi-reveal, .fi-stat').forEach(function (el) { io.observe(el); });
	} else {
		$all('.fi-reveal').forEach(function (el) { el.classList.add('is-in'); });
	}

	/* ---------- 8. Pop-up ---------- */
	var popup = $('#fi-popup');
	if (popup) {
		var shown = false;
		function showPopup() {
			if (shown || sessionStorage.getItem('fi_popup_seen')) return;
			shown = true; popup.classList.add('is-open'); sessionStorage.setItem('fi_popup_seen', '1');
		}
		function closePopup() { popup.classList.remove('is-open'); }
		setTimeout(showPopup, 12000);
		d.addEventListener('mouseout', function (e) { if (e.clientY <= 0 && !e.relatedTarget) showPopup(); });
		on($('#fi-popup-close'), 'click', closePopup);
		on(popup, 'click', function (e) { if (e.target === popup) closePopup(); });
		d.addEventListener('keydown', function (e) { if (e.key === 'Escape') closePopup(); });
	}

	/* ---------- 9. Cookie ---------- */
	var cookie = $('#fi-cookie');
	if (cookie && !localStorage.getItem('fi_cookie_ok')) {
		setTimeout(function () { cookie.classList.add('is-visible'); }, 1500);
		on($('#fi-cookie-accept'), 'click', function () { localStorage.setItem('fi_cookie_ok', '1'); cookie.classList.remove('is-visible'); });
	}

	/* ---------- 10. Licznik promocji ---------- */
	var cd = $('#fi-countdown');
	if (cd) {
		var end = new Date((cd.getAttribute('data-end') || '') + 'T23:59:59').getTime();
		if (!isNaN(end)) {
			(function tick() {
				var diff = end - Date.now();
				if (diff <= 0) { cd.textContent = ''; return; }
				var dd = Math.floor(diff / 86400000), hh = Math.floor((diff % 86400000) / 3600000), mm = Math.floor((diff % 3600000) / 60000);
				cd.innerHTML = '<b>' + dd + 'd</b><b>' + hh + 'h</b><b>' + mm + 'm</b>';
				setTimeout(tick, 30000);
			})();
		}
	}
})();
