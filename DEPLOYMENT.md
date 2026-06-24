# Hostinger Deployment Guide - SnapURL.to

Bu dosya Hostinger'da production ortamına deploy etmek için gerekli adımları içerir.

## 1. Dosya Yükleme

1. Tüm proje dosyalarını Hostinger'ın `public_html` klasörüne yükleyin
2. **ÖNEMLİ:** `public` klasörünün içeriğini `public_html` klasörüne taşıyın
3. Proje root klasörünü `public_html`'in bir üst dizinine taşıyın

**Klasör Yapısı:**
```
/home/username/
├── snapurl/
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
└── public_html/
    ├── index.php
    ├── .htaccess
    └── (diğer public dosyalar)
```

## 2. .env Dosyası Ayarları

`public_html`'in bir üst dizinindeki `.env` dosyasını düzenleyin:

```env
APP_NAME="SnapURL.to"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://snapurl.to

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Stripe (Production keys)
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@snapurl.to
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@snapurl.to"
MAIL_FROM_NAME="SnapURL.to"
```

## 3. public/index.php Güncelleme

`public_html/index.php` dosyasını düzenleyin:

```php
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
```

## 4. .htaccess Ayarları

`public_html/.htaccess` dosyası zaten doğru yapılandırılmış. Eğer sorun olursa:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## 5. SSH Komutları (Hostinger Terminal)

SSH üzerinden bağlanıp şu komutları çalıştırın:

```bash
# Proje dizinine git
cd ~/snapurl

# Composer dependencies yükle
composer install --no-dev --optimize-autoloader

# .env dosyasını oluştur ve düzenle
cp .env.production .env
nano .env  # veya vi .env

# Application key oluştur
php artisan key:generate

# Cache temizle
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Database migration
php artisan migrate --force

# Storage link oluştur
php artisan storage:link

# Cache optimize et
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Queue worker başlat (cron job olarak)
# * * * * * cd ~/snapurl && php artisan schedule:run >> /dev/null 2>&1
```

## 6. Cron Job Ayarları

Hostinger Control Panel'den cron job ekleyin:

```
* * * * * cd /home/username/snapurl && php artisan schedule:run >> /dev/null 2>&1
```

## 7. Queue Worker (Opsiyonel)

Eğer queue kullanacaksanız, supervisor veya cron ile queue worker başlatın:

```bash
php artisan queue:work --tries=3 --timeout=90
```

## 8. SSL Sertifikası

Hostinger'da SSL sertifikasını aktifleştirin (Let's Encrypt ücretsiz).

## 9. Database Ayarları

Hostinger Control Panel'den:
1. MySQL database oluşturun
2. Database user oluşturun ve yetkileri verin
3. `.env` dosyasına bilgileri girin

## 10. Permissions

```bash
chmod -R 755 storage bootstrap/cache
chown -R username:username storage bootstrap/cache
```

## 11. Test

1. https://snapurl.to adresini ziyaret edin
2. Link oluşturmayı test edin
3. Dashboard'a giriş yapın
4. QR kod oluşturmayı test edin

## Sorun Giderme

### 500 Error
- `.env` dosyasını kontrol edin
- `storage/logs` klasörüne yazma izni verin
- `APP_DEBUG=true` yapıp hata mesajını kontrol edin

### Database Connection Error
- Database bilgilerini kontrol edin
- Hostinger'da database'in aktif olduğundan emin olun

### Route Not Found
- `php artisan route:cache` çalıştırın
- `.htaccess` dosyasını kontrol edin

### Permission Denied
- `storage` ve `bootstrap/cache` klasörlerine yazma izni verin

