# Use an official PHP runtime as a parent image
FROM php:7.4-fpm-alpine

# Install necessary packages (Nginx, wget , and PDO MySQL extension)
RUN apk add --no-cache nginx wget \
    && docker-php-ext-install pdo_mysql 
RUN apk add libpng-dev
RUN apk add libzip-dev
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip

# Copy custom php.ini file
COPY php-config/php.ini /usr/local/etc/php/php.in

# Create directories and set up Nginx
RUN mkdir -p /run/nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Set the working directory
WORKDIR /app

# Copy the application files into the container
COPY . .

# Set the correct permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Install Composer
RUN wget -qO /usr/local/bin/composer https://getcomposer.org/download/2.2.0/composer.phar \
    && chmod +x /usr/local/bin/composer

# Install project dependencies using Composer and optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# Clear Laravel cache
RUN php artisan optimize:clear


# Change ownership of the application directory to the www-data user
RUN chown -R www-data:www-data /app

# Command to start the application using a startup script
CMD sh /app/docker/startup.sh
# CMD ["php-fpm"]
