#!/bin/sh
set -e

cd /var/www

# Criar diretórios necessários
mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
mkdir -p /var/log/supervisor /run/nginx

# Criar arquivo SQLite se não existir
if [ ! -f /var/www/database/database.sqlite ]; then
    touch /var/www/database/database.sqlite
fi

# Ajustar permissões apenas nas pastas necessárias (não recursivo em node_modules)
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache
chmod 664 /var/www/database/database.sqlite 2>/dev/null || true

# Otimizar SQLite para produção
export SQLITE_BUSY_TIMEOUT=5000
export SQLITE_JOURNAL_MODE=WAL

# Comandos Laravel (com falha tolerada)
php artisan package:discover --ansi 2>/dev/null || true

if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force --ansi 2>/dev/null || true
fi

php artisan migrate --force --ansi 2>/dev/null || true
php artisan config:cache --ansi 2>/dev/null || true
php artisan route:cache --ansi 2>/dev/null || true
php artisan view:cache --ansi 2>/dev/null || true

# Iniciar supervisor
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
