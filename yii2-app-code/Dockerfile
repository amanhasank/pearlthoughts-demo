FROM php:8.1-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
        libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql dom

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (to leverage Docker layer caching)
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Generate optimized autoload files
RUN composer dump-autoload --optimize

# Set file permissions
RUN chown -R www-data:www-data /var/www/html

# Set Apache document root to /web
ENV APACHE_DOCUMENT_ROOT /var/www/html/web

# Update Apache config to use new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

EXPOSE 80
