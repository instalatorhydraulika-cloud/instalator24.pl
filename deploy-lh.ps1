# =============================================================================
#  FlowInstal (strona statyczna) -> wdrozenie na LH.pl przez SSH (PowerShell)
# =============================================================================
#  Uruchom w PowerShell, z katalogu projektu:
#      powershell -ExecutionPolicy Bypass -File .\deploy-lh.ps1
#  Wymaga wbudowanego klienta OpenSSH (Windows 10/11 ma go domyslnie)
#  oraz klucza SSH dodanego w panelu LH.
# =============================================================================
$ErrorActionPreference = "Stop"

# ===== POLACZENIE LH =========================================================
$SSH_HOST  = "serwer437820.lh.pl"
$SSH_USER  = "serwer437820"
$SSH_PORT  = "40022"

# ===== KATALOG DOCELOWY DOMENY (POTWIERDZ) ===================================
# To strona STATYCZNA. Znajdz katalog domeny:
#   ssh -p 40022 serwer437820@serwer437820.lh.pl "ls ~/public_html/"
# i wpisz tu wlasciwy folder (typowo jedno z ponizszych):
$REMOTE_DIR = "public_html/flow-instal.pl"
# $REMOTE_DIR = "domains/flow-instal.pl/public_html"
# ============================================================================

$target = "$SSH_USER@${SSH_HOST}:$REMOTE_DIR"

# Pliki i foldery strony (bez plikow developerskich)
$items = @(
  "index.html",
  "404.html",
  "polityka-prywatnosci.html",
  "robots.txt",
  "sitemap.xml",
  "site.webmanifest",
  ".nojekyll",
  "css",
  "js",
  "assets"
)

$missing = $items | Where-Object { -not (Test-Path $_) }
if ($missing) {
  Write-Host "BLAD: uruchom skrypt w katalogu projektu (brakuje: $($missing -join ', '))." -ForegroundColor Red
  exit 1
}

Write-Host "Tworze katalog docelowy na serwerze..." -ForegroundColor Cyan
ssh -p $SSH_PORT "$SSH_USER@$SSH_HOST" "mkdir -p $REMOTE_DIR"

Write-Host "Wgrywam pliki na $target (port $SSH_PORT)..." -ForegroundColor Cyan
scp -P $SSH_PORT -r @items "${target}/"

Write-Host "Gotowe. Sprawdz: https://flow-instal.pl  (CTRL+SHIFT+R)" -ForegroundColor Green
