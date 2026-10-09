#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Syntax & Code Style Linter
# ==============================================================================
set -euo pipefail

echo "[*] Linting PHP source code..."
find app -name "*.php" -exec php -l {} \; > /dev/null
echo "[OK] All PHP source files verified without syntax errors."
