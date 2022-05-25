docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

composer-install:
	docker-compose run --rm php-fpm composer install

migrate:
	docker-compose run --rm php-fpm php artisan migrate

migrate-rollback:
	docker-compose run --rm php-fpm php artisan migrate:rollback

npm-install:
	docker-compose run --rm node npm install

npm-dev:
	docker-compose run --rm node npm run dev

setup:
	cp ./.env.example ./.env && \
	docker-compose up -d && \
	docker-compose run --rm php-fpm composer install && \
	docker-compose run --rm php-fpm php artisan migrate && \
	docker-compose run --rm node npm install && \
	docker-compose run --rm node npm run dev