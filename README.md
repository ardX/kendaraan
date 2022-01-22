# Kendaraan
## _Backend penjualan kendaraan bekas sederhana_

Kendaraan adalah aplikasi backend sederhana untuk penjualan kendaraan bekas meliputi mobil dan motor.

## Fitur

- Menambah data kendaraan bekas
- Penjualan kendaraan bekas
- Laporan keuntungan penjualan

## Software yang digunakan

Kendaraan menggunakan beberapa software framework, dan library untuk dapat bisa berjalan dengan baik:

- Laravel 8
- PHP 8
- MongoDB 4.2
- JWT

## Instalasi

Instalasi menggunakan basis Debian 9 Stretch. Untuk distro lain dapat menyesuaikan.

Instalasi beberapa tools yang digunakan (nginx dan package lainnya)
```sh
sudo apt update
sudo apt upgrade
sudo apt install -y git nano nginx nginx-extras software-properties-common lsb-release apt-transport-https ca-certificates curl software-properties-common gnupg2 wget unzip
```

Instalasi PHP 8.0 dan PHP MongoDB
```sh
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/sury-php.list
wget -qO - https://packages.sury.org/php/apt.gpg | sudo apt-key add -
sudo apt update
sudo apt install php8.0 php8.0-fpm php8.0-dev php8.0-mongodb php8.0-xml php8.0-zip php8.0-cli php8.0-curl php8.0-mbstring php8.0-bz2 php8.0-gd php8.0-imap  php8.0-bcmath php-zip
sudo update-alternatives --set php /usr/bin/php8.0
sudo update-alternatives --set php-config /usr/bin/php-config8.0
sudo update-alternatives --set phpize /usr/bin/phpize8.0
sudo pecl install mongodb
```
Silahkan tambahkan ekstensi mongodb ke php.ini

Instalasi MongoDB 4.2
```sh
curl https://www.mongodb.org/static/pgp/server-4.2.asc | sudo apt-key add -
sudo nano /etc/apt/sources.list.d/mongodb-org-4.2.list
sudo apt update
sudo apt-get install mongodb-org
sudo curl -o /etc/init.d/mongod https://raw.githubusercontent.com/mongodb/mongo/master/debian/init.d
sudo chmod +x /etc/init.d/mongod
sudo service mongod enable
sudo service mongod start
sudo service mongod status
```
Cek apakah service mongod sudah berjalan dengan baik.

Instalasi Composer

```sh
wget -O composer-setup.php https://getcomposer.org/installer
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

Unduh project dari GitHub
> project dibangun dengan laravel 8.*
> composer create-project laravel/laravel="8.*" namaproject

```sh
git clone https://github.com/ardX/kendaraan.git
cd kendaraan
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```
Backend sudah dapat diakses melalui http://localhost:8000/api

## Tautan yang dapat diakses
- http://localhost:8000/api/register digunakan untuk pendaftaran pengguna
- http://localhost:8000/api/login digunakan untuk pengguna masuk
- http://localhost:8000/api/mobil digunakan untuk menampilkan daftar mobil + CRUD
- http://localhost:8000/api/motor digunakan untuk menampilkan daftar motor + CRUD
- http://localhost:8000/api/jual/mobil digunakan untuk menampilkan daftar penjualan mobil + CRUD
- http://localhost:8000/api/jual/motor digunakan untuk menampilkan daftar penjualan motor + CRUD
- http://localhost:8000/api/stock/mobil digunakan untuk menampilkan jumlah stok mobil
- http://localhost:8000/api/stock/motor digunakan untuk menampilkan  jumlah stok motor
- http://localhost:8000/api/report/mobil/{id?} digunakan untuk menampilkan laporan keuntungan penjualan mobil
- http://localhost:8000/api/report/motor/{id?} digunakan untuk menampilkan laporan keuntungan penjualan motor

## License

MIT

**Software gratis, yay!**
