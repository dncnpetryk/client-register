## Client Account Self Registration

Objective of this proposal to build an api using laravel+mysql (details below) to allow clients to self register accounts to gain login access on xyz applications.
**php version must be 7.4 or higher**

### Installation

- clone the repository

```bash
git clone git@github.com:dncnpetryk/client-register.git
```

- switch to the project folder

```bash
cd client-register
```


- setup development domain

```bash
echo "127.0.0.1    client-register.local.com" | sudo tee -a /etc/hosts
```

- apache virtualhost config

```bash
sudo cp .config/apache2/client-register.local.com.conf /etc/apache2/sites-available/client-register.local.com.conf
sudo a2ensite client-register.local.com.conf
sudo service apache2 reload
```

- install dependencies

``` bash
composer install
```

- setup environment configuration

```bash
cp .env.example .env
```

- run this code for create the symbolic link

```bash
php artisan storage:link
```

- setup database

```bash
php artisan migrate
```

- configure permissions

```bash
chmod 777 -R storage bootstrap/cache
```

- run tests

```bash
./vendor/bin/phpunit
```
