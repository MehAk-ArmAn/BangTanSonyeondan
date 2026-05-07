# BangTanSonyeondan Glow-Up Setup Guide

## What this package changed

- Added a real admin dashboard at `/admin`.
- Added admin login at `/admin/login`.
- Added dynamic member vault pages at `/members/rm`, `/members/jin`, etc.
- Added DB-backed vote system.
- Added DB-backed navigation, site settings, quotes, songs, gallery, and timeline events.
- Removed old duplicate layout/partial files so the views are clean.
- Replaced the old one-card member pages with full profile vault pages.
- Added `database/sql/2026_05_07_glow_up_update.sql` for phpMyAdmin/manual DB updates.

## Recommended update method: Laravel commands

Run these inside the project folder:

```bash
composer install
php artisan optimize:clear
php artisan migrate
php artisan db:seed --class=GlowUpContentSeeder
php artisan storage:link
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
http://127.0.0.1:8000/admin/login
```

## Default admin login

```text
Email: admin@bangtansonyeondan.com
Password: Army@2026!
```

Change it immediately from:

```text
/admin -> Update Admin Password
```

## Manual DB update method using phpMyAdmin

If migrations are difficult on hosting, import this file in phpMyAdmin:

```text
database/sql/2026_05_07_glow_up_update.sql
```

After importing, clear Laravel cache:

```bash
php artisan optimize:clear
```

## Change admin password using Artisan

```bash
php artisan tinker
```

Then paste:

```php
$user = \App\Models\User::where('email', 'admin@bangtansonyeondan.com')->first();
$user->password = \Illuminate\Support\Facades\Hash::make('YourNewPasswordHere');
$user->save();
```

## Change admin password using SQL

Generate a bcrypt hash locally:

```bash
php -r "echo password_hash('YourNewPasswordHere', PASSWORD_BCRYPT), PHP_EOL;"
```

Then run:

```sql
UPDATE users
SET password = 'PASTE_HASH_HERE', updated_at = NOW()
WHERE email = 'admin@bangtansonyeondan.com';
```

## Important deployment notes

For shared hosting/cPanel, use these in `.env` unless you know you need database sessions/cache:

```env
SESSION_DRIVER=file
CACHE_STORE=file
APP_DEBUG=false
```

If images uploaded from admin do not show, run:

```bash
php artisan storage:link
```


