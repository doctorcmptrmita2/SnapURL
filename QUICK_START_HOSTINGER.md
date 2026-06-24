# 🚀 Hostinger Quick Start - SnapURL.to

## Hızlı Kurulum (5 Dakika)

### 1️⃣ Dosya Yapısı

```
/home/username/
├── snapurl/              (proje root)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env              ← Buraya dikkat!
│   └── composer.json
└── public_html/           (public klasörü içeriği)
    ├── index.php
    ├── .htaccess
    └── build/
```

### 2️⃣ .env Dosyası (ÖNEMLİ!)

`snapurl/.env` dosyasını oluşturun:

```env
APP_NAME="SnapURL.to"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://snapurl.to

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=u123456789_snapurl
DB_USERNAME=u123456789_snapurl
DB_PASSWORD=your_password_here

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

**Hostinger'dan database bilgilerini alın!**

### 3️⃣ SSH Komutları

Hostinger Terminal'den:

```bash
cd ~/snapurl

# Dependencies
composer install --no-dev --optimize-autoloader

# Key oluştur
php artisan key:generate

# Database
php artisan migrate --force

# Link
php artisan storage:link

# Permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4️⃣ Cron Job

Hostinger Control Panel > Cron Jobs:

```
* * * * * cd /home/username/snapurl && php artisan schedule:run >> /dev/null 2>&1
```

### 5️⃣ Test

https://snapurl.to adresini açın! 🎉

## ⚠️ Önemli Notlar

1. **APP_DEBUG=false** - Mutlaka false olmalı!
2. **APP_URL=https://snapurl.to** - http değil, https!
3. **Database** - Hostinger'dan alınan bilgileri kullanın
4. **SSL** - Hostinger'da SSL aktif olmalı

## 🆘 Sorun mu var?

**500 Error:**
```bash
tail -f storage/logs/laravel.log
```

**Route bulunamıyor:**
```bash
php artisan route:clear
php artisan route:cache
```

**Permission hatası:**
```bash
chmod -R 755 storage bootstrap/cache
```

## 📞 Yardım

Detaylı bilgi için `DEPLOYMENT.md` dosyasına bakın.

