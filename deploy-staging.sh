#!/bin/bash
set -e

echo "Deploying application ..."

sudo supervisorctl stop all


sudo chown -R www-data:www-data /var/www/html/storage/logs
sudo chmod -R 775 /var/www/html/storage/logs
# Enter maintenance mode
#(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git checkout development
    sudo git reset --hard origin/development
    git pull origin development

    # cd /var/www/html
    # cp -R /var/repos/aspca/* /var/www/html

    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # Clear cache
    php artisan config:clear
    php artisan cache:clear
    php artisan optimize:clear

    # Migrate database
    php artisan migrate

    # Note: If you're using queue workers, this is the place to restart them.
    # ...
    php artisan queue:restart
    # nohup php artisan queue:work --daemon > storage/logs/laravel.log &
    
    composer dumpautoload




# Exit maintenance mode
php artisan up

sudo supervisorctl start all


echo "Application deployed!"