start:
	concurrently "php artisan serve" "npm run dev"

up: 
	start

# api
api-install:
	cp .env.example .env && composer install

config:
	php artisan config:cache

migrate: api-config
	php artisan migrate

key-generate:
	php artisan key:generate

api-setup: 
	api-install api-key-generate api-config migrate

# front
front-install: 
	npm run install

setup: 
	api-setup front-install

# other
db-refresh:
	php artisan migrate:fresh && php artisan db:seed
