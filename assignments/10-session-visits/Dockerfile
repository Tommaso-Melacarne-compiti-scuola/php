# Using the PHP 8.2 as Apache base image
FROM php:apache

# Enable the Apache module rewrite
RUN a2enmod rewrite

# Install PHP extensions for MySQL database connection
RUN docker-php-ext-install mysqli pdo_mysql pdo
