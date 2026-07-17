# 💌 Olga & Jakub — strona ślubna

Samodzielna, statyczna strona z zaproszeniem, potwierdzeniem obecności (RSVP),
wyborem menu i alergiami. Zoptymalizowana pod **telefon**. Bez zależności i bez
frameworków — wystarczy otworzyć `index.html`.

## Pliki
```
wedding/
├── index.html   ← treść (imiona, data, teksty, sekcje)
├── style.css    ← wygląd i kolory
├── script.js    ← animacje, odliczanie, formularz RSVP, galeria/lightbox
└── assets/      ← zdjęcia (photo-1..5.jpg + miniatury thumb-1..5.jpg)
```

Zdjęcia są już wgrane, wyprostowane (EXIF), wykadrowane i zoptymalizowane pod web.

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
| Zdjęcia (galeria, oś czasu, sekcja zaręczyn) | katalog `assets/` — podmień pliki `photo-*.jpg` i `thumb-*.jpg` (zachowaj nazwy) lub edytuj `<img>` w `index.html` |
| Kolory (szałwiowy / masłowy) | `style.css`, sekcja `:root` na górze |
| Datę ślubu dla odliczania | `script.js`, stała `WEDDING_DATE` |
| Termin RSVP | `script.js`, stała `RSVP_DEADLINE` |

## RSVP — wersja demo
Obecnie formularz **zapisuje odpowiedzi lokalnie** (localStorage, tylko na danym
urządzeniu) i pokazuje podziękowanie. To wersja pokazowa.

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
