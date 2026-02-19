# Backend Deployment

## Upload to Hostinger

1. Upload entire `ai-agents` folder
2. Point domain to `public_html` → `ai-agents/public`
3. Run on server:
```bash
composer install --no-dev
php artisan migrate
chmod -R 775 storage bootstrap/cache
```

## Environment

Update `.env`:
```
APP_URL=https://lightslategrey-gorilla-734246.hostingersite.com
DEEPSEEK_API_KEY=your_key
```

## Cron Job (Auto News)

Add to crontab:
```
* * * * * cd /path/to/ai-agents && php artisan schedule:run >> /dev/null 2>&1
```
