#!/bin/sh
mkdir -p /var/log/supervisor
chown www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database 2>/dev/null || true
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
