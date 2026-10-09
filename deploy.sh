#!/usr/bin/env bash
# ==============================================================================
# Mono Archive - Deployment & Bootstrap Script
# Single-Enter Execution Standard (@mwdhrmaaa)
# ==============================================================================

set -euo pipefail

echo "================================================================================"
echo "[*] INITIATING MONO ARCHIVE STORE DEPLOYMENT"
echo "================================================================================"

# 1. Environment Configuration
if [ ! -f ".env" ]; then
    echo "[*] Copying environment configuration..."
    cp .env.example .env
fi

# 2. Dependency Resolution
echo "[*] Resolving composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# 3. Application Key
if ! grep -q "^APP_KEY=base64:" .env; then
    echo "[*] Generating application key..."
    php artisan key:generate --force
fi

# 4. Database Setup (SQLite)
echo "[*] Initializing SQLite database storage..."
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite 2>/dev/null || true

# 5. Storage Symlink
echo "[*] Connecting storage symbolic link..."
php artisan storage:link 2>/dev/null || true

# 6. Database Migrations & Seeders
echo "[*] Running database migrations and seeding..."
php artisan migrate --force --isolated
php artisan db:seed --force

# 7. Optimization Caches
echo "[*] Warming application cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "================================================================================"
echo "[OK] DEPLOYMENT COMPLETE"
echo "================================================================================"
echo "Storefront URL : http://127.0.0.1:8000"
echo "Admin Panel    : http://127.0.0.1:8000/admin"
echo "Admin User     : admin@monoarchive.id"
echo "Admin Password : admin12345"
echo "================================================================================"
echo "Run 'php artisan serve' to start local server."
