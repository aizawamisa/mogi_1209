<div id="top"></div>

# アプリケーション名

もぎたて

## 使用技術（実行環境）

| 言語・フレームワーク | バージョン |
| -------------------- | ---------- |
| Laravel Framework    | 8.83.8     |
| PHP                  | 7.4.9      |
| Docker               | 27.3.1     |
| MySQL                | 8.0.40     |

その他のパッケージのバージョンは composer.json を参照してください

## 機能一覧

商品一覧の閲覧、商品検索、商品の登録、商品の削除、商品の編集

## ER 図

![ER図](https://github.com/aizawamisa/mogi_1209/raw/main/.drawio.png)

## URL

- 開発環境: http://localhost:8081/
- phpMyAdmin: http://localhost:8080/

## 環境構築

## Docker ビルド

### 1.クローン

```git clone https://github.com/aizawamisa/mogi_1209.git```

### 2.Docker 起動

```docker compose up -d --build```

## Laravel 環境構築

### 1.php コンテナに入る

```docker compose exec php bash```

### 2. Composer のインストール

```composer install```

### 3. .env.example ファイルを.env ファイルに命名変更。または、新しく.env ファイルを作成

### 4. .env に以下の環境変数を追加

```DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass```

### 5. アプリケーションキー作成

```php artisan key:generate```

### 6. マイグレーションの実行

```php artisan migrate```

### 7. シーディングの実行

```php artisan migrate --seed```

### 8. シンボリックリンクの作成

```php artisan storage:link```
