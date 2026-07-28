# Projekt: flow-instal.pl (strona statyczna FlowInstal)

> Ten plik czyta **Claude Code uruchomiony lokalnie** na komputerze właściciela.
> Daje mu od razu kontekst serwera i sposób wdrażania/edycji.

## Czym jest projekt
Statyczna strona (HTML/CSS/JS, **bez WordPressa**) firmy instalatorskiej
FlowInstal — ogrzewanie podłogowe, Brzeziny i okolice. Pliki serwisu:
`index.html`, `css/`, `js/`, `assets/`, `robots.txt`, `sitemap.xml`,
`site.webmanifest`, `404.html`, `polityka-prywatnosci.html`.

## Serwer (LH.pl)
- **Host**: `serwer437820.lh.pl`
- **Port SSH**: `40022`
- **Użytkownik**: `serwer437820` (dane = konto główne FTP)
- **Logowanie**: hasłem (LH nie obsługuje kluczy w panelu → `ssh`/`scp` zapytają
  o hasło interaktywnie). Hasła NIE zapisuj w plikach ani w gicie.
- **Katalog domeny** (POTWIERDŹ przy pierwszym wejściu):
  `public_html/flow-instal.pl` — sprawdź: `ssh -p 40022 serwer437820@serwer437820.lh.pl "ls ~/public_html/"`

## Alias SSH (opcjonalnie, wygodniej) — `~/.ssh/config`
```sshconfig
Host flow
    HostName serwer437820.lh.pl
    Port 40022
    User serwer437820
```
Wtedy: `ssh flow "ls ~/public_html/"`.

## Wdrożenie (upload całej strony)
Z katalogu projektu, w Git Bash lub PowerShell:
```bash
scp -P 40022 -r index.html 404.html polityka-prywatnosci.html robots.txt \
  sitemap.xml site.webmanifest css js assets \
  serwer437820@serwer437820.lh.pl:public_html/flow-instal.pl/
```
Albo skrypt: `bash deploy-lh.sh` (Git Bash) lub
`powershell -ExecutionPolicy Bypass -File .\deploy-lh.ps1` (PowerShell).

## Edycja „na serwerze" (workflow)
Dla strony statycznej najbezpieczniej: **edytuj plik lokalnie → wgraj scp**.
Szybki upload pojedynczego pliku po zmianie:
```bash
scp -P 40022 index.html serwer437820@serwer437820.lh.pl:public_html/flow-instal.pl/
scp -P 40022 css/style.css serwer437820@serwer437820.lh.pl:public_html/flow-instal.pl/css/
```
Podgląd pliku wprost z serwera (do weryfikacji):
```bash
ssh -p 40022 serwer437820@serwer437820.lh.pl "sed -n '1,40p' public_html/flow-instal.pl/index.html"
```
Backup przed większą zmianą:
```bash
ssh -p 40022 serwer437820@serwer437820.lh.pl "cd public_html/flow-instal.pl && cp index.html index.html.bak.\$(date +%s)"
```
Test, że strona żyje:
```bash
curl -sI https://flow-instal.pl/ | head -1     # oczekiwane: HTTP/... 200
```

## Do zrobienia po wdrożeniu
- Włączyć **SSL (Let's Encrypt)** w panelu LH (strona używa `https://`).
- Wkleić **klucz Web3Forms** w `js/main.js` (żeby formularz wysyłał e-maile).
- Podmienić prawdziwy **telefon/e-mail**, linki social, mapę Google, zdjęcia.
- **Zmienić hasło** konta FTP/SSH (było podane w czacie = ujawnione).

## Uwagi
- To NIE jest WordPress — bez WP-CLI, bez motywu, bez bazy.
- Nie commituj haseł ani `~/.ssh/id_*` do gita.
