# Wdrożenie strony na serwer flow-instal.pl (przez SSH)

Strona jest statyczna, więc wdrożenie polega na **skopiowaniu plików** do katalogu
domeny na serwerze. Poniżej trzy sposoby — od najwygodniejszego. Wszystkie
używają **szyfrowanego połączenia SSH**.

> ⚠️ Uruchamiaj to z **własnego komputera**. Nie przekazuj nikomu (ani żadnej
> usłudze w chmurze) hasła do serwera.

---

## ⭐ Szybka ścieżka dla LH.pl (Twój serwer) — skrypt `deploy-lh.sh`

Masz już skonfigurowany klucz SSH na LH (wg Twojego workflow). Skrypt
`deploy-lh.sh` jest ustawiony pod LH: host `serwer151640.lh.pl`, port `40022`,
użytkownik `serwer151640`, klucz `~/.ssh/id_ed25519`. Działa w **Git Bash**
(używa `scp`, nie wymaga `rsync`).

**Krok 1 — potwierdź, że SSH działa i znajdź katalog domeny:**
```bash
ssh -p 40022 -i ~/.ssh/id_ed25519 serwer151640@serwer151640.lh.pl 'ls ~/public_html/'
```
Na liście znajdź folder domeny **flow-instal.pl**. To strona **statyczna**
(nie WordPress!), więc pliki idą do katalogu domeny — zwykle
`public_html/flow-instal.pl`, a NIE do `.../autoinstalator/.../wordpressNNN/`.
Jeśli nie widać folderu domeny, sprawdź w panelu LH, jaki jest **katalog
docelowy** domeny flow-instal.pl (Domeny → flow-instal.pl → katalog).

**Krok 2 — wpisz właściwą ścieżkę** w `deploy-lh.sh` w linii `REMOTE_DIR=...`
(domyślnie `public_html/flow-instal.pl`).

**Krok 3 — wgraj stronę:**
```bash
cd /sciezka/do/pobranego/projektu
bash deploy-lh.sh
```
Skrypt utworzy katalogi i skopiuje wszystkie pliki strony. Na koniec wejdź na
**https://flow-instal.pl** (CTRL+SHIFT+R). W panelu LH włącz **SSL (Let's
Encrypt)**, jeśli jeszcze nieaktywny.

**Test po wgraniu (opcjonalnie):**
```bash
curl -sI https://flow-instal.pl/ | head -1        # powinno być HTTP/... 200
```

> Uwaga: to jest strona statyczna — nie używamy tu WP-CLI ani motywu. Cały serwis
> to pliki: `index.html`, `css/`, `js/`, `assets/`, `robots.txt`, `sitemap.xml`,
> `site.webmanifest`, `404.html`, `polityka-prywatnosci.html`.

---

## Krok 0 — dane z panelu hostingu

Znajdź w panelu swojego hostingu (zakładka „SSH/FTP" lub „Dostęp SSH"):
- **login** (użytkownik SSH),
- **host** (często `flow-instal.pl`, czasem osobny adres serwera),
- **port SSH** (zwykle `22`),
- **katalog domeny** — najczęściej `domains/flow-instal.pl/public_html`
  albo `public_html` (zależnie od hostingu).

Sprawdź, czy masz aktywny **dostęp SSH** (na części hostingów trzeba go włączyć
w panelu jednym kliknięciem).

---

## Sposób A — skrypt `deploy.sh` (rsync, zalecany)

`rsync` wysyła tylko zmienione pliki i potrafi usuwać zbędne — idealny do
aktualizacji.

1. Pobierz projekt na komputer (np. „Code → Download ZIP" na GitHub albo `git clone`).
2. Otwórz `deploy.sh` i uzupełnij `SSH_USER`, `SSH_HOST`, `SSH_PORT`, `REMOTE_DIR`.
3. W terminalu, w katalogu projektu:
   ```bash
   bash deploy.sh
   ```
   (Windows: użyj **Git Bash** lub **WSL**.)

---

## Sposób B — jedno polecenie rsync (bez skryptu)

```bash
rsync -avz --delete \
  --exclude '.git' --exclude '.github' --exclude '_build' --exclude '_preview' \
  --exclude 'deploy.sh' --exclude '*.md' \
  -e "ssh -p 22" \
  ./  TWOJ_LOGIN@flow-instal.pl:domains/flow-instal.pl/public_html/
```

## Sposób C — scp (jeśli nie masz rsync)

```bash
scp -P 22 -r index.html 404.html polityka-prywatnosci.html robots.txt \
  sitemap.xml site.webmanifest css js assets \
  TWOJ_LOGIN@flow-instal.pl:domains/flow-instal.pl/public_html/
```

Albo klientem graficznym **FileZilla / WinSCP** przez **SFTP** (to też SSH):
przeciągnij pliki (`index.html`, `css/`, `js/`, `assets/`, `robots.txt`,
`sitemap.xml`, `site.webmanifest`, `404.html`, `polityka-prywatnosci.html`) do
katalogu domeny.

---

## Zalecane: logowanie kluczem SSH (bezpieczniejsze niż hasło)

1. Wygeneruj klucz (jeśli nie masz):
   ```bash
   ssh-keygen -t ed25519 -C "flow-instal-deploy"
   ```
2. Wgraj klucz publiczny na serwer:
   ```bash
   ssh-copy-id -p 22 TWOJ_LOGIN@flow-instal.pl
   ```
   (lub dodaj zawartość `~/.ssh/id_ed25519.pub` w panelu hostingu → „Klucze SSH").
3. Od tej pory `deploy.sh` łączy się bez podawania hasła.

---

## Po wgraniu — włącz HTTPS (SSL) i sprawdź

1. W panelu hostingu włącz **certyfikat SSL** (zwykle darmowy **Let's Encrypt**,
   jedno kliknięcie) i **wymuszenie HTTPS**. Strona używa adresów `https://…`,
   więc SSL powinien być aktywny.
2. Upewnij się, że domena `flow-instal.pl` wskazuje na ten katalog (DNS/„domena
   główna" w panelu).
3. Wejdź na **https://flow-instal.pl** — powinna pojawić się strona.
4. Uzupełnij jeszcze:
   - **klucz Web3Forms** w `js/main.js` (żeby formularz wysyłał e-maile),
   - prawdziwy **telefon/e-mail**, linki social, mapę Google, zdjęcia.

---

## Aktualizacje w przyszłości

Po każdej zmianie plików uruchom ponownie `bash deploy.sh` — rsync wyśle tylko
to, co się zmieniło.
