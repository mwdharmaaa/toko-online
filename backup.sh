#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Database and Storage Backup Script
# ==============================================================================
set -euo pipefail

BACKUP_DIR="storage/backups"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
mkdir -p "$BACKUP_DIR"

echo "[*] Creating database backup snapshot..."
if [ -f "database/database.sqlite" ]; then
    cp database/database.sqlite "$BACKUP_DIR/db_$TIMESTAMP.sqlite"
    echo "[OK] Database backed up to $BACKUP_DIR/db_$TIMESTAMP.sqlite"
fi
