SUCCESS_COLOR=\033[1;32m
WARN_COLOR=\033[1;33m
INFO_COLOR=\033[1;34m
RESET=\033[0m
BOLD=\033[1m

setup/docker:
	cp .env.example .env
	@sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
	@sed -i 's/DB_PASSWORD=/DB_PASSWORD=root/' .env
	docker-compose up -d
	docker-compose run php bash -c "composer install && php artisan key:generate && make db/setup"
	@echo "$(INFO_COLOR)Setup is finished🎉$(RESET)"
	@echo "$(INFO_COLOR)Enjoy your development!!🥳$(RESET)"
	@echo "$(WARN_COLOR)If you want to stop the container, enter 'make stop/docker'.$(RESET)"

setup/conoha:
	cp .env.example .env
	$(eval MYSQL_PASS=$(shell sed -n 7p /etc/motd | cut -d " " -f 3))
	@sed -i 's/DB_HOST=127.0.0.1/DB_HOST=localhost/' .env
	@sed -i 's/DB_PASSWORD=/DB_PASSWORD=$(MYSQL_PASS)/' .env
	composer install && php artisan key:generate && make db/setup
	sudo cp -b -f ./setup/httpd/conf/httpd.conf /etc/httpd/conf/
	chown apache:apache /var/www/html/gtb-web-application-framework/storage/logs/
	chmod -R 777 /var/www/html/gtb-web-application-framework/storage && chmod -R 777 /var/www/html/gtb-web-application-framework/bootstrap/cache
	sudo cp -f ./setup/app/Providers/AppServiceProvider.php ./app/Providers/
	service httpd restart
	@echo "$(INFO_COLOR)Setup is finished🎉$(RESET)"
	@echo "$(INFO_COLOR)Enjoy your development!!🥳$(RESET)"

db/setup:
	$(eval include .env)
	$(eval export sed 's/=.*//' .env)
	mysql -u${DB_USERNAME} -p${DB_PASSWORD} -h${DB_HOST} -e 'create database if not exists ${DB_DATABASE};'
	php artisan migrate

stop/docker:
	docker-compose down

start/docker:
	docker-compose up -d
	@echo "$(WARN_COLOR)If you want to stop the container, enter 'make stop/docker'.$(RESET)"

log/php:
	@echo "$(WARN_COLOR)If you wnat to return to the console, enter 'ctrl+C'.$(RESET)"
	docker-compose logs -f php

log/nginx:
	@echo "$(WARN_COLOR)If you wnat to return to the console, enter 'ctrl+C'.$(RESET)"
	docker-compose logs -f nginx

log/db:
	@echo "$(WARN_COLOR)If you wnat to return to the console, enter 'ctrl+C'.$(RESET)"
	docker-comose logs -f mysql
