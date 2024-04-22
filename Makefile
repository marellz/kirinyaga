up:
	docker-compose up

rebuild:
	docker-compose up --build

# api
config-cache:
	docker exec -ti kirinyaga-front php artisan config:cache

migrate: api-config
	docker exec -ti kirinyaga-front php artisan migrate

migrate-fresh:
	docker exec -ti kirinyaga-front php artisan migrate:fresh

db-seed:
	docker exec -ti kirinyaga-front php artisan db:seed

key-generate:
	docker exec -ti kirinyaga-front php artisan key:generate

api-setup: key-generate config-cache migrate db-seed

# other
db-refresh: migrate-fresh db-seed
