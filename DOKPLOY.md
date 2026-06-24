# Deploying SnapURL to Dokploy

This repo ships a production-ready Docker Compose stack:

| Service     | Role                                            |
|-------------|-------------------------------------------------|
| `app`       | nginx + php-fpm (the web app, port 80 internal) |
| `queue`     | `php artisan queue:work`                         |
| `scheduler` | `php artisan schedule:work`                      |
| `db`        | MySQL 8                                          |
| `redis`     | Redis 7 (cache / sessions / queue)              |

Migrations, `storage:link`, and config/route/view caching run automatically
on `app` startup (see `docker/entrypoint.sh`).

## 1. Prerequisites
- A server with Dokploy installed.
- This repo pushed to GitHub (already done): `doctorcmptrmita2/SnapURL`.

## 2. Create the project in Dokploy
1. **Projects → Create Project** → name it `SnapURL`.
2. **Create Service → Compose**.
3. **Provider:** GitHub → select `doctorcmptrmita2/SnapURL`, branch `main`.
4. **Compose Path:** `docker-compose.yml`.

## 3. Set environment variables
Open the **Environment** tab and paste the contents of
`.env.dokploy.example`, then fill in real values.

Generate an app key locally and paste it as `APP_KEY`:
```bash
php artisan key:generate --show
```
Important: `DB_HOST=db` and `REDIS_HOST=redis` (the compose service names),
and set strong `DB_PASSWORD` / `DB_ROOT_PASSWORD`.

## 4. Add the domain
1. **Domains** tab → Add Domain.
2. Host: your domain, **Service:** `app`, **Container Port:** `80`.
3. Enable HTTPS (Let's Encrypt). Make sure your domain's DNS A record
   points to the server first.

The `app` service is attached to the external `dokploy-network` so Dokploy's
Traefik can route the domain to it. `db`/`redis` stay on the private network.

## 5. Deploy
Click **Deploy**. First build takes a few minutes (asset build + composer).
Watch the **Logs** tab; the `app` log should end with php-fpm + nginx running.

## 6. First-run admin user (optional)
There's an artisan command for an admin user. From the service's terminal
(Dokploy **Terminal** tab on the `app` container):
```bash
php artisan create:admin-user   # see app/Console/Commands/CreateAdminUser.php
```

## Updating
Push to `main`, then click **Redeploy** in Dokploy (or enable auto-deploy
via webhook in the service settings).

## Notes
- App data in `storage/app` persists via the `storage_data` volume.
- To use an external/managed MySQL instead of the bundled one, remove the
  `db` service and point `DB_HOST` at your managed host.
