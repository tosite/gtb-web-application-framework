setup/docker:
	cp .env.example .env
	docker-compose run php bash -c "composer install && php artisan key:generate && make db/setup"

setup/conoha:
	cp .env.example .env
	composer install && php artisan key:generate && make db/setup

db/setup:
	mysql -u${DB_USERNAME} -p${DB_PASSWORD} -h${DB_HOST} -e 'create database if not exists ${DB_DATABASE};'
	php artisan migrate
