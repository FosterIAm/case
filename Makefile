init: docker-down docker-pull docker-build docker-up api-init
up: docker-up
down: docker-down
restart: down up 

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

build: build-api

api-init: api-composer-install

api-composer-install:
	docker-compose run --rm api-php-cli composer install

api-composer-update:
	docker-compose run --rm api-php-cli composer update
