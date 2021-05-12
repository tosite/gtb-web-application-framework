# GTB <small>(GMO Technology Bootcamp)</small> - Web Application Framework

## 開発環境のセットアップ

### 前提
dockerを使って開発環境を作ります。
[Docker Desktop for Mac](https://docs.docker.com/docker-for-mac) をインストールして、dockerを使える状態にしておいてください。  
事前に[docker login](https://docs.docker.jp/engine/reference/commandline/login.html)まで済ませてください。

### setup（初回起動時）

以下コマンドで開発環境が立ち上がります。

```
make setup/docker 
```

### 二回目以降起動時

```
make start/docker
```

### 終了時

```
make stop/docker
```

### 各コンテナのログ取得時

```
make log/php
make log/nginx
make log/db
```

## ConoHa VPSでのセットアップ

必ず `var/www/html` 上で実行してください。

```
git clone https://github.com/tosite/gtb-web-application-framework.git
cd gtb-web-application-framework

make setup/conoha
```

フィードバックは [@tosite](https://twitter.com/mao_sum) まで。
