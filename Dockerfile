# Dockerfile
FROM php:8.1-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    curl \
    && docker-php-ext-install zip mbstring pdo pdo_mysql

# Installer Composer globalement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier le code source
COPY . /var/www/html

WORKDIR /var/www/html

# Installer les dépendances PHP avec composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port (celui utilisé par Laravel Sail par défaut)
EXPOSE 8000

# Commande pour lancer Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
