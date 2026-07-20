#!/usr/bin/env bash
# =============================================================================
#  FlowInstal (strona statyczna) → wdrożenie na LH.pl przez SSH (scp)
# =============================================================================
#  Uruchom z WŁASNEGO komputera w Git Bash, z katalogu projektu:
#      bash deploy-lh.sh
#
#  Działa w Git Bash (Windows) — używa scp w pętli, nie wymaga rsync.
#  Wymaga skonfigurowanego klucza SSH na LH (jak w Twoim workflow).
# =============================================================================
set -euo pipefail

# ===== POŁĄCZENIE LH (z Twojej dokumentacji) =================================
SSH_HOST="serwer151640.lh.pl"
SSH_USER="serwer151640"
SSH_PORT="40022"
SSH_KEY="$HOME/.ssh/id_ed25519"

# ===== KATALOG DOCELOWY DOMENY (POTWIERDŹ przed pierwszym wgraniem) ==========
# To jest strona STATYCZNA (nie WordPress), więc pliki idą do katalogu domeny,
# a NIE do .../autoinstalator/.../wordpressNNN/. Znajdź właściwą ścieżkę:
#     ssh -p 40022 -i ~/.ssh/id_ed25519 serwer151640@serwer151640.lh.pl 'ls ~/public_html/'
# i wpisz tu folder domeny flow-instal.pl (typowo jedno z poniższych):
REMOTE_DIR="public_html/flow-instal.pl"
# REMOTE_DIR="domains/flow-instal.pl/public_html"
# ============================================================================

SSH="ssh -p ${SSH_PORT} -i ${SSH_KEY}"
SCP="scp -P ${SSH_PORT} -i ${SSH_KEY}"
TARGET="${SSH_USER}@${SSH_HOST}"

BASE="$(cd "$(dirname "$0")" && pwd)"
cd "$BASE"

echo "▶ Wgrywam stronę na ${TARGET}:${REMOTE_DIR} (port ${SSH_PORT})"

# Pliki strony (bez plików developerskich)
find . -type f \
  -not -path './.git/*' \
  -not -path './.github/*' \
  -not -path './_build/*' \
  -not -path './_preview/*' \
  -not -name '.gitignore' \
  -not -name 'deploy*.sh' \
  -not -name '*.md' \
| while read -r f; do
    rel="${f#./}"
    rdir="${REMOTE_DIR}/$(dirname "$rel")"
    ${SSH} "${TARGET}" "mkdir -p '${rdir}'" >/dev/null
    ${SCP} -q "$rel" "${TARGET}:${rdir}/"
    echo "  -> $rel"
done

echo "✔ Gotowe. Sprawdź: https://flow-instal.pl  (twardy reload: CTRL+SHIFT+R)"
