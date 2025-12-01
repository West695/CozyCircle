# CozyCircle
A Niche-Specific, Threaded Forum Platform

## Project Setup (run everything inside the laravel terminal)
If not inside the laravel folder yet:
```bash
cd backend/laravel
```
1. Copy the env locally
```bash
cp .env.example .env
```
2. Install dependencies
```bash
composer install
```
3. Create database file
```bash
touch database/database.sqlite
```
4. Generate laravel APP_KEY
```bash
php artisan key:generate
```
5. Run migrations and seeder
NOTES: this will drop all tables and create new
```bash
php artisan migrate:fresh --seed
```

### Notes
- Every people must generate their own `.env` and SQLite database (`database.sqlite`) locally. 
