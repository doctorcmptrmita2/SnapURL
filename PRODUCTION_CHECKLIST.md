# Production Deployment Checklist - SnapURL.to

## ✅ Pre-Deployment Checklist

### 1. Environment Configuration
- [ ] `.env` dosyası oluşturuldu
- [ ] `APP_ENV=production` ayarlandı
- [ ] `APP_DEBUG=false` ayarlandı
- [ ] `APP_URL=https://snapurl.to` ayarlandı
- [ ] `APP_KEY` oluşturuldu (`php artisan key:generate`)

### 2. Database Configuration
- [ ] Hostinger'da MySQL database oluşturuldu
- [ ] Database user oluşturuldu ve yetkiler verildi
- [ ] `.env` dosyasında database bilgileri ayarlandı
- [ ] Migration'lar çalıştırıldı (`php artisan migrate --force`)
- [ ] Seeder'lar çalıştırıldı (opsiyonel)

### 3. File Permissions
- [ ] `storage` klasörüne yazma izni verildi (755 veya 775)
- [ ] `bootstrap/cache` klasörüne yazma izni verildi (755)
- [ ] `storage/logs` klasörüne yazma izni verildi (775)

### 4. Composer & Dependencies
- [ ] `composer install --no-dev --optimize-autoloader` çalıştırıldı
- [ ] Vendor klasörü yüklendi

### 5. Laravel Optimization
- [ ] `php artisan config:cache` çalıştırıldı
- [ ] `php artisan route:cache` çalıştırıldı
- [ ] `php artisan view:cache` çalıştırıldı
- [ ] `php artisan storage:link` çalıştırıldı

### 6. SSL & Domain
- [ ] SSL sertifikası aktif (Let's Encrypt)
- [ ] Domain `https://snapurl.to` olarak ayarlandı
- [ ] HTTPS yönlendirmesi çalışıyor

### 7. Cron Jobs
- [ ] Cron job eklendi: `* * * * * cd /path/to/snapurl && php artisan schedule:run >> /dev/null 2>&1`
- [ ] Queue worker ayarlandı (eğer kullanılıyorsa)

### 8. Email Configuration
- [ ] SMTP ayarları yapıldı (Hostinger mail)
- [ ] Test email gönderildi

### 9. Payment Integration (Stripe)
- [ ] Production Stripe keys eklendi
- [ ] Webhook endpoint ayarlandı: `https://snapurl.to/stripe/webhook`
- [ ] Webhook test edildi

### 10. Security
- [ ] `.env` dosyası `.gitignore`'da
- [ ] `APP_DEBUG=false` production'da
- [ ] Güvenlik headers kontrol edildi
- [ ] CSRF protection aktif

## 🚀 Deployment Steps

### Step 1: Upload Files
```bash
# FTP veya File Manager ile dosyaları yükleyin
# public/ klasörünün içeriği -> public_html/
# Diğer dosyalar -> public_html/../snapurl/
```

### Step 2: SSH Connection
```bash
ssh username@snapurl.to
cd ~/snapurl  # veya proje dizininiz
```

### Step 3: Environment Setup
```bash
# .env dosyasını oluştur ve düzenle
nano .env

# Application key oluştur
php artisan key:generate
```

### Step 4: Install Dependencies
```bash
composer install --no-dev --optimize-autoloader
```

### Step 5: Database Setup
```bash
php artisan migrate --force
php artisan db:seed --class=PlanSeeder  # Opsiyonel
```

### Step 6: Permissions
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
```

### Step 7: Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

### Step 8: Test
1. https://snapurl.to adresini ziyaret edin
2. Link oluşturmayı test edin
3. Login/Register test edin
4. Dashboard test edin
5. QR kod test edin

## 🔧 Post-Deployment

### Monitoring
- [ ] Error logs kontrol edildi (`storage/logs/laravel.log`)
- [ ] Performance test edildi
- [ ] SSL sertifikası kontrol edildi

### Backup
- [ ] Database backup planı oluşturuldu
- [ ] File backup planı oluşturuldu

## 📝 Important Notes

1. **APP_DEBUG**: Production'da mutlaka `false` olmalı
2. **APP_URL**: `https://snapurl.to` olmalı (http değil)
3. **Database**: Hostinger'dan alınan bilgiler kullanılmalı
4. **Permissions**: Storage klasörüne yazma izni mutlaka verilmeli
5. **SSL**: HTTPS zorunlu (Stripe webhook için)

## 🆘 Troubleshooting

### 500 Internal Server Error
```bash
# .env dosyasını kontrol et
# Log dosyasını kontrol et
tail -f storage/logs/laravel.log

# APP_DEBUG=true yapıp hata mesajını oku
```

### Route Not Found
```bash
php artisan route:clear
php artisan route:cache
```

### Permission Denied
```bash
chmod -R 755 storage bootstrap/cache
chown -R username:username storage bootstrap/cache
```

### Database Connection Error
- Hostinger Control Panel'den database bilgilerini kontrol et
- `.env` dosyasındaki bilgileri doğrula

