# yes_no-app（肌タイプ診断アプリ）

肌タイプ診断を行うWebアプリケーション   

## 作成した目的

鍼灸院からのアプリ制作依頼

## アプリケーション URL
- 本番環境: http://54.199.151.93

### 開発環境
- ローカル : http://localhost
- phpMyAdmin : http://localhost:8080

## 機能一覧
- ### 診断機能
  - **Yes/No形式の質問でユーザーの肌タイプを診断**
- ### 結果表示機能
  - **診断結果をリアルタイムで画面に表示**
- ### データ保存機能
  - **ユーザーの回答データをデータベースに保存**

## 仕様技術

- **バックエンド**
  - PHP^7.3 または ^8.0
  - Laravel8.75
  - MySQL8.0.26

- **フロントエンド**
  - Nginx1.21.1

- **インフラ**
  - AWS(EC2)
  - Docker/Docker-compose

## テーブル設計

## ER 図

## 環境構築

###  **Docker ビルド**

1. `git@github.com:Shinji-0323/Yes_No-app.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

###  **Laravel 環境構築**

1. `docker compose exec php bash`
2. `composer install`
3. `.env.example`ファイルを `.env`ファイルに命名を変更。または、新しく`.env` ファイルを作成
4. `.env` に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```