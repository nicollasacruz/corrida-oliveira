#!/bin/sh
set -e

cd /var/www

# Criar diretórios necessários se não existirem
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

# Ajustar permissões
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Garantir que o SQLite exista e tenha permissões corretas
if [ ! -f /var/www/database/database.sqlite ]; then
    touch /var/www/database/database.sqlite
    chown www-data:www-data /var/www/database/database.sqlite
fi

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
