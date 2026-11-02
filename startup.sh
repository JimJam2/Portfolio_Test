#!/bin/bash

# 1. Salin konfigurasi Nginx agar root mengarah ke folder public/
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default
service nginx reload

# 2. Beri hak akses tulis ke folder storage dan cache
chmod -R 777 /home/site/wwwroot/storage
chmod -R 777 /home/site/wwwroot/bootstrap/cache

# 3. Setup file Database SQLite
mkdir -p /home/site/wwwroot/database
touch /home/site/wwwroot/database/database.sqlite
chmod -R 777 /home/site/wwwroot/database

# 4. Jalankan migrasi dan seeder awal otomatis jika belum pernah di-seed
php /home/site/wwwroot/artisan migrate --force
if [ ! -f /home/site/wwwroot/database/.seeded ]; then
    php /home/site/wwwroot/artisan db:seed --force
    touch /home/site/wwwroot/database/.seeded
fi
