# Menggunakan image PHP dengan Apache
FROM php:8.1-apache

# Install ekstensi PDO untuk koneksi ke RDS MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Install git, zip, unzip untuk Composer
RUN apt-get update && apt-get install -y git zip unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code ke folder web server Apache
COPY src/ /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Jalankan composer install untuk mengunduh AWS SDK
RUN composer install

# Buka port 80
EXPOSE 80