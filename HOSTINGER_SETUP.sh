#!/bin/bash

# Hostinger Production Setup Script
# Bu script'i SSH üzerinden çalıştırın

echo "🚀 SnapURL.to Production Setup Başlatılıyor..."

# Proje dizinine git
cd ~/snapurl || cd ~/public_html/.. || exit

# Composer dependencies yükle (production)
echo "📦 Composer dependencies yükleniyor..."
composer install --no-dev --optimize-autoloader

# .env dosyası kontrolü
if [ ! -f .env ]; then
    echo "📝 .env dosyası oluşturuluyor..."
    if [ -f .env.production ]; then
        cp .env.production .env
    else
        echo "⚠️  .env.production dosyası bulunamadı. Lütfen manuel olarak .env dosyası oluşturun."
        exit 1
    fi
fi

# Application key oluştur
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Application key oluşturuluyor..."
    php artisan key:generate --force
fi

# Cache temizle
echo "🧹 Cache temizleniyor..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Database migration
echo "🗄️  Database migration çalıştırılıyor..."
php artisan migrate --force

# Storage link
echo "🔗 Storage link oluşturuluyor..."
php artisan storage:link

# Permissions
echo "🔐 Permissions ayarlanıyor..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs

# Cache optimize
echo "⚡ Cache optimize ediliyor..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Setup tamamlandı!"
echo ""
echo "📋 Sonraki adımlar:"
echo "1. .env dosyasını düzenleyin (database, mail, stripe bilgileri)"
echo "2. Cron job ekleyin: * * * * * cd ~/snapurl && php artisan schedule:run >> /dev/null 2>&1"
echo "3. https://snapurl.to adresini test edin"

