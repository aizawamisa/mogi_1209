<div id="top"></div>

# アプリケーション名

もぎたて

## 使用技術

| 言語・フレームワーク | バージョン |
| -------------------- | ---------- |
| Laravel Framework    | 8.83.8     |
| PHP                  | 7.4.9      |
| Docker               | 27.3.1     |

その他のパッケージのバージョンは composer.json を参照してください

## 機能一覧

商品一覧の閲覧、商品検索、商品の登録、商品の削除、商品の編集

## ER 図

![ER図](https://github.com/aizawamisa/mogi_1209/raw/main/drawio.png)

## URL

https://github.com/aizawamisa/mogi_1209.git

## 環境構築

## 1. リポジトリのクローンと Docker 起動

### クローン

$ git clone https://github.com/aizawamisa/mogi_1209.git

### Docker 起動

$ docker compose up -d --build

### php コンテナに入る

$docker compose exec php bash

## 2. Composer のインストール

$ composer install

## 3. .env の作成、環境設定の記述

$ cp .env.local .env

## 4. アプリケーションキー作成

$ php artisan key:generate

## 5. データベースの設定

$ php artisan migrate --seed

## 6. シンボリックリンクの作成

$ php artisan storage:link

## 7. ディレクトリ権限の変更

$ sudo chmod -R 775 storage  
$ sudo chmod -R 775 bootstrap/cache

## 8. CSS を変更する場合、npm のインストール

$ npm install  
$ npm run watch
