# Dokumentacja projektu — FlowInstal (strona statyczna)

> Stan na: **19.07.2026** · Gałąź robocza: `claude/wordpress-brzeziny-site-egws1w`
> Repozytorium: `instalatorhydraulika-cloud/instalator24.pl`

Ten dokument opisuje **aktualny stan projektu** po przejściu z WordPressa na
w pełni **statyczną stronę** (HTML + CSS + JavaScript, bez backendu).

---

## 1. Czym jest projekt

Szybka, konwersyjna strona dla firmy instalatorskiej **FlowInstal**
(właściciel: **Maciej Kolasa**), z marketingiem skupionym na **wodnym
ogrzewaniu podłogowym**, nastawiona na **rynek lokalny: Brzeziny i okolice
(woj. łódzkie)** w promieniu 20 km — Stryków, Andrespol, Koluszki, Nowosolna,
Łódź Widzew, Rogów, Jeżów.

Profil: ogrzewanie podłogowe (projekt pętli, rozdzielacze, strefy, podłączenie
pompy ciepła / kotła na pelet, próby ciśnieniowe, rozruch) oraz uzupełniająco
instalacje wod-kan. Wyceny **po wizji lokalnej** (brak publicznego cennika).

---

## 2. Architektura — dlaczego statyczna (zamiast WordPressa)

Wcześniejsza wersja była motywem WordPress. Na życzenie przepisano ją na
**czysty statyczny serwis**. Korzyści:

| WordPress (poprzednio) | Statyczna strona (obecnie) |
|---|---|
| PHP + baza danych + wtyczki | Same pliki HTML/CSS/JS |
| Wolniejsze ładowanie, wiele zapytań | Błyskawiczne ładowanie |
| Aktualizacje, kopie, bezpieczeństwo | Praktycznie zerowa konserwacja |
| Hosting z PHP/MySQL | Hosting gdziekolwiek (też darmowy) |
| Formularz przez backend | Formularz przez Web3Forms (bez backendu) |

---

## 3. Struktura plików

```
/
├── index.html                  # Cała strona główna (14 sekcji)
├── polityka-prywatnosci.html   # Podstrona (szablon do uzupełnienia)
├── 404.html                    # Strona błędu 404
├── css/style.css               # System projektowy + style + responsywność
├── js/main.js                  # Interakcje + wysyłka formularza (Web3Forms)
├── assets/
│   ├── favicon.svg             # Ikona strony (logo w gradiencie)
│   └── screenshot.png          # Obraz Open Graph (podgląd w social media)
├── robots.txt                  # Indeksowanie + wskazanie sitemapy
├── sitemap.xml                 # Mapa strony
├── site.webmanifest            # Manifest PWA (ikona, kolory)
├── .nojekyll                   # Wyłącza przetwarzanie Jekyll na GitHub Pages
└── .github/workflows/
    └── deploy-pages.yml        # Opcjonalna auto-publikacja na GitHub Pages
```

---

## 4. Sekcje strony głównej (kolejność w `index.html`)

1. **Pasek promocyjny** — komunikat + opcjonalny licznik czasu (`#fi-countdown`).
2. **Nagłówek (sticky)** — logo, menu, telefon-CTA, hamburger na mobile.
3. **Hero** — H1 o ogrzewaniu podłogowym, opis, 2× CTA, sygnały zaufania
   (projekt pętli / próby ciśnieniowe / pod pompę ciepła) + formularz wyceny.
4. **Pasek zaufania** — 5 szybkich argumentów.
5. **Usługi** — 4 karty: podłogówka, rozdzielacze i strefy, podłączenie źródła
   ciepła (pompa ciepła / kocioł), wod-kan uzupełniająco.
6. **Korzyści ogrzewania podłogowego** — 6 kafelków (komfort, oszczędność,
   pompa ciepła, estetyka, mikroklimat, ciepła podłoga).
7. **Statystyki** — animowane liczniki (m² podłogówki).
8. **Dlaczego ja (USP)** — projekt, szczelność z protokołem, elastyczność.
9. **Proces** — montaż podłogówki w 4 krokach (wizja lokalna → projekt+wycena →
   montaż → próby/rozruch).
10. **O mnie** — budowanie zaufania, lista kompetencji, podpis wykonawcy.
11. **Realizacje** — galeria 6 kafelków (do podmiany na zdjęcia).
12. **Opinie** — 3 referencje z gwiazdkami i lokalizacją.
13. **Obszar działania** — lista miejscowości + mapa Google + „darmowy dojazd".
14. **FAQ** — accordion (7 pytań o podłogówkę), zgodny z danymi strukturalnymi.
15. **CTA** — pasek z telefonem i WhatsApp.
16. **Kontakt** — dane teleadresowe + pełny formularz zapytania.
17. **Stopka** — kolumny, social media, mapa linków, prawa autorskie.

Dodatkowo (poza sekcjami): pływające przyciski telefon/WhatsApp, dolny pasek
mobilny, pop-up oferty, przycisk „do góry", pasek cookie/RODO.

---

## 5. Formularz i obsługa zapytań (Web3Forms)

Trzy formularze (hero, pop-up, kontakt) działają tak samo:
- **Walidacja w przeglądarce** — telefon min. 9 cyfr, e-mail, wymagana zgoda.
- **Wysyłka przez Web3Forms** — usługa dostarcza zapytanie e-mailem, bez backendu.
- **Antyspam** — ukryte pole-pułapka (honeypot).

**Konfiguracja (jednorazowo):** pobierz darmowy klucz z https://web3forms.com
(podajesz tylko e-mail) i wklej go w `js/main.js`:
```js
var WEB3FORMS_KEY = 'TWÓJ-KLUCZ';
```
Dopóki klucz nie jest ustawiony, formularz działa w trybie demonstracyjnym.
Telefon i WhatsApp działają zawsze, niezależnie od formularza.

---

## 6. SEO lokalne (wbudowane)

- **Schema.org** (JSON-LD w `<head>`): `LocalBusiness` + `HVACBusiness` +
  `Plumber`, obszar działania jako `GeoCircle` (20 km), godziny, oferta, oceny.
- **FAQPage** — szansa na rozszerzone wyniki (rich snippet) w Google.
- **Meta**: opis, geo (region łódzki, współrzędne Brzezin), Open Graph, canonical.
- **robots.txt** + **sitemap.xml**.
- Wydajność: brak frameworków, jeden plik CSS i JS, font z `display=swap`,
  `preconnect`, leniwe ładowanie mapy.

> Pamiętaj podmienić `https://flow-instal.pl` na docelową domenę w `index.html`
> (canonical/JSON-LD), `robots.txt` i `sitemap.xml`.

---

## 7. Responsywność (desktop / mobile)

Mobile-first. Breakpointy: ≤1024 px (tablet), ≤768 px (telefon), ≤420 px
(małe telefony). Na telefonie: menu → hamburger, sekcje w jednej kolumnie,
dolny pasek „Zadzwoń / Bezpłatna wycena". Sprawdzono brak przepełnienia
poziomego na 360 i 390 px.

---

## 8. Historia zmian (najważniejsze)

- **v1** — motyw WordPress (14 sekcji, konwersja, SEO, formularz AJAX).
- **v2** — przestawienie marketingu na **ogrzewanie podłogowe**, usunięcie
  sekcji cennika (wycena po wizji lokalnej), dodanie sekcji korzyści,
  naprawa błędów CSS (m.in. „puchnące" ikony SVG, `.fi-hero-card`).
- **v3 (obecna)** — przejście na **statyczną stronę** (bez WordPressa):
  `index.html` + `css` + `js`, formularz przez Web3Forms, favicon, manifest,
  robots, sitemap, 404, polityka prywatności; naprawa przepełnienia mobile.

---

## 9. Lista do uzupełnienia przez właściciela

- [ ] Prawdziwy **telefon** i **e-mail** (`index.html`, `404.html`).
- [ ] **Klucz Web3Forms** w `js/main.js`.
- [ ] Linki **Facebook / Instagram / Google** (stopka).
- [ ] Adres osadzenia **mapy Google** (sekcja „Obszar działania").
- [ ] **Zdjęcia realizacji** i **własne zdjęcie** (sekcje „Realizacje", „O mnie").
- [ ] **Prawdziwe opinie** klientów.
- [ ] Docelowa **domena** (canonical, sitemap, robots).
- [ ] Uzupełnić **politykę prywatności**.

---

## 10. Podgląd online

- **GitHub Pages** — po włączeniu (`Settings → Pages → Source: GitHub Actions`)
  strona publikuje się automatycznie dzięki workflow `deploy-pages.yml`.
- **Podgląd przez githack** (bez żadnej konfiguracji):
  `https://raw.githack.com/instalatorhydraulika-cloud/instalator24.pl/claude/wordpress-brzeziny-site-egws1w/index.html`
