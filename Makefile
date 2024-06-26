up:
	docker-compose up

down:
	docker-compose down

rebuild:
	docker-compose up --build

# api
config-cache:
	docker exec -ti kirinyaga-api php artisan config:cache

migrate: config-cache
	docker exec -ti kirinyaga-api php artisan migrate

migrate-fresh:
	docker exec -ti kirinyaga-api php artisan migrate:fresh

db-seed:
	docker exec -ti kirinyaga-api php artisan db:seed

key-generate:
	docker exec -ti kirinyaga-api php artisan key:generate

tinker:
	docker exec -ti kirinyaga-api php artisan tinker

api-setup: key-generate config-cache migrate db-seed

# other
db-refresh: migrate-fresh db-seed
