#!/usr/bin/env bash
set -e

echo "▶ Setting up CozyCircle dev environment..."

# --- Backend (Laravel) ---
if [ -d "backend" ]; then
  cd backend
  cp -n .env.example .env || true
  composer install || true
  php artisan key:generate || true

  # Use SQLite for zero-setup DB
  mkdir -p database
  [ -f database/database.sqlite ] || touch database/database.sqlite
  if grep -q "DB_CONNECTION" .env; then
    sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
  else
    echo "DB_CONNECTION=sqlite" >> .env
  fi
  if grep -q "DB_DATABASE" .env; then
    sed -i 's#^DB_DATABASE=.*#DB_DATABASE=database/database.sqlite#' .env
  else
    echo "DB_DATABASE=database/database.sqlite" >> .env
  fi

  php artisan migrate --seed || true
  cd ..
fi

# --- Frontend (React) ---
if [ -d "frontend" ]; then
  cd frontend
  (npm ci || npm install)
  cd ..
fi
