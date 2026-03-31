FROM php:8.3-fpm-alpine

# Instalar dependências
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    nodejs \
    npm \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    zip \
    unzip

# Instalar extensões PHP
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    pdo_sqlite \
    gd \
    zip \
    exif \
    pcntl \
    bcmath \
    opcache \
    intl \
    mbstring

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copiar dependências PHP primeiro (cache)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar código fonte
COPY . .

# Build assets (e remover node_modules depois)
RUN npm ci && npm run build && rm -rf node_modules

# Configurar Laravel
RUN composer run post-autoload-dump && \
    mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache database && \
    touch database/database.sqlite && \
    chown -R www-data:www-data storage bootstrap/cache database && \
    chmod -R 775 storage bootstrap/cache

# Copiar configs
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Criar script de inicialização
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
