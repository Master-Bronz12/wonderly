# Dockerfile pour Wonderly
FROM php:8.2-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Activer mod_rewrite
RUN a2enmod rewrite

# Copier les fichiers du projet
COPY . /var/www/html/

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurer le DocumentRoot
WORKDIR /var/www/html

# Exposer le port
EXPOSE 80