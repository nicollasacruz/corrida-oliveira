FROM php:8.3-fpm-alpine

# Instalar dependências do sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    nodejs \
    npm \
    icu-data-full \
    libpng \
    libjpeg-turbo \
    freetype \
    libzip \
    zip \
    unzip

# Instalar extensões PHP usando script otimizado (MUITO mais rápido!)
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

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar apenas arquivos de dependência primeiro (cache)
COPY composer.json composer.lock ./

# Instalar dependências do PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copiar o resto do projeto
COPY . .

# Rodar scripts do composer
RUN composer run post-autoload-dump

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
