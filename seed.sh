#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Isolated Catalog Database Re-seed Script
# ==============================================================================
set -euo pipefail

echo "[*] Re-seeding store catalog and procedural SVG artwork..."
php artisan migrate:fresh --seed --force
echo "[OK] Catalog refresh successfully executed."
