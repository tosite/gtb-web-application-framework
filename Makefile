INFO_COLOR=\033[1;34m
RESET=\033[0m
BOLD=\033[1m

setup/docker:
	cp .env.example .env
	docker-compose up -d
	docker-compose run php bash -c "composer install && php artisan key:generate && make db/setup"
	@echo "$(INFO_COLOR)コンテナを停止したい場合は 'make stop/docker' を入力してください。$(RESET)"

setup/conoha:
	cp .env.example .env
	composer install && php artisan key:generate && make db/setup
	sudo cp -b -f ./setup/httpd/conf/httpd.conf /etc/httpd/conf/
	chown apache:apache /var/www/html/gtb2020-laravel/storage/logs/
	chmod -R 777 /var/www/html/gtb2020-laravel/storage && chmod -R 777 /var/www/html/gtb2020-laravel/bootstrap/cache
	sudo cp -f ./setup/app/Providers/AppServiceProvider.php ./app/Providers/
	service httpd restart

db/setup:
	mysql -u${DB_USERNAME} -p${DB_PASSWORD} -h${DB_HOST} -e 'create database if not exists ${DB_DATABASE};'
	php artisan migrate

stop/docker:
	docker-compose down

start/docker:
	docker-compose up -d
	@echo "$(INFO_COLOR)コンテナを停止したい場合は 'make stop/docker' を入力してください。$(RESET)"

log/php:
	@echo "$(INFO_COLOR)コンソールに戻りたい場合は 'ctrl+C' を入力してください。$(RESET)"
	docker-compose logs -f php

log/nginx:
	@echo "$(INFO_COLOR)コンソールに戻りたい場合は 'ctrl+C' を入力してください。$(RESET)"
	docker-compose logs -f nginx

log/db:
	@echo "$(INFO_COLOR)コンソールに戻りたい場合は 'ctrl+C' を入力してください。$(RESET)"
	docker-comose logs -f mysql
