# ---------------------------------------
# Etapa 1 – Builder (instala dependencias y compila assets)
# ---------------------------------------
FROM php:8.4-fpm-alpine AS builder

# Instalar extensiones y herramientas necesarias
RUN apk add --no-cache \
        git \
        curl \
        zip \
        unzip \
        libpng-dev \
      libjpeg-turbo-dev \
        freetype-dev \
       icu-dev \
     oniguruma-dev \
       autoconf \
        g++ \
     make \
        npm

# Extensiones PHP requeridas por Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql gd intl bcmath opcache

# Composer (versión oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar solo los archivos de dependencias primero (optimiza caché)
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

# Copiar todo el código fuente
COPY . .

# Instalar dependencias front‑end y compilar assets
RUN npm ci && npm run build --if-present

# ------------------------------------------------------------
# Etapa 2 – Runtime (imagen final)
# ---------------------------------------
FROM php:8.4-fpm-alpine

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

# Instalar solo las extensiones necesarias en runtime
RUN apk add --no-cache \
        libpng \
        libjpeg-turbo \
        freetype \
       icu-libs \
        oniguruma && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
   docker-php-ext-install pdo_mysql gd intl bcmath opcache

# Copiar artefactos desde la etapa builder
COPY --from=builder /var/www/html /var/www/html

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
