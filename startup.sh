#!/bin/bash

# 1. Pastikan folder-folder storage dan cache selalu ada
mkdir -p /home/site/wwwroot/storage/framework/cache/data
mkdir -p /home/site/wwwroot/storage/framework/sessions
mkdir -p /home/site/wwwroot/storage/framework/views
mkdir -p /home/site/wwwroot/storage/logs
mkdir -p /home/site/wwwroot/bootstrap/cache

# 2. Berikan izin baca/tulis penuh ke folder storage dan cache
chmod -R 777 /home/site/wwwroot/storage
chmod -R 777 /home/site/wwwroot/bootstrap/cache

# 3. Salin konfigurasi Nginx agar root mengarah ke folder public/
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default
service nginx reload

# 4. Setup file Database SQLite
mkdir -p /home/site/wwwroot/database
touch /home/site/wwwroot/database/database.sqlite
chmod -R 777 /home/site/wwwroot/database

# 5. Jalankan migrasi dan seeder awal otomatis jika belum pernah di-seed
php /home/site/wwwroot/artisan migrate --force
if [ ! -f /home/site/wwwroot/database/.seeded ]; then
    php /home/site/wwwroot/artisan db:seed --force
    touch /home/site/wwwroot/database/.seeded
fi
