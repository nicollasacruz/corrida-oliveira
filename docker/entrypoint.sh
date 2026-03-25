#!/bin/sh
set -e

cd /var/www

# Criar diretórios necessários se não existirem
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# Otimizar SQLite para produção
export SQLITE_BUSY_TIMEOUT=5000
export SQLITE_CACHE_SIZE=-32000
export SQLITE_JOURNAL_MODE=WAL
export SQLITE_SYNCHRONOUS=NORMAL

# Criar arquivo SQLite se não existir
if [ ! -f /var/www/database/database.sqlite ]; then
    touch /var/www/database/database.sqlite
fi

# Ajustar permissões
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache
chown www-data:www-data /var/www/database/database.sqlite
chmod 664 /var/www/database/database.sqlite

# Gerar key se não existir
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    php artisan key:generate --force
fi

# Rodar migrations
php artisan migrate --force

# Otimizar Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Iniciar supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
