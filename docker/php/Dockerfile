# Utiliser l'image PHP avec Apache
FROM php:8.0-apache

# Installer les extensions PDO et PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Activer Apache mod_rewrite pour réécrire les URL si nécessaire
RUN a2enmod rewrite

# Commande pour démarrer Apache en premier plan
CMD ["apache2-foreground"]