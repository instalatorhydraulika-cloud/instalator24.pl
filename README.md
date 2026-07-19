# FlowInstal — strona WWW (statyczna, bez WordPressa)

Szybka, lekka strona wizytówka/landing page dla firmy instalatorskiej
**FlowInstal** (Maciej Kolasa), z marketingiem skupionym na **wodnym ogrzewaniu
podłogowym**, nastawiona na rynek lokalny: **Brzeziny i okolice (woj. łódzkie)**
w promieniu 20 km (Stryków, Andrespol, Koluszki, Nowosolna, Łódź Widzew).

To **czysty statyczny serwis** — HTML + CSS + JavaScript. Bez WordPressa, bez PHP,
bez bazy danych i wtyczek. Hostujesz go wszędzie i ładuje się błyskawicznie.

---

## 📂 Struktura

```
/
├── index.html                  # Cała strona główna (wszystkie sekcje)
├── polityka-prywatnosci.html   # Podstrona polityki prywatności (do uzupełnienia)
├── 404.html                    # Strona błędu 404
├── css/style.css               # Wszystkie style (zmienne CSS, responsywność)
├── js/main.js                  # Interakcje + wysyłka formularza (Web3Forms)
├── assets/
│   ├── favicon.svg             # Ikona strony
│   └── screenshot.png          # Obraz podglądu (Open Graph / social media)
├── robots.txt, sitemap.xml, site.webmanifest, .nojekyll
└── .github/workflows/          # Opcjonalna auto-publikacja na GitHub Pages
```

---

## 🚀 Uruchomienie / hosting

Strona nie wymaga żadnego backendu. Wystarczy wgrać pliki na dowolny hosting:

- **Zwykły hosting / FTP** — skopiuj całą zawartość repozytorium do katalogu
  `public_html` (lub głównego katalogu domeny). Gotowe.
- **GitHub Pages** — w repozytorium: `Settings → Pages → Source: GitHub Actions`.
  Dołączony workflow opublikuje stronę automatycznie.
- **Netlify / Vercel / Cloudflare Pages** — przeciągnij folder lub podłącz repo,
  bez żadnej konfiguracji budowania.

Lokalnie wystarczy otworzyć `index.html` w przeglądarce.

---

## ✉️ Konfiguracja formularza (WAŻNE)

Formularze wysyłają zapytania przez **[Web3Forms](https://web3forms.com)** —
darmową usługę, która nie wymaga backendu ani zakładania konta (podajesz tylko
e-mail, na który mają trafiać zapytania, i dostajesz klucz).

1. Wejdź na **https://web3forms.com**, podaj swój e-mail, skopiuj **Access Key**.
2. Otwórz plik **`js/main.js`** i w pierwszej linii wklej klucz:
   ```js
   var WEB3FORMS_KEY = 'TWÓJ-KLUCZ-Z-WEB3FORMS';
   ```
3. Gotowe — zapytania z formularzy będą przychodzić na Twój e-mail.

> Dopóki klucz nie jest ustawiony, formularz działa w trybie demonstracyjnym
> (waliduje dane, ale nie wysyła e-maili). Telefon i WhatsApp działają zawsze.

---

## ✏️ Co uzupełnić / edytować

Wszystko edytujesz bezpośrednio w plikach (zwykły tekst):

- **Telefon i e-mail** — w `index.html` wyszukaj `+48 600 000 000` oraz
  `kontakt@flowinstal.pl` i podmień na prawdziwe (występują w kilku miejscach:
  nagłówek, kontakt, stopka, przyciski, `404.html`).
- **Klucz formularza** — `js/main.js` (patrz wyżej).
- **Linki social media / Google** — w stopce `index.html` (Facebook, Instagram,
  wizytówka Google).
- **Mapa Google** — w sekcji „Obszar działania" podmień `src` w `<iframe>`
  (w Mapach Google: Udostępnij → Umieść mapę).
- **Zdjęcia realizacji** — sekcja „Realizacje" (obecnie kafelki-placeholdery).
- **Własne zdjęcie** — sekcja „O mnie".
- **Prawdziwe opinie** — sekcja „Opinie".
- **Domena** — w `index.html` (canonical, dane strukturalne), `robots.txt`,
  `sitemap.xml` podmień `https://instalator24.pl` na docelowy adres.
- **Polityka prywatności** — uzupełnij `polityka-prywatnosci.html`.

---

## 💡 Elementy budujące konwersję

Pasek promocyjny z licznikiem, formularz szybkiej wyceny w hero, lepkie CTA
telefon, pływające przyciski telefon + WhatsApp, dolny pasek mobilny, pop-up
(po 12 s / exit-intent), animowane liczniki, opinie z gwiazdkami, sekcja
korzyści, FAQ, cookie/RODO, przycisk „do góry", WhatsApp click-to-chat.

## 🔍 SEO lokalne (wbudowane)

Dane strukturalne Schema.org (`LocalBusiness` + `HVACBusiness` + `Plumber`),
`FAQPage`, meta geo (Brzeziny), Open Graph, canonical, sitemap, robots.txt.
Zoptymalizowane pod frazy typu „ogrzewanie podłogowe Brzeziny".

Wyceny przygotowywane są **po wizji lokalnej** (brak publicznego cennika).
