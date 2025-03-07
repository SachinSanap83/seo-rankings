#!/bin/bash

# Exit immediately if any command fails
set -e

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run database migrations
php artisan migrate --force

# Cache configuration and routes for better performance
php artisan config:cache
php artisan route:cache

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=10000
