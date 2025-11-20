# Change your Laravel project directory
cd ~/mywebsite

# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
git pull origin main

# Install composer dependecies
composer install --no-interaction --no-dev

# Optimize view, routes, events, configs
php artisan optimize:clear
php artisan optimize

# Clear expired password reset tokens
php artisan auth:clear-resets

# Run database migrations
php artisan migrate --force

# Turn off maintenance mode
php artisan up

exit 0
