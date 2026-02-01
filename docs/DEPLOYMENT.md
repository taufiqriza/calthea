# Deployment (Production)

This document is the internal runbook for Calthea production hosting and deployment.
Keep this file private. If the repository becomes public, move this to a private wiki or redact the server details.

## Roles

- Owner/DevOps: manages hosting, DNS, and SSH access.
- Developer: deploys with approved access and follows this runbook.

## Production Hosting

- Provider: Hostinger
- Domain: caltheabatu.com
- SSH Host: 145.223.108.160
- SSH Port: 65002
- SSH User: u435085854
- Project root: /home/u435085854/domains/caltheabatu.com/apps/caltheabatu/core
- Public web root (symlinked): /home/u435085854/domains/caltheabatu.com/apps/caltheabatu/core/public
- Git branch: production

Suggested local SSH alias:

```
Host calthea-prod
  HostName 145.223.108.160
  Port 65002
  User u435085854
```

## Deployment Steps (Manual)

1) Build locally
```
npm run build
```

2) Commit and push to `production`
```
git add .
git commit -m "Your message"
git push origin production
```

3) Pull on server
```
ssh -p 65002 u435085854@145.223.108.160
cd /home/u435085854/domains/caltheabatu.com/apps/caltheabatu/core
git pull origin production
```

4) Run migrations (if any)
```
php artisan migrate --force
```

5) Sync Vite build assets
```
rsync -avz --delete public/build/ \
  u435085854@145.223.108.160:/home/u435085854/domains/caltheabatu.com/apps/caltheabatu/core/public/build/
```

6) Sync public storage assets (only if new/changed)
```
rsync -avz storage/app/public/ \
  u435085854@145.223.108.160:/home/u435085854/domains/caltheabatu.com/apps/caltheabatu/core/storage/app/public/
```

7) Optional cache clear (only if config/routes/views changed)
```
php artisan optimize:clear
```

8) Verify
- Open website and admin dashboard
- Place a test order and verify it appears in admin

## Rollback (Safe Option)

If a deploy has an issue, prefer reverting the bad commit:
```
git revert <bad-commit>
git push origin production
```
Then repeat the deployment steps to pull the revert.

