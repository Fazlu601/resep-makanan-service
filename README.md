# Resep Makanan Service with Laravel 10 
>Silahkan klik tombol dibawah ini untuk mengunjungi sisi Front-End <br> 👇👇👇

[![FrontEnd](https://img.shields.io/badge/FrontEnd-Kunjungi-087ea4?style=for-the-badge&logo=react&logoColor=white)](https://github.com/Fazlu601/resep-makanan-app)
## **Cara Instalasi & Pemakaian**
1. Clone Repository dari terminal command prompt atau bash
```
git clone https://github.com/Fazlu601/resep-makanan-service.git
```

2. Buat File ENV
```
cd resep-makanan-service
touch .env
```

3. Copy & Paste Ke file .env yang baru saja dibuat
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:4KqKVRHCep4V/ZoUEZnOo8e1Y0a7le2bbHYqXZWbWz8=
APP_DEBUG=true
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:5173

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_resep_makanan
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

4. Buka phpmyadmin dan buat database dengan nama ``db_resep_makanan``

5. Install Dependency Package
```
composer update
```

5. Jika semua dependency berhasil diinstall coba jalankan server di terminal dengan perintah
```
php artisan ser
```

6. Jika berhasil menjalankan perintah ``php artisan ser``, maka seharusnya akan muncul url dari aplikasi laravel kita copy dan paste url tersebut di browser

7. Jika muncul data objek seperti dibawah ini artinya server sudah berjalan sebagaimana mestinya
![An old rock in the desert](/public/img/Capture.PNG "Shiprock, New Mexico by Beau Rogers")

## **Dokumentasi API**
### **Authorization**
- URL : ``http://127.0.0.1:8000/api/register``
- METHOD : ``POST``
![An old rock in the desert](/public/img/login.PNG "Shiprock, New Mexico by Beau Rogers")

### **Authenticate**
- URL : ``http://127.0.0.1:8000/api/register``
- METHOD : ``POST``
![An old rock in the desert](/public/img/login.PNG "Shiprock, New Mexico by Beau Rogers")
