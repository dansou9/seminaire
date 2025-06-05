FROM php:8.2-apache

# Installer les dépendances système critiques
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd mbstring exif pcntl

# Installer Node.js LTS (pour Vite) sans PNPM
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest  # Utilise npm au lieu de pnpm

# Installer Composer globalement
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer l'application
WORKDIR /var/www/html
COPY . .

# Installer les dépendances et builder les assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Configurer Apache pour Railway
ENV APACHE_PORT=$PORT
RUN sed -i "s/Listen 80/Listen ${APACHE_PORT}/g" /etc/apache2/ports.conf \
    && a2enmod rewrite \
    && chmod -R 775 storage bootstrap/cache
