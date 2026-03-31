# ===================== STAGE 1 : Build des assets Vite =====================
FROM node:20-alpine AS vite-builder

WORKDIR /app

# Installation des dépendances Node
COPY package*.json ./
RUN npm ci --only=production

# Copie du code source et build Vite
COPY . .
RUN npm run build

# ===================== STAGE 2 : Application Laravel PHP =====================
FROM php:8.3-fpm-alpine AS laravel-app

# Installation des dépendances système
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    zip \
    unzip \
    supervisor \
    nginx

# Installation des extensions PHP nécessaires pour Laravel
RUN docker-php-ext-install pdo_mysql bcmath gd opcache

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copie des fichiers Composer + installation des dépendances (sans dev)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copie du code source Laravel
COPY . .

# Copie des assets Vite depuis le stage précédent
COPY --from=vite-builder /app/public/build ./public/build

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configuration PHP (opcache pour la prod)
COPY .docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 9000

CMD ["php-fpm"]
