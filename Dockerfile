FROM webdevops/php-nginx:8.3-alpine

# Installation dans votre Image du minimum pour que Docker fonctionne
RUN apk add oniguruma-dev libxml2-dev
# Installation des dépendances système (Version Alpine)
RUN apk add --no-cache \
    sqlite \
    sqlite-dev \
    libxml2-dev \
    oniguruma-dev \
    zip \
    unzip \
    nodejs \
    npm


# Installation des extensions PHP
RUN docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    mbstring \
    pdo_sqlite \
    xml


# Installation dans votre image de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installation dans votre image de NodeJS
RUN apk add nodejs npm

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
WORKDIR /app
COPY . .

RUN touch database/database.sqlite && chmod -R 777 database/


# On copie le fichier .env.example pour le renommer en .env
RUN cp -n .env.example .env

# Installation et configuration de votre site pour la production
# https://laravel.com/docs/10.x/deployment#optimizing-configuration-loading
RUN composer install --no-interaction --optimize-autoloader --no-dev
# Generate security key
RUN php artisan key:generate
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
#RUN php artisan route:cache
# Optimizing View loading
#RUN php artisan view:cache
ENV NODE_OPTIONS="--max-old-space-size=4096"
# Compilation des assets de Breeze (ou de votre site)
RUN npm ci
#RUN npm install --verbose
#RUN npm run build --verbose

COPY /public/build /app/public/build

RUN chown -R application:application .


COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir l'Entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]

# La commande par défaut
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

