FROM php:8.2-fpm-alpine

# Instalar dependências do sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    sqlite-dev \
    icu-dev \
    linux-headers \
    $PHPIZE_DEPS

# Instalar extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_sqlite \
    gd \
    zip \
    exif \
    pcntl \
    bcmath \
    opcache \
    intl \
    fileinfo \
    ctype

# Limpar pacotes de desenvolvimento
RUN apk del $PHPIZE_DEPS linux-headers

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependências do Node e buildar assets
RUN npm ci && npm run build

# Ajustar permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && mkdir -p /var/www/database \
    && touch /var/www/database/database.sqlite \
    && chown www-data:www-data /var/www/database/database.sqlite

# Copiar configurações
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expor porta 80
EXPOSE 80

# Entrypoint
ENTRYPOINT ["/entrypoint.sh"]
