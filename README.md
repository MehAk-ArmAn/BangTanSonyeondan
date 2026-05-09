# BangTanSonyeondan — Final Laravel Project

Dark black + purple BTS fan/learning website built in Laravel.

## What is included

- Landing page with dark/purple ARMY theme
- Member profile pages
- Restored old-project achievements hero section
- Database-driven BTS timeline and achievements
- Songs/playlist page
- Photo gallery
- Quotes page
- Member voting page
- BT21 page with colorful animated anatomy profile cards
- User registration/login
- User dashboard with points, streaks, quiz attempts, and profile assets
- Learn + quiz system where users earn points
- Leaderboard
- Admin panel protected by admin-only middleware
- Global search bar across members, songs, quotes, timeline, and lessons
- Import-ready SQL file: `bangtansonyeondan_final.sql`

## Admin login

Email: `admin@bangtansonyeondan.com`

Password: `...`

## XAMPP setup

1. Copy this folder into `C:\xampp\htdocs\BangTanSonyeondan`.
2. Open phpMyAdmin and import `bangtansonyeondan_final.sql`.
3. Make sure `.env` has:

```env
APP_NAME="BangTanSonyeondan"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bangtansonyeondan
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=database
```

4. In the project folder, run:

```bash
composer install
php artisan key:generate
php artisan optimize:clear
php artisan storage:link
php artisan serve
```

5. Open `http://127.0.0.1:8000`.

## Google login note

The Google button is safely prepared as a setup notice. Real Google OAuth needs Laravel Socialite plus your own Google Client ID/Secret in `.env`. I did not hard-code fake keys because that would be insecure.

## Final SQL file

Use this file for phpMyAdmin import:

```text
bangtansonyeondan.sql
```

It creates the database `bangtansonyeondan` and inserts all starter data.
