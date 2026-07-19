# Dokumentacja projektu — FlowInstal (strona WWW)

> Stan na: **14.06.2026** · Gałąź robocza: `claude/wordpress-brzeziny-site-egws1w`
> Repozytorium: `instalatorhydraulika-cloud/instalator24.pl`

Ten dokument opisuje **wszystko, co zostało dotychczas zbudowane** — strukturę,
funkcje, sposób podglądu, instalacji oraz listę rzeczy do uzupełnienia.

---

## 1. Czym jest projekt

Rozbudowana, konwersyjna strona internetowa dla firmy instalatorskiej
**FlowInstal** (właściciel: **Maciej Kolasa**), z marketingiem skupionym na
**wodnym ogrzewaniu podłogowym**, nastawiona na **rynek lokalny: Brzeziny
i okolice (woj. łódzkie)** w promieniu ok. 20 km — Stryków, Andrespol,
Koluszki, Nowosolna, Łódź Widzew, Rogów, Jeżów. Wyceny przygotowywane są
zawsze po wizji lokalnej (brak publicznego cennika — świadoma decyzja).

Profil działalności (z briefu):
- Instalacje grzewcze, **ogrzewanie podłogowe**, **kotłownie na pelet/ekogroszek**,
  **wod-kan**, **zgrzewanie PP**, **przydomowe oczyszczalnie ścieków**.
- Praca na etacie + zlecenia **popołudniami i w soboty** (elastyczne terminy).
- Atuty: 4 lata praktyki, zaplecze hurtowe (materiał bez przedpłat, rabaty),
  brak instalacji gazowych do czasu uprawnień SEP E/D.

Forma techniczna: **samodzielny motyw WordPress** o nazwie `flowinstal`.

---

## 2. Co zostało zbudowane

### 2.1. Motyw WordPress (`wp-content/themes/flowinstal/`)
Kompletny, gotowy do instalacji motyw — **25 plików PHP + 2 pliki JS**, cały kod
zwalidowany składniowo (PHP `-l`, `node --check`).

```
wp-content/themes/flowinstal/
├── style.css              # System projektowy (zmienne CSS) + wszystkie style (~1100 linii)
├── functions.php          # Konfiguracja motywu, biblioteka ikon SVG, funkcje pomocnicze
├── header.php             # <head> + SEO, górny pasek promo, nawigacja, hamburger
├── footer.php             # Stopka, pływające przyciski, pasek mobilny, pop-up, cookie
├── front-page.php         # Strona główna — składa 14 sekcji
├── index.php              # Lista wpisów / blog / fallback
├── page.php               # Strona statyczna (z breadcrumbami)
├── single.php             # Pojedynczy wpis
├── 404.php                # Strona błędu 404
├── screenshot.png         # Miniatura w panelu wyboru motywów
├── inc/
│   ├── customizer.php     # Panel ustawień (Wygląd → Dostosuj → FlowInstal)
│   ├── contact-form.php   # Formularz + obsługa AJAX + zapis leadów (CPT)
│   └── schema.php         # Dane strukturalne Schema.org + FAQ + meta geo
├── template-parts/        # 14 sekcji strony głównej (po jednym pliku każda)
│   ├── hero.php           # Pierwszy ekran + formularz szybkiej wyceny
│   ├── trustbar.php       # Pasek sygnałów zaufania
│   ├── services.php       # Siatka 4 usług
│   ├── stats.php          # Animowane liczniki (4 lata, 250+, 20 km, 100%)
│   ├── why.php            # USP — „Dlaczego ja" (3 punkty)
│   ├── process.php        # Proces współpracy w 4 krokach
│   ├── benefits.php       # Korzyści ogrzewania podłogowego (6 kafelków)
│   ├── about.php          # O mnie / twarz wykonawcy
│   ├── gallery.php        # Realizacje (galeria — obecnie placeholdery)
│   ├── reviews.php        # Opinie klientów z gwiazdkami
│   ├── area.php           # Obszar działania + mapa Google
│   ├── faq.php            # Najczęstsze pytania (accordion)
│   ├── cta.php            # Mocne wezwanie do działania
│   └── contact.php        # Sekcja kontaktu z pełnym formularzem
└── assets/js/
    ├── main.js            # Interakcje (menu, walidacja, AJAX, liczniki, pop-up…)
    └── customizer.js      # Podgląd na żywo zmian w Customizerze
```

### 2.2. Statyczny podgląd (`site/`) i publikacja (`.github/`)
- `site/` — statyczny render strony głównej (HTML + CSS + JS) na potrzeby podglądu.
- `.github/workflows/deploy-pages.yml` — workflow publikujący `site/` na GitHub Pages.
- `_preview/` — skrypty pomocnicze do renderu i zrzutów (poza repo, w `.gitignore`).

---

## 3. Sekcje strony głównej (kolejność)

1. **Górny pasek promocyjny** — komunikat promo + opcjonalny licznik czasu.
2. **Nagłówek (sticky)** — logo, menu, telefon-CTA, hamburger na mobile.
3. **Hero** — nagłówek H1, opis, 2 przyciski CTA, sygnały zaufania (4 lata /
   darmowy dojazd / popołudnia i soboty) oraz **formularz szybkiej wyceny**.
4. **Pasek zaufania** — 5 szybkich argumentów (materiał z rabatem, bez przedpłat,
   czystość, punktualność, transparentne rozliczenia).
5. **Usługi** — 4 karty skupione na podłogówce: montaż pętli, rozdzielacze i strefy, podłączenie źródła ciepła (pompa ciepła / kocioł), wod-kan uzupełniająco.
6. **Korzyści ogrzewania podłogowego** — 6 kafelków (komfort, oszczędność, pompa ciepła, estetyka, mikroklimat, ciepła podłoga).
7. **Statystyki** — animowane liczniki (m² podłogówki).
8. **Dlaczego ja (USP)** — sekcja ciemna, 3 atuty (projekt, szczelność, elastyczność).
9. **Proces** — montaż podłogówki w 4 krokach (wizja lokalna → projekt+wycena → montaż → próby/rozruch).
10. **O mnie** — budowanie zaufania, lista kompetencji, podpis wykonawcy.
11. **Realizacje** — galeria 6 kafelków (do podmiany na zdjęcia).
12. **Opinie** — 3 referencje z gwiazdkami i lokalizacją.
13. **Obszar działania** — lista miejscowości + mapa Google + „darmowy dojazd".
14. **FAQ** — accordion (7 pytań o podłogówkę), zsynchronizowany z danymi SEO.
15. **CTA** — pasek z telefonem i WhatsApp.
16. **Kontakt** — dane teleadresowe + pełny formularz zapytania.
17. **Stopka** — kolumny, social media, mapa linków, prawa autorskie.

---

## 4. Elementy budujące konwersję

| Element | Opis | Gdzie |
|---|---|---|
| Pasek promocyjny + licznik | Urgency, data końca promocji | góra strony |
| Formularz w hero | Lead od razu na pierwszym ekranie | hero |
| Telefon-CTA w nagłówku | Lepki, zawsze widoczny | header |
| Pływające przyciski | Telefon + WhatsApp (z pulsowaniem) | prawy dół |
| Pasek mobilny | „Zadzwoń / Bezpłatna wycena" | dół (mobile) |
| Pop-up oferty | Po 12 s lub przy wyjściu (exit-intent) | całość |
| Animowane liczniki | Social proof liczbowy | sekcja statystyk |
| Opinie z gwiazdkami | Social proof | sekcja opinii |
| Sekcja korzyści | Edukacja + budowanie pożądania (podłogówka) | po usługach |
| WhatsApp click-to-chat | Gotowa wiadomość startowa | wiele miejsc |
| Cookie / RODO | Pasek zgody | dół |
| Back-to-top | Wygodna nawigacja | prawy dół |

Wszystkie teksty (telefon, promocje, treść pop-upu, godziny) są **edytowalne
bez kodu** w panelu **Wygląd → Dostosuj → FlowInstal**.

---

## 5. SEO lokalne (wbudowane)

- **Dane strukturalne Schema.org**: `LocalBusiness` + `HVACBusiness` + `Plumber`,
  obszar działania jako `GeoCircle` (promień 20 km od Brzezin), godziny otwarcia,
  oferowane usługi, oceny (`AggregateRating`).
- **FAQPage** — szansa na rozszerzone wyniki (rich snippet) w Google.
- **Meta geo**: region `PL-LD`, współrzędne Brzezin, Open Graph, `theme-color`.
- **Wydajność**: brak ciężkich frameworków (czysty CSS/JS), font z `display=swap`,
  `preconnect` do Google Fonts, leniwe ładowanie mapy, wyłączone zbędne elementy WP
  (emoji, generator). To wspiera Core Web Vitals i pozycjonowanie.
- Słowa kluczowe intencyjne w treści: „hydraulik Brzeziny", „ogrzewanie podłogowe
  Nowosolna", „instalacje wod-kan Łódź Widzew" itp.

---

## 6. Formularze i obsługa leadów

Trzy formularze (hero, pop-up, sekcja kontakt) działają tak samo:
- **Walidacja w przeglądarce** — telefon min. 9 cyfr, poprawny e-mail, wymagana zgoda.
- **Wysyłka AJAX** — bez przeładowania strony, z komunikatem sukcesu/błędu.
- **E-mail** — zapytanie trafia na adres ustawiony w Customizerze (lub admina WP).
- **Kopia w panelu** — każdy lead zapisywany jako wpis w sekcji **„Zapytania (leady)"**
  (na wypadek, gdyby e-mail nie dotarł).
- **Antyspam** — honeypot (ukryte pole-pułapka) + nonce WordPress.

> ℹ️ Aby e-maile na pewno dochodziły, na docelowym hostingu warto dodać wtyczkę
> **WP Mail SMTP** (typowa konfiguracja serwera, niezależna od motywu).

---

## 7. Responsywność (desktop / mobile)

Motyw jest **mobile-first**. Sprawdzone breakpointy: ≤1024 px (tablet),
≤768 px (telefon), ≤420 px (małe telefony).

Na telefonie:
- menu zwija się do **hamburgera** (pełnoekranowe),
- sekcje układają się w **jedną kolumnę**,
- pojawia się **dolny pasek** „Zadzwoń / Bezpłatna wycena",
- pływające przyciski przesuwają się nad pasek.

Wygenerowane zrzuty (desktop i mobile, pierwszy ekran + cała strona) zostały
przesłane w czacie. To realny render kodu, nie makieta.

---

## 8. Jak obejrzeć stronę (podgląd)

### A) Samodzielny plik (natychmiast, także offline)
Plik **`FlowInstal-podglad.html`** zawiera całą stronę w jednym pliku
(CSS i JS w środku). Pobierz go i otwórz w przeglądarce na telefonie lub
komputerze. Formularz jest tu **poglądowy** (nie wysyła e-maili).

### B) Trwały adres URL — GitHub Pages (wymaga 1 kliknięcia z Twojej strony)
Workflow publikacji jest gotowy, ale token automatu nie ma prawa **pierwszy raz
włączyć** Pages. Aby uzyskać stały adres:

1. Wejdź w repozytorium na GitHub → **Settings** → **Pages**.
2. W sekcji **Build and deployment → Source** wybierz **„GitHub Actions"**.
3. Napisz mi „gotowe" — uruchomię publikację.
4. Strona pojawi się pod adresem:
   **`https://instalatorhydraulika-cloud.github.io/instalator24.pl/`**

> Uwaga: podgląd na Pages pokazuje **stronę główną** (statycznie). Pełna
> funkcjonalność (wysyłka maili, panel ustawień) działa dopiero w instalacji
> WordPress (punkt 9).

---

## 9. Instalacja na WordPressie (docelowo)

1. Spakuj folder `wp-content/themes/flowinstal` do pliku **ZIP** (sam folder `flowinstal`).
2. Panel WordPress → **Wygląd → Motywy → Dodaj nowy → Wyślij motyw** → wgraj ZIP → **Włącz**.
3. Utwórz pustą stronę (np. „Start") i ustaw ją jako stronę główną w
   **Ustawienia → Czytanie** (szablon `front-page.php` sam wyświetli landing page).
4. Uzupełnij dane w **Wygląd → Dostosuj → FlowInstal** (telefon, e-mail, mapa, promocje).

Alternatywnie: skopiuj folder `flowinstal` do `wp-content/themes/` przez FTP.

---

## 10. Status i lista do uzupełnienia

### ✅ Gotowe
- [x] Kompletny motyw WordPress (14 sekcji, w pełni responsywny).
- [x] Wszystkie elementy konwersji (pop-up, paski, pływające przyciski, liczniki).
- [x] Local SEO (Schema.org, FAQ, meta geo).
- [x] Działające formularze (AJAX, walidacja, zapis leadów, antyspam).
- [x] Panel ustawień bez kodowania (Customizer).
- [x] Statyczny podgląd + workflow publikacji + samodzielny plik HTML.
- [x] Zrzuty desktop/mobile.

### ⬜ Do uzupełnienia przez właściciela
- [ ] Prawdziwy **numer telefonu** i **e-mail** (domyślnie wartości przykładowe).
- [ ] Linki do **Facebooka / Instagrama / wizytówki Google / OLX**.
- [ ] Adres osadzenia **mapy Google** (Dostosuj → Mapa Google).
- [ ] **Zdjęcia realizacji** (obecnie placeholdery) — sekcja „Realizacje".
- [ ] **Własne zdjęcie** do sekcji „O mnie".
- [ ] **Prawdziwe opinie** klientów (po zebraniu na wizytówce Google).
- [ ] Strona **Polityka prywatności** (Ustawienia → Prywatność).
- [ ] (Opcjonalnie) jednorazowe włączenie **GitHub Pages** dla podglądu online.

---

## 11. Stack i decyzje techniczne

- **WordPress (motyw klasyczny PHP)** — łatwa edycja treści przez właściciela,
  niezależność od zewnętrznych kreatorów, pełna kontrola nad SEO i wydajnością.
- **Czysty CSS (zmienne CSS, Grid/Flexbox)** i **Vanilla JS** — bez Bootstrapa,
  bez jQuery, zgodnie z wytycznymi briefu (lekkość i szybkość ładowania).
- **Ikony SVG wbudowane w kod** — brak zewnętrznych fontów ikon (mniej zapytań).
- **Kolorystyka**: granat `#0f172a`, akcent błękit `#0ea5e9` (motyw „flow"/woda),
  jasne tła `#f8fafc` / `#f1f5f9`, tekst `#334155` — paleta budująca zaufanie.
- **Font Inter** (z fallbackiem systemowym `system-ui`) — czytelny, nowoczesny.

---

## 12. Pliki dokumentacji w repo

- `README.md` — skrócona instrukcja instalacji i konfiguracji.
- `DOKUMENTACJA.md` — ten plik (pełny opis stanu projektu).
