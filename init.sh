### gtb2020-laravelをConohaで使えるよう初期化セットアップします。

# composer install
composer install

# .envを作成する
cp .env.example .env

# httpd.confを上書きさせる。-bオプションで上書き元はバックアップする
sudo cp -b -f ./setup/httpd/conf/httpd.conf /etc/httpd/conf/

# Apache再起動
service httpd restart

# logにアクセスする為に権限を付与させる
chown apache:apache /var/www/html/gtb2020-laravel/storage/logs/

# gtb2020-laravelディレクトリの権限を変更させる
chmod -R 777 /var/www/html/gtb2020-laravel

# APP KEYを生成させる
php artisan key:generate
