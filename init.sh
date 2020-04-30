### gtb2020-laravelをConohaで使えるよう初期化セットアップします。

composer install

# .envを作成する
cp .env.example .env

# httpd.confを上書きさせる。-bオプションで上書き元はバックアップする
sudo cp -b -f ./setup/httpd/conf/httpd.conf /etc/httpd/conf/

# Apache再起動
service httpd restart

# logにアクセスする為に権限を付与する
chown apache:apache /var/www/html/gtb2020-laravel/storage/logs/

# gtb2020-laravelディレクトリの権限を変更する
chmod -R 777 /var/www/html/gtb2020-laravel/storage
chmod -R 777 /var/www/html/gtb2020-laravel/bootstrap/cache

# APP KEYを生成させる
php artisan key:generate

# Coonoha VPS上で問題なくマイグレーションできるようにAppServiceProviderを上書きする
sudo cp -f ./setup/app/Providers/AppServiceProvider.php ./app/Providers/ 