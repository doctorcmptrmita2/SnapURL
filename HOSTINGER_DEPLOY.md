# SnapURL - Hostinger Deployment Rehberi

## 📋 Ön Hazırlık (Bilgisayarında Yapılacaklar)

Bu adımlar zaten tamamlandı:
- ✅ `npm run build` - Frontend derlendi
- ✅ `php artisan config:cache` - Config önbelleğe alındı
- ✅ `php artisan route:cache` - Route'lar önbelleğe alındı
- ✅ `php artisan view:cache` - View'lar önbelleğe alındı

---

## 🗄️ ADIM 1: Hostinger'da MySQL Veritabanı Oluştur

1. Hostinger hPanel'e giriş yap
2. **Databases** → **MySQL Databases** bölümüne git
3. Yeni veritabanı oluştur:
   - Database name: `snapurl` (otomatik prefix eklenir: `u123456789_snapurl`)
   - Username: `snapurl` (otomatik prefix eklenir)
   - Password: Güçlü bir şifre belirle
4. **Bu bilgileri not et!**

---

## 🗃️ ADIM 2: SQL Dosyasını İçe Aktar

1. **Databases** → **phpMyAdmin** aç
2. Sol menüden oluşturduğun veritabanını seç
3. Üst menüden **Import** sekmesine tıkla
4. **Choose File** → `database/snapurl_mysql.sql` dosyasını seç
5. **Go** butonuna tıkla
6. Tüm tablolar oluşturulacak

---

## 📁 ADIM 3: Dosyaları Yükle

### Yüklenmesi Gereken Klasörler/Dosyalar:
```
public_html/
├── .htaccess (← .htaccess.root dosyasını .htaccess olarak yeniden adlandır)
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env (← .env.production dosyasını .env olarak yeniden adlandır ve düzenle)
├── artisan
└── composer.json
```

### YÜKLENMEMESİ Gerekenler:
- `node_modules/` ❌
- `.git/` ❌
- `tests/` ❌
- `.env.example` ❌
- `database/database.sqlite` ❌

### Yükleme Yöntemi:
1. Tüm dosyaları ZIP'le (node_modules hariç)
2. Hostinger File Manager'da **public_html** klasörüne yükle
3. ZIP'i çıkart

---

## ⚙️ ADIM 4: .env Dosyasını Düzenle

`.env.production` dosyasını `.env` olarak yeniden adlandır ve şu değerleri güncelle:

```env
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
APP_URL=https://snapurl.to

DB_DATABASE=u123456789_snapurl
DB_USERNAME=u123456789_snapurl
DB_PASSWORD=HOSTINGER_DB_SIFRESI

MAIL_HOST=smtp.hostinger.com
MAIL_USERNAME=info@snapurl.to
MAIL_PASSWORD=MAIL_SIFRESI
```

### APP_KEY Oluşturma:
Bilgisayarında şu komutu çalıştır ve çıktıyı kopyala:
```bash
php artisan key:generate --show
```

---

## 📂 ADIM 5: Storage İzinleri

Hostinger File Manager'da şu klasörlerin izinlerini **755** yap:
- `storage/`
- `storage/app/`
- `storage/framework/`
- `storage/framework/cache/`
- `storage/framework/sessions/`
- `storage/framework/views/`
- `storage/logs/`
- `bootstrap/cache/`

---

## 🔗 ADIM 6: Symlink Oluştur (Opsiyonel)

Eğer dosya yükleme özelliği kullanacaksan:
1. Hostinger hPanel → **Advanced** → **Cron Jobs**
2. Bir kerelik çalıştır:
```
cd ~/public_html && php artisan storage:link
```

---

## ✅ ADIM 7: Test Et

1. https://snapurl.to adresini ziyaret et
2. Ana sayfa açılmalı
3. /login sayfasına git
4. Giriş yap:
   - Email: `admin@snapurl.to`
   - Password: `password123`
5. Dashboard'u kontrol et

---

## 🔧 Sorun Giderme

### 500 Internal Server Error
- `.env` dosyasını kontrol et
- Storage izinlerini kontrol et (755)
- `storage/logs/laravel.log` dosyasını incele

### 404 Not Found
- `.htaccess` dosyasının doğru yerde olduğundan emin ol
- mod_rewrite aktif mi kontrol et

### Database Connection Error
- DB bilgilerini kontrol et
- Hostinger'da veritabanı oluşturulmuş mu kontrol et

### CSS/JS Yüklenmiyor
- `public/build/` klasörünün yüklendiğinden emin ol
- `npm run build` çalıştırıldığından emin ol

---

## 📧 Mail Ayarları (Opsiyonel)

Hostinger'da email hesabı oluştur:
1. **Emails** → **Email Accounts**
2. `info@snapurl.to` oluştur
3. SMTP bilgilerini `.env`'e ekle

---

## 🎉 Tamamlandı!

Site artık https://snapurl.to adresinde yayında olmalı.

### Giriş Bilgileri:
- **URL:** https://snapurl.to/login
- **Email:** admin@snapurl.to
- **Password:** password123

⚠️ **ÖNEMLİ:** İlk girişten sonra şifreyi değiştir!
