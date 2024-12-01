#### PHP
```bash
sudo apt install php php-cli php-mbstring php-xml php-curl php-zip php-mysql php-bcmath php-json
```
verify:
```bash
php -v
```

#### Composer
```bash
curl -sS https://getcomposer.org/installer | php
```
Move composer to a global path:
```bash
sudo mv composer.phar /usr/local/bin/composer
```
verify:
```bash
composer -v
```

#### MariaDB
```bash
sudo apt install mariadb-server
```

*Optional:* enable MariaDB service to start on boot:
```bash
sudo systemctl enable mariadb
```

Open MariaDB:
```bash
sudo mysql -u root
```

```sql
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
FLUSH PRIVILEGES;
```

(`EXIT;` to exit)



#### Laravel
`cd` to the project dir
```bash
Change database name in `.env` file:
```bash
DB_DATABASE=istrobot
```

## Install dependencies:
```bash
composer install
npm install
npm run build
```

```bash
CREATE DATABASE istrobot;
EXIT;
```

```bash
php artisan migrate
php artisan db:seed
```

View database:
```bash
mysql istrobot -u root
```

```bash
SHOW TABLES;
DESCRIBE <table_name>;
``` 


## Run the app:
```bash
php artisan serve
```

## Fresh database:
```bash
php artisan migrate:fresh
php artisan db:seed
```


## Versions:
```
Composer version 2.8.1 2024-10-04 11:31:01
PHP version 8.1.2-1ubuntu2.19
Laravel Framework 10.48.22
```