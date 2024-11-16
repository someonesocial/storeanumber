FROM php:8.2-apache

# Single RUN layer for all system operations to reduce image size
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite headers \
    && echo "ServerTokens Prod" >> /etc/apache2/apache2.conf \
    && echo "ServerSignature Off" >> /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

# Copy Apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Copy application files
COPY . /var/www/html/

# Install Composer and dependencies in one layer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html