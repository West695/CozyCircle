# CozyCircle2

## Project Setup for the database (run everything inside the laravel terminal)
If not inside the laravel folder yet:
```bash
cd CozyCircle
```
1. Copy the env locally
```bash
cp .env.example .env
```
2. Install dependencies
```bash
composer install
```
3. Generate laravel APP_KEY
```bash
php artisan key:generate
php artisan config:clear
```
4. Start XAMPP & make sure Apache & MySQL are running. Then create database named cozycircle

5. Run migrations and seeder
NOTES: this will drop all tables and create new
```bash
php artisan migrate:fresh --seed
```