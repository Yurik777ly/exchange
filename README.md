## Install
- composer install
- configure .env file
- php artisan migrate
- add row in .env: EXCHANGE_API_KEY=YOUR_API_KEY_IN_FREECURRENCYAPI
- php artisan serve

## Get First data
- php artisan app:exchange

## Schedule

- nano /etc/crontab or crontab -e

0 23 * * * cd /var/www/project && php artisan schedule:run >> /dev/null 2>&1


