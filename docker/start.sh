#!/bin/bash
set -e

# Debug - list permissions of key directories
echo "Checking permissions:"
ls -la /var/www/html/public
ls -la /var/www/html/storage

# Make sure we have proper permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Test Nginx configuration before starting
echo "Testing Nginx configuration:"
nginx -t

# Start PHP-FPM
echo "Starting PHP-FPM"
php-fpm -D

# Start Nginx
echo "Starting Nginx"
nginx -g "daemon off;"