/* =======================================================
   Olga & Jakub — logika strony
======================================================= */
(function () {
  "use strict";

  const WEDDING_DATE = new Date("2027-07-20T15:00:00+02:00");
  const RSVP_DEADLINE = "20 maja 2027";
  const STORAGE_KEY = "rsvp_olga_jakub";

  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- 1. INTRO: KOPERTA ---------- */
  const envScreen = $("#envelopeScreen");
  const envelope = $("#envelope");
  let opened = false;

  document.body.classList.add("no-scroll");

  function openEnvelope() {
    if (opened) return;
    opened = true;
    envelope.classList.add("opening");
    setTimeout(() => {
      envScreen.classList.add("open");
      document.body.classList.remove("no-scroll");
      // uruchom reveal dla widocznych sekcji
      window.dispatchEvent(new Event("scroll"));
    }, reduceMotion ? 200 : 1600);
  }

  if (envelope) {
    envelope.addEventListener("click", openEnvelope);
    envelope.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") { e.preventDefault(); openEnvelope(); }
    });
  }
  // awaryjnie: gdyby ktoś nie kliknął, otwórz automatycznie po 6 s
  setTimeout(() => { if (!opened) openEnvelope(); }, 6000);

  /* ---------- 2. DRYFUJĄCE LIŚCIE ---------- */
  const petalsBox = $(".petals");
  if (petalsBox && !reduceMotion) {
    const leaf = `<svg viewBox="0 0 24 24"><path d="M12 2C7 6 4 11 4 15c0 4 3 7 8 7 0-5 0-9 3-13-3 1-5 3-6 6 0-4 1-8 3-11z" fill="%COLOR%"/></svg>`;
    const colors = ["#8a9a7b", "#b3c0a2", "#f2df9b", "#d8bd7e", "#dbe3cf"];
    const N = 14;
    for (let i = 0; i < N; i++) {
      const p = document.createElement("div");
      p.className = "petal";
      const size = 10 + Math.random() * 16;
      p.style.left = Math.random() * 100 + "vw";
      p.style.width = p.style.height = size + "px";
      p.style.animationDuration = 10 + Math.random() * 12 + "s";
      p.style.animationDelay = -Math.random() * 20 + "s";
      p.style.opacity = 0.25 + Math.random() * 0.4;
      p.innerHTML = leaf.replace("%COLOR%", colors[i % colors.length]);
      petalsBox.appendChild(p);
    }
  }

  /* ---------- 3. GIRLANDA LIŚCI NA ŁUKU ---------- */
  function buildArch() {
    const left = $(".arch-leaves-left");
    const right = $(".arch-leaves-right");
    if (!left || !right) return;
    // punkty wzdłuż łuku: pionowe boki + półokrąg u góry
    const cx = 200, cy = 220, r = 140;
    const pts = [];
    for (let y = 600; y > 220; y -= 26) pts.push({ x: 60, y, a: 0 });      // lewy bok
    for (let d = 180; d >= 0; d -= 14) {                                     // łuk
      const rad = (d * Math.PI) / 180;
      pts.push({ x: cx - r * Math.cos(rad), y: cy - r * Math.sin(rad), a: 90 - d });
    }
    function leafAt(x, y, ang, side) {
      const s = 5 + Math.random() * 4;
      const rot = ang + (side * (18 + Math.random() * 30));
      return `<path transform="translate(${x.toFixed(1)} ${y.toFixed(1)}) rotate(${rot.toFixed(0)}) scale(${(s/10).toFixed(2)})"
        d="M0 0 C 6 -10 6 -22 0 -30 C -6 -22 -6 -10 0 0 Z" opacity="${(0.6+Math.random()*0.4).toFixed(2)}"/>`;
    }
    let leftHTML = "", rightHTML = "";
    pts.forEach((p) => {
      // odbicie w poziomie dla prawej strony
      leftHTML += leafAt(p.x, p.y, p.a, -1) + leafAt(p.x, p.y, p.a, 1);
      const mx = 400 - p.x;
      rightHTML += leafAt(mx, p.y, -p.a, -1) + leafAt(mx, p.y, -p.a, 1);
    });
    left.innerHTML = leftHTML;
    right.innerHTML = rightHTML;
  }
  buildArch();

  /* ---------- 4. ODLICZANIE ---------- */
  const cd = {
    d: $("#cdDays"), h: $("#cdHours"), m: $("#cdMin"), s: $("#cdSec"),
    done: $("#cdDone"), box: $("#countdown")
  };
  function tick() {
    const diff = WEDDING_DATE - new Date();
    if (diff <= 0) {
      if (cd.box) cd.box.style.display = "none";
      if (cd.done) cd.done.hidden = false;
      return false;
    }
    const days = Math.floor(diff / 86400000);
    const hours = Math.floor((diff % 86400000) / 3600000);
    const mins = Math.floor((diff % 3600000) / 60000);
    const secs = Math.floor((diff % 60000) / 1000);
    const pad = (n) => String(n).padStart(2, "0");
    if (cd.d) cd.d.textContent = days;
    if (cd.h) cd.h.textContent = pad(hours);
    if (cd.m) cd.m.textContent = pad(mins);
    if (cd.s) cd.s.textContent = pad(secs);
    return true;
  }
  if (cd.d) { tick(); setInterval(tick, 1000); }

  /* ---------- 5. REVEAL PRZY PRZEWIJANIU ---------- */
  const revealEls = $$(".reveal");
  if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -8% 0px" });
    revealEls.forEach((el) => io.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add("in"));
  }

  /* ---------- 6. NAWIGACJA ---------- */
  const nav = $("#topnav");
  const navToggle = $("#navToggle");
  const navLinks = $("#navLinks");

  window.addEventListener("scroll", () => {
    if (nav) nav.classList.toggle("solid", window.scrollY > 60);
  }, { passive: true });

  function closeMenu() {
    navToggle.setAttribute("aria-expanded", "false");
    navLinks.classList.remove("show");
    document.body.classList.remove("no-scroll");
  }
  if (navToggle) {
    navToggle.addEventListener("click", () => {
      const open = navToggle.getAttribute("aria-expanded") === "true";
      navToggle.setAttribute("aria-expanded", String(!open));
      navLinks.classList.toggle("show", !open);
      if (window.innerWidth < 640) document.body.classList.toggle("no-scroll", !open);
    });
    $$("#navLinks a").forEach((a) => a.addEventListener("click", closeMenu));
  }

  /* ---------- 7. FAQ ---------- */
  $$(".faq-q").forEach((btn) => {
    btn.addEventListener("click", () => {
      const open = btn.getAttribute("aria-expanded") === "true";
      const ans = btn.nextElementSibling;
      btn.setAttribute("aria-expanded", String(!open));
      ans.style.maxHeight = open ? null : ans.scrollHeight + "px";
    });
  });

  /* ---------- 8. RSVP ---------- */
  const form = $("#rsvpForm");
  const attendOnly = $("#attendOnly");
  const thanks = $("#rsvpThanks");
  const thanksMsg = $("#thanksMsg");
  const thanksTitle = $("#thanksTitle");
  const formError = $("#formError");

  // pokaż/ukryj pola zależne od obecności
  $$('input[name="attending"]').forEach((r) => {
    r.addEventListener("change", () => {
      const attending = $('input[name="attending"]:checked');
      attendOnly.classList.toggle("show", attending && attending.value === "tak");
    });
  });

  function showError(msg) {
    formError.textContent = msg;
    formError.hidden = false;
    formError.scrollIntoView({ behavior: "smooth", block: "center" });
  }

  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      formError.hidden = true;

      const name = $("#fName").value.trim();
      const contact = $("#fEmail").value.trim();
      const attending = $('input[name="attending"]:checked');

      if (!name) return showError("Podaj imię i nazwisko.");
      if (!contact) return showError("Podaj e-mail lub telefon.");
      if (!attending) return showError("Zaznacz, czy będziesz z nami.");

      const data = {
        name, contact,
        attending: attending.value,
        date: new Date().toISOString(),
      };

      if (attending.value === "tak") {
        data.guests = $("#fGuests").value;
        const menu = $('input[name="menu"]:checked');
        data.menu = menu ? menu.value : "(nie wybrano)";
        data.allergies = $$('input[name="allergy"]:checked').map((c) => c.value);
        const other = $("#fAllergyOther").value.trim();
        if (other) data.allergies.push(other);
        data.song = $("#fSong").value.trim();
      }
      data.note = $("#fNote").value.trim();

      // zapis lokalny (demo)
      try {
        const all = JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]");
        all.push(data);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(all));
      } catch (err) { /* localStorage niedostępny — pomijamy */ }

      // ekran podziękowania
      if (attending.value === "tak") {
        thanksTitle.textContent = "Cieszymy się! 💛";
        let msg = `Dziękujemy, ${name.split(" ")[0]}! Zapisaliśmy Twoje potwierdzenie`;
        if (data.guests) msg += ` dla ${data.guests} ${Number(data.guests) === 1 ? "osoby" : "osób"}`;
        msg += ".";
        if (data.menu && data.menu !== "(nie wybrano)") msg += `\nMenu: ${data.menu}.`;
        if (data.allergies && data.allergies.length) msg += `\nUwzględnimy: ${data.allergies.join(", ")}.`;
        msg += `\nDo zobaczenia 20 lipca 2027!`;
        thanksMsg.textContent = msg;
      } else {
        thanksTitle.textContent = "Będzie nam Ciebie brakować";
        thanksMsg.textContent = `Dziękujemy za odpowiedź, ${name.split(" ")[0]}. Szkoda, że nie możesz — myślami bądź z nami. 💛`;
      }

      form.hidden = true;
      thanks.hidden = false;
      thanks.scrollIntoView({ behavior: "smooth", block: "center" });
    });
  }

  // edytuj ponownie
  const editAgain = $("#editAgain");
  if (editAgain) {
    editAgain.addEventListener("click", () => {
      thanks.hidden = true;
      form.hidden = false;
      form.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  }

  // podgląd zapisanych odpowiedzi (demo)
  const showSaved = $("#showSaved");
  if (showSaved) {
    showSaved.addEventListener("click", (e) => {
      e.preventDefault();
      let all = [];
      try { all = JSON.parse(localStorage.getItem(STORAGE_KEY) || "[]"); } catch (_) {}
      if (!all.length) { alert("Brak zapisanych odpowiedzi na tym urządzeniu."); return; }
      const lines = all.map((r, i) => {
        let l = `${i + 1}. ${r.name} — ${r.attending === "tak" ? "będzie" : "nie będzie"}`;
        if (r.attending === "tak") {
          l += ` (${r.guests} os., menu: ${r.menu}`;
          if (r.allergies && r.allergies.length) l += `, alergie: ${r.allergies.join("/")}`;
          l += ")";
        }
        return l;
      });
      alert("Zapisane odpowiedzi (demo, tylko to urządzenie):\n\n" + lines.join("\n"));
    });
  }

  /* ---------- 9. GALERIA + LIGHTBOX ---------- */
  const figures = $$("#galleryGrid .ph");
  const lb = $("#lightbox");
  const lbImg = $("#lbImg");
  const lbCap = $("#lbCap");
  let lbIndex = 0;

  // wstrzyknij podpisy na kafelki
  figures.forEach((fig) => {
    const cap = fig.getAttribute("data-cap");
    if (cap) {
      const span = document.createElement("figcaption");
      span.className = "ph-cap";
      span.textContent = cap;
      fig.appendChild(span);
    }
  });

  function openLb(i) {
    lbIndex = (i + figures.length) % figures.length;
    const fig = figures[lbIndex];
    lbImg.src = fig.getAttribute("data-full");
    lbImg.alt = fig.querySelector("img") ? fig.querySelector("img").alt : "";
    lbCap.textContent = fig.getAttribute("data-cap") || "";
    lb.classList.add("show");
    lb.setAttribute("aria-hidden", "false");
    document.body.classList.add("no-scroll");
  }
  function closeLb() {
    lb.classList.remove("show");
    lb.setAttribute("aria-hidden", "true");
    document.body.classList.remove("no-scroll");
  }
  function stepLb(d) {
    // krótka animacja ponownego pojawienia
    lbImg.style.animation = "none";
    void lbImg.offsetWidth;
    lbImg.style.animation = "";
    openLb(lbIndex + d);
  }

  if (lb) {
    figures.forEach((fig, i) => {
      fig.addEventListener("click", () => openLb(i));
    });
    $("#lbClose").addEventListener("click", closeLb);
    $("#lbPrev").addEventListener("click", (e) => { e.stopPropagation(); stepLb(-1); });
    $("#lbNext").addEventListener("click", (e) => { e.stopPropagation(); stepLb(1); });
    lb.addEventListener("click", (e) => { if (e.target === lb) closeLb(); });
    document.addEventListener("keydown", (e) => {
      if (!lb.classList.contains("show")) return;
      if (e.key === "Escape") closeLb();
      else if (e.key === "ArrowLeft") stepLb(-1);
      else if (e.key === "ArrowRight") stepLb(1);
    });
    // swipe na telefonie
    let sx = 0;
    lb.addEventListener("touchstart", (e) => { sx = e.touches[0].clientX; }, { passive: true });
    lb.addEventListener("touchend", (e) => {
      const dx = e.changedTouches[0].clientX - sx;
      if (Math.abs(dx) > 45) stepLb(dx < 0 ? 1 : -1);
    }, { passive: true });
  }

})();
