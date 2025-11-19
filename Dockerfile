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
RUN npm ci && npm run build

# ------------------------------------------------------------
# Etapa 2 – Runtime (imagen final)
# ------------------------------------------------------------
FROM php:8.4-fpm-alpine

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

# 1️⃣ Instalar dependencias de runtime + dev (para compilar extensiones)
# 2️⃣ Compilar e instalar las extensiones PHP que necesitamos
# 3️⃣ Eliminar los paquetes de compilación para que la imagen quede ligera
RUN set -eux; \
    apk add --no-cache --virtual .runtime-deps \
        libpng \
        libjpeg-turbo \
        freetype \
        icu-libs \
        oniguruma; \
    \
    apk add --no-cache --virtual .build-deps \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        oniguruma-dev \
        autoconf \
        gcc \
        g++ \
        make; \
    \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        gd \
        intl \
        bcmath \
        opcache; \
    \
    # Limpiar: eliminar paquetes de compilación y caches de apk
    apk del .build-deps; \
    rm -rf /var/cache/apk/*;

# 4️⃣ Copiar la aplicación construida desde la fase builder
COPY --from=builder /var/www/html /var/www/html

# 5️⃣ Ajustar permisos (www-data es el usuario por defecto de php-fpm)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
