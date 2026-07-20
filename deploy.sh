#!/usr/bin/env bash
# =============================================================================
#  FlowInstal — wdrożenie strony na serwer przez SSH (szyfrowane, rsync)
# =============================================================================
#  Uruchom z WŁASNEGO komputera (nie z chmury), z katalogu projektu:
#      bash deploy.sh
#
#  Wymagania: zainstalowane `rsync` i `ssh` (Linux/macOS mają je zwykle
#  domyślnie; na Windows użyj Git Bash lub WSL).
#
#  NAJPIERW uzupełnij 4 wartości poniżej danymi z panelu hostingu.
#  Zalecane logowanie kluczem SSH (patrz WDROZENIE.md) — bezpieczniejsze
#  niż hasło. Przy haśle rsync/ssh zapyta o nie interaktywnie.
# =============================================================================
set -euo pipefail

# ----- DANE SERWERA (uzupełnij) ----------------------------------------------
SSH_USER="TWOJ_LOGIN"                 # login SSH/FTP z panelu hostingu
SSH_HOST="flow-instal.pl"             # host SSH (czasem inny, np. s123.hostingxyz.pl)
SSH_PORT="22"                         # port SSH (często 22; bywa inny)
REMOTE_DIR="domains/flow-instal.pl/public_html"   # katalog domeny na serwerze
# SSH_KEY="$HOME/.ssh/id_ed25519"     # (opcjonalnie) ścieżka do klucza SSH
# -----------------------------------------------------------------------------

SSH_OPTS="-p ${SSH_PORT}"
[ -n "${SSH_KEY:-}" ] && SSH_OPTS="${SSH_OPTS} -i ${SSH_KEY}"

echo "▶ Wgrywam stronę na ${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}"

rsync -avz --delete \
  --exclude '.git' \
  --exclude '.github' \
  --exclude '.gitignore' \
  --exclude '_build' \
  --exclude '_preview' \
  --exclude 'deploy.sh' \
  --exclude 'README.md' \
  --exclude 'DOKUMENTACJA.md' \
  --exclude 'WDROZENIE.md' \
  -e "ssh ${SSH_OPTS}" \
  ./ "${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}/"

echo "✔ Gotowe. Sprawdź: https://flow-instal.pl"
