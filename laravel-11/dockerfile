# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    git \ 
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    zlib1g-dev \
    libicu-dev \
    gcc \
    make \
    && rm -rf /var/lib/apt/lists/*

# Check if the libzip-dev package has been installed
RUN dpkg -l | grep libzip
RUN dpkg -l | grep zlib1g-dev

# Configure PHP for zip extension
RUN docker-php-ext-configure zip

# Install the PHP zip extension
RUN docker-php-ext-install zip

# Check if the PHP zip extension has been installed
RUN php -m | grep zip

# Install other PHP extensions (pdo, mbstring, bcmath, curl, openssl, intl)
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm (if needed for building assets)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy Laravel source code into the container
COPY . .

# Install Laravel dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Install npm packages (Vue.js, or any other packages you need)
RUN npm install

# Set proper permissions for the storage and bootstrap/cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable mod_rewrite
RUN a2enmod rewrite

# Configure Apache Virtual Host
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Start Apache when the container starts
CMD ["apache2-foreground"]
