# Base image
FROM php:8.0-apache

# Set working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY . .

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        default-mysql-client && \
    docker-php-ext-install zip pdo pdo_mysql

# Set up Apache configuration
RUN a2enmod rewrite

# set composer env
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# Set file permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]