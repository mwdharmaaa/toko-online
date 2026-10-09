#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Automated Test Suite Runner
# Verification Standard (@mwdhrmaaa)
# ==============================================================================

set -euo pipefail

echo "================================================================================"
echo "[*] RUNNING AUTOMATED TEST SUITE"
echo "================================================================================"

php artisan test --parallel || php artisan test

echo "[OK] All test assertions satisfied."
