FROM php:8.3-fpm-alpine

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
    icu-data-full \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS

# Instalar extensões PHP (antes de copiar os arquivos do projeto)
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
    ctype \
    mbstring \
    tokenizer

# Limpar pacotes de desenvolvimento
RUN apk del $PHPIZE_DEPS linux-headers

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar apenas arquivos necessários primeiro (cache de dependências)
COPY composer.json composer.lock ./

# Instalar dependências do PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Agora copiar o resto do projeto
COPY . .

# Rodar scripts do composer e otimizar
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
