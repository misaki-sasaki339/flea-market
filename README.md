# 🛍️ flea-market

Laravel×MySQL×Dockerで構築したフリマアプリです。

---

## アプリ概要

本アプリはユーザーが商品を出品・購入できるフリマアプリとなります。
ログイン後、出品・購入・お気に入り・コメント機能が利用でき、購入時はStripeによる決済処理も行うことが可能です。

---

## 使用技術

|分類|使用技術|
|----|---------------|
|フレームワーク| Laravel 8.x|
|言語|PHP 8.x / HTML /CSS|
|データベース|MySQL 8|
|インフラ|Docker / Nginx 1.21 / MailHog|
|認証| Laravel Fortify|
|決済API|Stripe|

---

## ER図

![ER図](flea-market/src/docs/ER.png)

---

## 環境構築手順

```bash
#クローン
git clone　git@github.com:misaki-sasaki339/flea-market.git

#Dockerビルド
docker compose up -d --build

#Laravel環境構築
docker compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

```

---

## Stripeの設定
本アプリではStripeを使用して決済を行います。
事前にStripe公式サイトにて無料アカウントを作成し、以下の手順で環境変数を設定してください。

1. Stripeダッシュボードにログインし、「開発者」→「APIキー」から以下を取得します。

2. .envファイルに以下を追記します。
```
STRIPE_KEY=pk_test_xxxxxxxxxxxxxxxxxxxx
STRIPE_SECRET=sk_test_xxxxxxxxxxxxxxxxxxxx
```

3. テストモードで動作確認できます。
テストカード番号例：4242 4242 4242 4242
有効期限：未来の日付(例：03/31)
CVC1：任意の3桁

---

## MailHogの設定

本アプリではメール認証(Fortify)を使用しています。
ローカル環境ではMailHogを使用してメール送信を確認できます。

MailHogはdocker-compose.ymlに含まれています。
以下のURLにアクセスしてメールを確認してください。

http://localhost:8025

```
#.env設定例
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:xxxxx
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=pk_test_***************
STRIPE_SECRET=sk_test_***************
```

---
