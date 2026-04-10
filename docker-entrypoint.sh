#!/bin/sh
set -e

# S'assurer que le fichier SQLite existe et est accessible
touch /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/storage /var/www/html/database

# Exécuter les migrations (le --force est obligatoire en production)
php artisan migrate --force

# Lancer la commande principale du conteneur (souvent passée par le Dockerfile)
exec "$@"
