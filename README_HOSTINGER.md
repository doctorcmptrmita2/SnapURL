# Hostinger Deployment - Hızlı Başlangıç

## 🚀 Hızlı Kurulum

### 1. Dosya Yapısı

Hostinger'da klasör yapısı şöyle olmalı:

```
/home/username/
├── snapurl/              (veya istediğiniz isim)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   └── composer.json
└── public_html/          (public klasörünün içeriği buraya)
    ├── index.php
    ├── .htaccess
    ├── assets/
    └── build/
```

### 2. public/index.php Güncelleme

`public_html/index.php` dosyasını açın ve şu şekilde güncelleyin:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../snapurl/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../snapurl/vendor/autoload.php';

(require_once __DIR__.'/../snapurl/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

**ÖNEMLİ:** `snapurl` yerine kendi klasör adınızı yazın.

### 3. .env Dosyası

`snapurl/.env` dosyasını oluşturun ve şu ayarları yapın:

```env
APP_NAME="SnapURL.to"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://snapurl.to

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Diğer ayarlar...
```

### 4. SSH Komutları

Hostinger Terminal'den (veya SSH ile):

```bash
cd ~/snapurl
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
chmod -R 755 storage bootstrap/cache
```

### 5. Cron Job

Hostinger Control Panel > Cron Jobs:

```
* * * * * cd /home/username/snapurl && php artisan schedule:run >> /dev/null 2>&1
```

### 6. Test

https://snapurl.to adresini ziyaret edin ve test edin.

## 📝 Önemli Notlar

- **APP_DEBUG=false** production'da mutlaka false olmalı
- **APP_URL=https://snapurl.to** doğru domain olmalı
- SSL sertifikası aktif olmalı
- Database bilgileri Hostinger'dan alınmalı
- Storage klasörüne yazma izni verilmeli

## 🔧 Sorun Giderme

**500 Error:**
- `.env` dosyasını kontrol edin
- `storage/logs` klasörüne yazma izni verin
- `APP_DEBUG=true` yapıp hata mesajını okuyun

**Route Not Found:**
- `php artisan route:cache` çalıştırın
- `.htaccess` dosyasını kontrol edin

**Database Error:**
- Hostinger'dan database bilgilerini kontrol edin
- Database'in aktif olduğundan emin olun

