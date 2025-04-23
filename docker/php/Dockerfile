# Étape 1 : Build des dépendances PHP avec Composer
FROM composer:2 AS build

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Étape 2 : Image d'exécution PHP + Apache
FROM php:8.1-apache

# Installer les dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
 && docker-php-ext-install pdo pdo_mysql zip \
 && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configuration Apache (optionnel, à décommenter si vhost.conf existe)
# COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Configuration PHP (optionnel, à décommenter si php.ini existe)
# COPY php.ini /usr/local/etc/php/conf.d/app.ini

# Copier le code de l'application
COPY src/ /var/www/html/
COPY --from=build /app/vendor /var/www/html/vendor

# Droits sur les fichiers
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html