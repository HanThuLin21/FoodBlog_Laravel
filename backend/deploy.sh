#!/bin/bash

# Cache configurations and routes for performance
echo "Caching configuration..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

# Run database migrations
# The --force flag is required in production so it doesn't prompt for confirmation
echo "Running database migrations..."
php artisan migrate --force

echo "Deployment script completed!"
