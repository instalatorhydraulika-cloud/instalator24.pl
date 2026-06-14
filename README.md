# FlowInstal — strona WWW (motyw WordPress)

Rozbudowana, konwersyjna strona dla firmy instalatorskiej **FlowInstal** (Maciej Kolasa),
nastawiona na rynek lokalny: **Brzeziny i okolice (woj. łódzkie)** w promieniu 20 km
(Stryków, Andrespol, Koluszki, Nowosolna, Łódź Widzew).

Całość to samodzielny **motyw WordPress** umieszczony w katalogu:

```
wp-content/themes/flowinstal/
```

---

## 🚀 Instalacja (krok po kroku)

### Wariant A — przez panel WordPress (najprostszy)
1. Spakuj folder `wp-content/themes/flowinstal` do pliku ZIP (sam folder `flowinstal`).
2. W panelu WordPress wejdź w **Wygląd → Motywy → Dodaj nowy → Wyślij motyw**.
3. Wgraj plik ZIP i kliknij **Zainstaluj**, a następnie **Włącz**.
4. Wejdź w **Ustawienia → Czytanie** i ustaw „Strona główna wyświetla" na **stronę statyczną**
   (utwórz pustą stronę np. „Start" i wskaż ją jako stronę główną — szablon `front-page.php`
   sam wyświetli pełny landing page).

### Wariant B — przez FTP / menedżer plików
1. Skopiuj folder `flowinstal` do `wp-content/themes/` na serwerze.
2. Włącz motyw w **Wygląd → Motywy**.

---

## ⚙️ Konfiguracja (bez kodowania)

Wszystko ustawisz w: **Wygląd → Dostosuj → FlowInstal — ustawienia**.

| Sekcja | Co ustawisz |
|---|---|
| **Dane kontaktowe** | Telefon, WhatsApp, e-mail, adres, godziny pracy, NIP |
| **Social media i Google** | Linki do Facebooka, Instagrama, wizytówki Google Maps, OLX |
| **Sekcja główna (Hero)** | Nagłówek, podnagłówek, etykieta nad tytułem |
| **Promocja, pasek i pop-up** | Górny pasek promocyjny, licznik czasu, wyskakujące okienko z ofertą |
| **Mapa Google** | Adres osadzenia mapy obszaru działania |
| **Zapytania z formularza** | E-mail, na który mają trafiać leady |

> ⚠️ **Najważniejsze na start:** zmień telefon i e-mail (domyślnie są to wartości
> przykładowe `+48 600 000 000`). To wartości, które klient zobaczy i kliknie.

---

## 💡 Elementy budujące konwersję (wbudowane)

- **Pasek promocyjny** u góry + opcjonalny **licznik czasu** (urgency).
- **Formularz szybkiej wyceny** w sekcji hero (od razu na pierwszym ekranie).
- **Lepkie CTA telefon** w nagłówku + **pływające przyciski** telefon i WhatsApp.
- **Dolny pasek mobilny** „Zadzwoń / Bezpłatna wycena" (tylko na telefonach).
- **Pop-up z ofertą** (po 12 s lub przy próbie opuszczenia strony — exit-intent).
- **Animowane liczniki** (4 lata, 250+ instalacji, 20 km, 100%).
- **Sekcja „Dlaczego ja"** (USP), **proces 1–2–3–4**, **realizacje**, **opinie z gwiazdkami**.
- **Cennik orientacyjny** (transparentność = lepsze leady).
- **Sekcja obszaru działania + mapa Google** (mocny sygnał lokalnego SEO).
- **FAQ** (accordion) zsynchronizowane z danymi strukturalnymi (rich snippet w Google).
- **Pasek cookie (RODO)** i **przycisk „do góry"**.
- **WhatsApp click-to-chat** z gotową wiadomością.

## 🔍 SEO lokalne (wbudowane)

- Dane strukturalne **Schema.org**: `LocalBusiness` + `HVACBusiness` + `Plumber`,
  obszar działania (`GeoCircle` 20 km), godziny otwarcia, oferta, oceny.
- **FAQPage** (szansa na rozszerzone wyniki w Google).
- Meta **geo** (region łódzki, współrzędne Brzezin), Open Graph, `theme-color`.
- Szybkie ładowanie: brak ciężkich frameworków, czysty CSS/JS, font z `display=swap`.

---

## 📨 Formularze i leady

Każdy formularz (hero, pop-up, sekcja kontakt):
- waliduje dane po stronie przeglądarki (telefon min. 9 cyfr, wymagana zgoda),
- wysyła zgłoszenie przez AJAX i **e-mailem** na adres z ustawień,
- zapisuje **kopię zapytania** w panelu: **Zapytania (leady)** — na wypadek, gdyby
  e-mail nie dotarł,
- ma ochronę antyspamową (honeypot + nonce).

> 📧 Jeśli e-maile nie przychodzą, zainstaluj wtyczkę SMTP (np. *WP Mail SMTP*) —
> to typowa konfiguracja serwera, niezależna od motywu.

---

## 📂 Struktura motywu

```
flowinstal/
├── style.css              # System projektowy + wszystkie style
├── functions.php          # Konfiguracja, ikony SVG, helpery
├── header.php / footer.php
├── front-page.php         # Strona główna (składa sekcje)
├── index.php / page.php / single.php / 404.php
├── inc/
│   ├── customizer.php      # Panel ustawień (Wygląd → Dostosuj)
│   ├── contact-form.php    # Formularz + obsługa AJAX + zapis leadów
│   └── schema.php          # Dane strukturalne SEO + FAQ
├── template-parts/        # Sekcje strony głównej
│   ├── hero, trustbar, services, stats, why, process,
│   ├── about, gallery, reviews, pricing, area, faq, cta, contact
└── assets/js/             # main.js (interakcje), customizer.js (podgląd)
```

---

## 📝 Do uzupełnienia przez właściciela

- [ ] Numer telefonu i e-mail (Dostosuj → Dane kontaktowe).
- [ ] Linki do Facebooka / Instagrama / wizytówki Google.
- [ ] Adres osadzenia mapy Google (Dostosuj → Mapa Google).
- [ ] Zdjęcia realizacji (sekcja „Realizacje" — obecnie placeholdery).
- [ ] Własne zdjęcie do sekcji „O mnie".
- [ ] Prawdziwe opinie klientów (po zebraniu na wizytówce Google).
- [ ] Strona „Polityka prywatności" (Ustawienia → Prywatność).
```
