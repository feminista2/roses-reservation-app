# Build stage
FROM node:18 as node-build
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# In the build stage, after npm run build
RUN ls -la public/build/assets/  # Debug: List what's in the build output
RUN cp -r public/build /app/build-backup  # Save a backup of the build

# PHP stage
FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libpq-dev \
    nginx \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/sites-enabled/default

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy built assets from node stage
COPY --from=node-build /app/public/build /var/www/html/public/build
COPY --from=node-build /app/public/assets /var/www/html/public/assets
RUN ls -la /var/www/html/public/build/assets/  # Debug: Confirm files are copied

# Make sure the images directory exists (no need for custom copy as images are in the source)
RUN mkdir -p public/images/logos

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chmod -R 755 public
RUN find public -type f -exec chmod 644 {} \;
RUN chown -R www-data:www-data /var/www/html

# Start script
COPY docker/start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

# Expose port 80
EXPOSE 80

# Start PHP-FPM and Nginx
CMD ["/usr/local/bin/start"]