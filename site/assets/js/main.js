/**
 * FlowInstal — skrypty interakcji (Vanilla JS, bez bibliotek).
 * Menu mobilne, smooth scroll, walidacja + AJAX formularza, FAQ,
 * liczniki, reveal, pop-up, cookie, licznik promocji, back-to-top.
 */
(function () {
	'use strict';

	var d = document;
	var data = window.flowinstalData || {};

	function on(el, ev, fn) { if (el) el.addEventListener(ev, fn); }
	function $(s, c) { return (c || d).querySelector(s); }
	function $all(s, c) { return Array.prototype.slice.call((c || d).querySelectorAll(s)); }

	/* ---------- 1. Menu mobilne (hamburger) ---------- */
	var burger = $('#fi-burger');
	var nav = $('#fi-nav');
	on(burger, 'click', function () {
		var open = burger.classList.toggle('is-open');
		if (nav) nav.classList.toggle('is-open', open);
		burger.setAttribute('aria-expanded', open ? 'true' : 'false');
		d.body.style.overflow = open ? 'hidden' : '';
	});
	// Zamknij menu po kliknięciu w link.
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

	/* ---------- 2. Smooth scroll dla kotwic ---------- */
	$all('a[href^="#"]').forEach(function (a) {
		on(a, 'click', function (e) {
			var id = a.getAttribute('href');
			if (id.length < 2) return;
			var target = $(id);
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		});
	});

	/* ---------- 3. Cień nagłówka przy przewijaniu ---------- */
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

	/* ---------- 4. FAQ accordion ---------- */
	$all('.fi-faq-q').forEach(function (btn) {
		on(btn, 'click', function () {
			var item = btn.closest('.fi-faq-item');
			var answer = $('.fi-faq-a', item);
			var open = item.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			answer.style.maxHeight = open ? answer.scrollHeight + 'px' : '0';
		});
	});

	/* ---------- 5. Walidacja + wysyłka formularza (AJAX) ---------- */
	function validateField(field) {
		var input = $('input, select, textarea', field);
		if (!input || !input.required) return true;
		var val = input.value.trim();
		var ok = val !== '';
		if (ok && input.type === 'tel') {
			ok = (val.replace(/[^0-9]/g, '').length >= 9);
		}
		if (ok && input.type === 'email') {
			ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
		}
		field.classList.toggle('has-error', !ok);
		return ok;
	}

	$all('.fi-form').forEach(function (form) {
		// Walidacja w locie.
		$all('.fi-field', form).forEach(function (field) {
			var input = $('input, select, textarea', field);
			on(input, 'blur', function () { validateField(field); });
			on(input, 'input', function () { if (field.classList.contains('has-error')) validateField(field); });
		});

		on(form, 'submit', function (e) {
			e.preventDefault();
			var valid = true;
			$all('.fi-field', form).forEach(function (field) {
				if (!validateField(field)) valid = false;
			});
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

			var btn = $('button[type="submit"]', form);
			var btnLabel = btn ? btn.innerHTML : '';
			if (btn) { btn.disabled = true; btn.style.opacity = '.7'; btn.innerHTML = '<span>' + (data.msgSending || 'Wysyłanie…') + '</span>'; }

			// Brak konfiguracji AJAX (np. podgląd statyczny) — pokaż sukces poglądowy.
			if (!data.ajaxUrl) {
				if (feedback) { feedback.className = 'fi-form-feedback is-success'; feedback.textContent = 'Dziękuję! (podgląd) Zapytanie zostałoby wysłane.'; }
				if (btn) { btn.disabled = false; btn.style.opacity = '1'; btn.innerHTML = btnLabel; }
				form.reset();
				return;
			}

			var body = new FormData(form);
			body.append('action', 'flowinstal_contact');
			body.append('nonce', data.nonce || '');

			fetch(data.ajaxUrl, { method: 'POST', body: body, credentials: 'same-origin' })
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (feedback) {
						feedback.className = 'fi-form-feedback ' + (res.success ? 'is-success' : 'is-error');
						feedback.textContent = (res.data && res.data.message) ? res.data.message : (res.success ? 'Wysłano.' : 'Wystąpił błąd.');
						feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
					}
					if (res.success) { form.reset(); }
				})
				.catch(function () {
					if (feedback) { feedback.className = 'fi-form-feedback is-error'; feedback.textContent = 'Błąd połączenia. Zadzwoń proszę bezpośrednio.'; }
				})
				.finally(function () {
					if (btn) { btn.disabled = false; btn.style.opacity = '1'; btn.innerHTML = btnLabel; }
				});
		});
	});

	/* ---------- 6. Liczniki statystyk ---------- */
	function animateCount(el) {
		var target = parseInt(el.getAttribute('data-count'), 10) || 0;
		var suffix = el.querySelector('span') ? el.querySelector('span').textContent : '';
		var dur = 1400, start = null;
		function step(ts) {
			if (!start) start = ts;
			var p = Math.min((ts - start) / dur, 1);
			var val = Math.floor(p * target);
			el.firstChild.nodeValue = val;
			if (p < 1) requestAnimationFrame(step);
			else el.firstChild.nodeValue = target;
		}
		requestAnimationFrame(step);
	}

	/* ---------- 7. Reveal on scroll + liczniki (IntersectionObserver) ---------- */
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

	/* ---------- 8. Pop-up (po 12s lub przy exit-intent) ---------- */
	var popup = $('#fi-popup');
	if (popup) {
		var shown = false;
		function showPopup() {
			if (shown || sessionStorage.getItem('fi_popup_seen')) return;
			shown = true;
			popup.classList.add('is-open');
			sessionStorage.setItem('fi_popup_seen', '1');
		}
		function closePopup() { popup.classList.remove('is-open'); }
		setTimeout(showPopup, 12000);
		d.addEventListener('mouseout', function (e) {
			if (e.clientY <= 0 && !e.relatedTarget) showPopup();
		});
		on($('#fi-popup-close'), 'click', closePopup);
		on(popup, 'click', function (e) { if (e.target === popup) closePopup(); });
		d.addEventListener('keydown', function (e) { if (e.key === 'Escape') closePopup(); });
	}

	/* ---------- 9. Pasek cookie (RODO) ---------- */
	var cookie = $('#fi-cookie');
	if (cookie && !localStorage.getItem('fi_cookie_ok')) {
		setTimeout(function () { cookie.classList.add('is-visible'); }, 1500);
		on($('#fi-cookie-accept'), 'click', function () {
			localStorage.setItem('fi_cookie_ok', '1');
			cookie.classList.remove('is-visible');
		});
	}

	/* ---------- 10. Licznik promocji ---------- */
	var cd = $('#fi-countdown');
	if (cd) {
		var end = new Date((cd.getAttribute('data-end') || '') + 'T23:59:59').getTime();
		if (!isNaN(end)) {
			(function tick() {
				var diff = end - Date.now();
				if (diff <= 0) { cd.textContent = ''; return; }
				var dd = Math.floor(diff / 86400000);
				var hh = Math.floor((diff % 86400000) / 3600000);
				var mm = Math.floor((diff % 3600000) / 60000);
				cd.innerHTML = '<b>' + dd + 'd</b><b>' + hh + 'h</b><b>' + mm + 'm</b>';
				setTimeout(tick, 30000);
			})();
		}
	}
})();
