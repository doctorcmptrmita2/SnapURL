# SnapURL.to - Privacy-First URL Shortener

A modern, privacy-first URL shortener and analytics platform built with Laravel 11.

## Features

- 🔗 Instant URL shortening without login
- 🎯 Custom slugs, expiration, and click limits
- 📊 Advanced analytics (clicks, referrers, devices, locations)
- 📱 QR code generation (SVG + PNG)
- 🔐 Password-protected links
- 🚀 REST API for integration
- 💳 Stripe billing (Free/Pro/Business plans)
- 👥 User dashboard with link management
- 🔒 Privacy-first (hashed IPs and User Agents)

## Tech Stack

- **Backend:** Laravel 11 (PHP 8.3)
- **Frontend:** Blade + Tailwind CSS
- **Database:** MySQL 8
- **Cache/Queue:** Redis
- **Auth:** Laravel Breeze + Sanctum
- **Payments:** Stripe

## Installation

### Using Docker (Recommended)

1. Clone the repository:
```bash
git clone <repository-url>
cd SnapURL
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Update `.env` with your configuration:
```env
APP_URL=https://snapurl.to
DB_DATABASE=snapurl
DB_USERNAME=snapurl
DB_PASSWORD=root
REDIS_HOST=redis
QUEUE_CONNECTION=redis
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

4. Start Docker containers:
```bash
docker-compose up -d
```

5. Install dependencies:
```bash
docker-compose exec app composer install
docker-compose exec app npm install
```

6. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

7. Run migrations and seeders:
```bash
docker-compose exec app php artisan migrate --seed
```

8. Build frontend assets:
```bash
docker-compose exec app npm run build
```

### Manual Installation

1. Install PHP 8.3, MySQL 8, Redis, and Composer
2. Clone the repository
3. Install dependencies:
```bash
composer install
npm install
```

4. Configure `.env` file
5. Run migrations:
```bash
php artisan migrate --seed
```

6. Build assets:
```bash
npm run build
```

## Usage

### Running Queue Worker

For background job processing (click logging, analytics aggregation):

```bash
php artisan queue:work
```

Or with Docker:
```bash
docker-compose exec queue php artisan queue:work
```

### Daily Analytics Aggregation

Set up a cron job to run daily:

```bash
php artisan links:aggregate
```

Or schedule it in `app/Console/Kernel.php`:

```php
$schedule->command('links:aggregate')->daily();
```

## API Usage

### Authentication

Get your API token from the dashboard, then use it in requests:

```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Accept: application/json" \
     https://snapurl.to/api/v1/links
```

### Create Link

```bash
curl -X POST https://snapurl.to/api/v1/links \
     -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     -d '{
       "destination_url": "https://example.com",
       "slug": "my-custom-slug",
       "expires_at": "2025-12-31",
       "max_clicks": 100
     }'
```

### Get Link Stats

```bash
curl https://snapurl.to/api/v1/links/1/stats \
     -H "Authorization: Bearer YOUR_TOKEN"
```

## Testing

Run Pest tests:

```bash
php artisan test
```

## License

MIT License
