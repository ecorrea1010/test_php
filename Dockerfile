FROM php:8.3-apache

# Install dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite