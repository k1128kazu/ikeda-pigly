# PiGLy 体重管理システム

---

## 🛠 環境構築

Docker のビルドからマイグレーション、シーディングまでのコマンドを以下の順序で実行します。

### 1. Docker 起動

```bash
docker-compose up -d
```

### 2. PHP コンテナに入る

```bash
docker-compose exec php bash
```

### 3. Laravel セットアップ

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

必要に応じて：

```bash
php artisan db:seed
```

---

## 💻 使用技術（実行環境）

- **Laravel 8.x**
- **PHP-FPM（Docker 内）**
- **Nginx（Docker 内）**
- **MySQL 8（Docker 内）**
- **Docker Desktop + WSL2 + VSCode**
- **Fortify（ユーザー認証）**

---

## 🗂 ER 図

以下が PiGLy の ER 図です。  
（本 README と同じディレクトリに **ER.svg** を置いてください）

![ER 図](./ER.svg)

---

## 🌐 URL

- **開発環境:** http://localhost/

---

## 📦 主な機能

- ユーザー登録（メール・パスワード）
- STEP2：身長登録
- ダッシュボード（BMI 計算・表示）
- 体重ログ CRUD（一覧 / 追加 / 編集 / 削除）
- 目標体重の登録・編集
- ログイン / ログアウト（Fortify）

---

## 📁 主なディレクトリ構成

```
project-root/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── resources/
│   └── views/
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── public/
│   └── css/
└── docker/
    ├── php/
    ├── nginx/
    └── mysql/
```

---

## 📄 ライセンス

MIT License

---

## 👤 制作者

- 池田太一
