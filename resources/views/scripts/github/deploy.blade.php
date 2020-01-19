set -e

cd {{ base_path() }}

git pull origin master

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force

php artisan optimize
