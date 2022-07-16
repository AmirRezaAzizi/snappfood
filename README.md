# Snappfood PHP Test

# Getting Start
> This project runs with [Laravel version 9](https://laravel.com/docs/9.x) and [PHP version 8.1](https://www.php.net/releases/8.1/en.php).

Assuming you've already installed [Docker](https://www.docker.com/) on your machine.

``` bash
# install dependencies
composer install

# create .env file
cp .env.example .env

# generate the application key
./vendor/bin/sail artisan key:generate

# run migrations and seed mock data
./vendor/bin/sail artisan migrate:fresh --seed

# run the application
./vendor/bin/sail up
```

# Run Tests
``` bash
./vendor/bin/sail artisan test
```

# APIs

Submit a delay report from customer side:
``` bash
curl --request POST \
  --url http://localhost/api/customer/delay-report \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"order_id": 4
}'
```

Get a order from FIFO queue to review:
``` bash
curl --request GET \
  --url http://localhost/api/agent/delay-report \
  --header 'Accept: application/json'
```

Get list of vendors sorted by delay time(minutes)
``` bash
curl --request GET \
--url 'http://localhost/api/admin/vendors/delay-report?paginate=10' \
--header 'Accept: application/json'
```


Get list of all orders
``` bash
curl --request GET \
  --url 'http://localhost/api/admin/orders?paginate=10' \
  --header 'Accept: application/json'
```
