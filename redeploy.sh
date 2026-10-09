#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Zero-Friction Redeployment Script
# Single-Enter Update Standard (@mwdhrmaaa)
# ==============================================================================

set -euo pipefail

echo "================================================================================"
echo "[*] INITIATING ZERO-FRICTION REDEPLOYMENT"
echo "================================================================================"

ACTIVE_BRANCH=$(git rev-parse --abbrev-ref HEAD)
echo "[*] Active branch: $ACTIVE_BRANCH"

# 1. Reset local modified state
echo "[*] Resetting local workspace changes..."
git reset --hard HEAD

# 2. Pull latest commits
echo "[*] Pulling latest commits from remote origin..."
git pull origin "$ACTIVE_BRANCH"

# 3. Chain deployment script
echo "[*] Executing deployment lifecycle..."
bash deploy.sh

echo "[OK] Redeployment successfully finalized."
