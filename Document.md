# Panduan Instalasi dan Deployment VPS

Dokumen ini menjelaskan deployment aplikasi ini ke VPS Ubuntu dengan Apache2, PHP-FPM, dan MariaDB. Konfigurasi proyek berdasarkan `composer.json`: Laravel 12, Filament 5, PHP 8.2 atau lebih baru, dan Vite 7.

> Contoh perintah mengasumsikan Ubuntu 24.04, domain `contoh.com`, direktori `/var/www/smst-laravel`, PHP 8.3, dan pengguna database `smst_user`. Sesuaikan nilai-nilai tersebut dengan VPS Anda. Gunakan Node.js 20.19+ atau 22.12+ untuk membangun aset Vite.

## 1. Persiapan VPS

Hubungkan ke VPS melalui SSH, lalu perbarui paket:

```bash
sudo apt update
sudo apt upgrade -y
```

Pasang Apache2, MariaDB, Git, Composer, PHP-FPM, dan ekstensi PHP yang dibutuhkan Laravel serta koneksi MariaDB:

```bash
sudo apt install -y apache2 git unzip curl composer \
  php8.3-cli php8.3-fpm php8.3-common php8.3-mysql php8.3-mbstring \
  php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath php8.3-intl php8.3-gd
```

Ubuntu 24.04 menyediakan PHP 8.3 dari repositori bawaan.

Pastikan versi PHP dan Composer memenuhi kebutuhan:

```bash
php -v
composer --version
```

Pasang Node.js 22 untuk proses build aset frontend:

```bash
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt install -y nodejs
node -v
npm -v
```

## 2. Siapkan database MariaDB

Amankan instalasi MariaDB sesuai kebutuhan server:

```bash
sudo mariadb-secure-installation
```

Buat database dan pengguna khusus aplikasi. Ganti password contoh dengan password kuat dan unik:

```bash
sudo mariadb
```

Jalankan SQL berikut di prompt MariaDB:

```sql
CREATE DATABASE smst_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'smst_user'@'localhost' IDENTIFIED BY 'GANTI_DENGAN_PASSWORD_KUAT';
GRANT ALL PRIVILEGES ON smst_laravel.* TO 'smst_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

## 3. Salin kode aplikasi ke VPS

Buat direktori deployment dan salin kode proyek menggunakan Git atau unggah dari komputer lokal. Contoh dengan Git:

```bash
sudo mkdir -p /var/www/smst-laravel
sudo chown "$USER":www-data /var/www/smst-laravel
git clone URL_REPOSITORY_ANDA /var/www/smst-laravel
cd /var/www/smst-laravel
```

Jika kode diunggah sebagai arsip, ekstrak isinya ke `/var/www/smst-laravel` dan jalankan perintah-perintah berikut dari direktori tersebut. Jangan unggah `.env` dari komputer pengembangan.

## 4. Instal dependensi dan konfigurasi Laravel

Instal dependensi PHP production:

```bash
cd /var/www/smst-laravel
composer install --no-dev --optimize-autoloader
```

Buat file environment production:

```bash
cp .env.example .env
nano .env
```

Atur sekurang-kurangnya nilai berikut di `.env`:

```dotenv
APP_NAME="SMST Laravel"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://contoh.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smst_laravel
DB_USERNAME=smst_user
DB_PASSWORD="GANTI_DENGAN_PASSWORD_KUAT"
```

Simpan perubahan (`Ctrl+O`, `Enter`, `Ctrl+X` jika menggunakan nano), lalu buat application key:

```bash
php artisan key:generate
```

`APP_KEY` harus disimpan secara permanen. Jangan membuat key baru pada deployment berikutnya, karena hal itu dapat membuat data terenkripsi lama tidak bisa dibaca. Jangan membagikan atau memasukkan `.env` ke Git.

Jalankan migrasi untuk membuat tabel aplikasi:

```bash
php artisan migrate --force
```

Jangan jalankan `php artisan db:seed` pada instalasi production ini tanpa meninjau seeder terlebih dahulu: seeder saat ini membuat pengguna contoh `test@example.com`.

Buat akun admin Filament secara interaktif:

```bash
php artisan make:filament-user
```

## 5. Build aset frontend dan siapkan izin

Proyek ini memakai Vite; build aset statis di VPS:

```bash
npm install
npm run build
```

Pastikan web server dapat menulis ke direktori Laravel yang memerlukan izin tulis:

```bash
sudo chown -R "$USER":www-data /var/www/smst-laravel
sudo chmod -R ug+rwX /var/www/smst-laravel/storage /var/www/smst-laravel/bootstrap/cache
php artisan storage:link --force
```

Jangan memberi izin tulis ke seluruh direktori aplikasi untuk pengguna web server. Folder `storage` dan `bootstrap/cache` saja yang perlu dapat ditulis.

Aktifkan cache konfigurasi dan optimasi Laravel setelah `.env` selesai:

```bash
php artisan optimize
```

## 6. Konfigurasi Apache2

Buat konfigurasi situs:

```bash
sudo nano /etc/apache2/sites-available/smst-laravel.conf
```

Isi dengan konfigurasi berikut. Ganti `contoh.com` dan sesuaikan socket PHP-FPM jika versi PHP di VPS berbeda:

```apache
<VirtualHost *:80>
    ServerName contoh.com
    ServerAlias www.contoh.com
    DocumentRoot /var/www/smst-laravel/public

    <Directory /var/www/smst-laravel/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/smst-laravel-error.log
    CustomLog ${APACHE_LOG_DIR}/smst-laravel-access.log combined
</VirtualHost>
```

Aktifkan modul rewrite dan integrasi PHP-FPM, lalu aktifkan situs. Periksa konfigurasi sebelum memuat ulang Apache2:

```bash
sudo a2enmod rewrite proxy_fcgi setenvif
sudo a2enconf php8.3-fpm
sudo a2ensite smst-laravel.conf
sudo apache2ctl configtest
sudo systemctl reload apache2
```

Jika situs default Apache masih aktif dan mengambil alih domain, nonaktifkan setelah memastikan situs lain tidak memerlukannya:

```bash
sudo a2dissite 000-default.conf
sudo apache2ctl configtest
sudo systemctl reload apache2
```

Pastikan DNS domain mengarah ke IP VPS. Setelah domain dapat diakses melalui HTTP, aktifkan HTTPS dengan Certbot:

```bash
sudo apt install -y certbot python3-certbot-apache
sudo certbot --apache -d contoh.com -d www.contoh.com
```

## 7. Jalankan queue worker

`.env.example` mengatur `QUEUE_CONNECTION=database`. Agar job yang masuk ke queue database diproses terus-menerus, buat service systemd:

```bash
sudo nano /etc/systemd/system/smst-laravel-queue.service
```

Isi file:

```ini
[Unit]
Description=SMST Laravel Queue Worker
After=network.target mariadb.service

[Service]
User=www-data
Group=www-data
Restart=always
RestartSec=5
WorkingDirectory=/var/www/smst-laravel
ExecStart=/usr/bin/php artisan queue:work database --sleep=3 --tries=3 --timeout=90

[Install]
WantedBy=multi-user.target
```

Aktifkan service:

```bash
sudo systemctl daemon-reload
sudo systemctl enable --now smst-laravel-queue
sudo systemctl status smst-laravel-queue
```

Jika proyek tidak memakai job/queue, service ini tidak diperlukan. Untuk konfigurasi queue lain, samakan koneksi pada `ExecStart` dengan `QUEUE_CONNECTION` di `.env`.

## 8. Verifikasi deployment

Pastikan servis aktif dan periksa URL health check Laravel:

```bash
sudo systemctl status apache2 php8.3-fpm mariadb
curl -I https://contoh.com/up
```

Halaman admin Filament tersedia di `https://contoh.com/admin`. Masuk menggunakan akun yang dibuat dengan `make:filament-user`.

Jika aplikasi menampilkan error, periksa log:

```bash
sudo tail -n 100 /var/www/smst-laravel/storage/logs/laravel.log
sudo journalctl -u apache2 -n 100 --no-pager
sudo journalctl -u php8.3-fpm -n 100 --no-pager
sudo journalctl -u smst-laravel-queue -n 100 --no-pager
```

## 9. Pembaruan aplikasi

Setelah mengunggah versi kode terbaru, jalankan dari direktori proyek:

```bash
cd /var/www/smst-laravel
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan optimize
sudo systemctl restart smst-laravel-queue
```

Simpan salinan cadangan database dan `.env` sebelum pembaruan yang mengubah skema atau konfigurasi. Jangan pernah menghapus `APP_KEY` atau membuat ulang key pada server yang sudah menyimpan data production.
