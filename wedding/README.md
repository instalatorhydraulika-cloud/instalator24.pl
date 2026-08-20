# 💌 Olga & Jakub — strona ślubna

Samodzielna, statyczna strona z zaproszeniem, potwierdzeniem obecności (RSVP),
wyborem diety, menu i alergii. Zoptymalizowana pod **telefon**. Bez zależności i bez
frameworków — wystarczy otworzyć `index.html`.

**Ślub:** 20 sierpnia 2027 (piątek) · ceremonia 17:00 · wesele 19:00.

## Pliki
```
wedding/
├── index.html   ← treść (imiona, data, teksty, sekcje)
├── style.css    ← wygląd i kolory
├── script.js    ← animacje koperty, odliczanie, formularz RSVP
└── assets/      ← hero.jpg (jedyne zdjęcie na stronie) + archiwum photo-*/thumb-*
```

### Zdjęcie `assets/hero.jpg`
Strona używa **jednego** zdjęcia — `assets/hero.jpg` (1200×1799, ok. 390 KB).
Pojawia się w dwóch miejscach: w sekcji hero (w łuku z girlandą) oraz na karcie
„Dziękujemy" po wysłaniu RSVP.

Aby je podmienić, wgraj swój plik pod tą samą nazwą (`wedding/assets/hero.jpg`).
Zalecane: kadr **pionowy** ok. 2:3 (np. 1200×1800 px), zapisany bez danych EXIF.
Łuk w hero pokazuje całą wysokość zdjęcia i lekko przycina boki, więc zostaw
trochę marginesu po bokach kadru.

Pozostałe pliki `photo-*.jpg` / `thumb-*.jpg` nie są już nigdzie używane
(galeria i oś czasu zostały usunięte) — można je zostawić jako archiwum albo skasować.

## Jak podejrzeć
Otwórz `index.html` w przeglądarce (najlepiej w trybie widoku mobilnego).
Albo lokalny serwer:
```
cd wedding
python3 -m http.server 8080   # → http://localhost:8080
```

## Co łatwo zmienić (bez programowania)
| Chcę zmienić… | Gdzie |
|---|---|
| Imiona, datę, teksty | `index.html` |
| Godziny w „Planie dnia" | `index.html`, sekcja `id="plan"` |
| Zdjęcie na stronie | podmień `assets/hero.jpg` (zachowaj nazwę) |
| Adresy i pinezki Google Maps | `index.html` — linki `ag-map` (plan dnia) i `ic-map` (informacje) |
| Kolory (szałwiowy / masłowy) | `style.css`, sekcja `:root` na górze |
| Datę ślubu dla odliczania | `script.js`, stała `WEDDING_DATE` |
| Termin RSVP | `script.js`, stała `RSVP_DEADLINE` |
| Opcje diety / alergii | `index.html`, sekcja `id="rsvp"` |

## RSVP — wersja demo
Obecnie formularz **zapisuje odpowiedzi lokalnie** (localStorage, tylko na danym
urządzeniu) i pokazuje kartę podziękowania ze zdjęciem. To wersja pokazowa.

Gość podaje: obecność, liczbę osób, **dietę** (jem wszystko / wegetariańska /
wegańska), danie główne, **alergie** (lista + pole na własne) oraz piosenkę i wiadomość.
Wybór diety wegetariańskiej lub wegańskiej automatycznie blokuje dania mięsne i rybne.

### Podłączenie prawdziwego odbioru odpowiedzi (na później)
Najprościej przez [Formspree](https://formspree.io) (darmowy plan):
1. Załóż formularz na Formspree i skopiuj jego ID (np. `xyzabcd`).
2. W `index.html` zmień `<form id="rsvpForm" ...>` na
   `action="https://formspree.io/f/TWOJE_ID" method="POST"`.
3. W `script.js`, w obsłudze `submit`, zamiast zapisu do localStorage wyślij
   dane przez `fetch` na ten adres (lub pozwól na natywne wysłanie formularza).

Alternatywy: Google Forms (podmień przycisk na link do formularza) lub Netlify Forms.

## Publikacja
- **GitHub Pages**: wskaż katalog `wedding/` (jest już plik `.nojekyll`).
- Dowolny hosting statyczny (Netlify, Vercel, zwykły FTP) — wgraj 3 pliki.
