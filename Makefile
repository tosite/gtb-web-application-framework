setup/docker:
	cp .env.example .env
	docker-compose run php bash -c "composer install && php artisan key:generate && make db/setup"

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
