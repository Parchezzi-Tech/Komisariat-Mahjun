# Railway Deployment Guide for Laravel

## Setup di Railway

### 1. Buat Akun Railway
- Kunjungi: https://railway.app
- Sign up dengan GitHub account
- Connect repository `Komisariat-Mahjun`

### 2. Create New Project
- Klik "New Project"
- Pilih "Deploy from GitHub repo"
- Pilih repository: `Parchezzi-Tech/Komisariat-Mahjun`

### 3. Add Database (MySQL)
- Di dashboard project, klik "+ New"
- Pilih "Database" → "Add MySQL"
- Railway akan otomatis create database dan environment variables

### 4. Configure Environment Variables
Masuk ke project settings → Variables, tambahkan:

```env
APP_NAME="Komisariat Mahjun"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

SESSION_DRIVER=database
CACHE_DRIVER=file
QUEUE_CONNECTION=database
LOG_CHANNEL=stack

RUN_MIGRATIONS=true
```

**Note:** Railway otomatis provide `${{MYSQLHOST}}`, `${{MYSQLPORT}}`, dll dari MySQL service.

### 5. Generate APP_KEY
Di local terminal:
```bash
php artisan key:generate --show
```
Copy hasilnya dan paste ke Railway environment variable `APP_KEY`.

### 6. Deploy
- Railway akan otomatis deploy setiap kali ada push ke branch `main`
- Monitor di "Deployments" tab
- Setelah selesai, klik "Open App" untuk melihat website

### 7. Run Migrations (Opsional)
Jika `RUN_MIGRATIONS=true` tidak jalan otomatis, bisa manual via Railway CLI:
```bash
railway run php artisan migrate --force
```

## Keuntungan Railway vs cPanel:
✅ Auto-deploy dari GitHub (no FTP needed)
✅ Free SSL certificate otomatis
✅ Environment variables management mudah
✅ Database included (MySQL/PostgreSQL)
✅ Logs realtime
✅ Custom domain support
✅ Scaling mudah

## Troubleshooting

### Permission Issues
Railway otomatis handle permissions, tapi jika ada masalah:
- Pastikan `railway-start.sh` ter-commit
- Check Deployment logs di Railway dashboard

### Database Connection
- Pastikan MySQL service sudah running
- Variable `${{MYSQL*}}` otomatis ter-inject Railway

### Build Failures
- Check "Build Logs" di Railway
- Biasanya karena missing extensions, tapi nixpacks.toml sudah handle ini
