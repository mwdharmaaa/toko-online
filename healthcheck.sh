#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Healthcheck Verification Script
# ==============================================================================
set -euo pipefail

echo "[*] Auditing store health status..."
php artisan store:health
echo "[OK] System audit completed."
