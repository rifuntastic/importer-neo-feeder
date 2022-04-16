<p align="center"><img src="https://raw.githubusercontent.com/rifuntastic/importer-neo-feeder/master/public/images/logo-importer.png" width="400"></p>
<br/><br/>
Importer aplikasi PDDIKTI Neo Feeder menggunakan file excel. Aplikasi ini dikembangkan menggunakan PHP versi 8.1.4 dengan framework Laravel versi 9.5.1

<br/>

## Persiapan

-   Install aplikasi web server, untuk mempermudah dapat mengunakan aplikasi : <a href="https://www.apachefriends.org/download.html">XAMPP</a>. Pastikan versi php yang digunakan minimal versi 8.
-   Install aplikasi <a href="https://git-scm.com/">Git</a>
-   Install aplikasi <a href="https://getcomposer.org/">Composer</a>
-   Install aplikasi text editor, seperti <a href="https://code.visualstudio.com/">Visual Studio Code</a> atau lainnya

<br/>

## Installasi / Clone Project

-   Buat database baru dengan membuka browser dan masuk ke halaman <a href="http://localhost/phpmyadmin">localhost/phpmyadmin</a>
-   Pada sebelah kiri klik New, dan masukkan nama database contoh : importer_neo_feeder lalu klik tombol Create
-   Dengan menggunakan terminal aplikasi Git Bash masuk pada folder htdocs aplikasi XAMPP dan lakukan clone project ini

```
git clone https://github.com/rifuntastic/importer-neo-feeder.git
```

-   Masuk ke folder project

```
cd importer-neo-feeder
```

-   Install depedencies

```
composer install
```

-   Setup environment variable

```
cp .env.example .env
```

-   Buka file .env dengan text editor dan edit pada bagian database berikut untuk nama, username, dan password database (sesuaikan dengan pengaturan database anda)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=importer_neo_feeder
DB_USERNAME=root
DB_PASSWORD=
```

-   Kembali ke terminal, generate APP_KEY

```
php artisan key:generate
```

-   Lakukan migrasi database

```
php artisan migrate
```

-   Jalankan aplikasi

```
php artisan serve
```

-   Buka browser

```
http://127.0.0.1:8000
```

<br/>

## Fitur

-   Insert Biodata Mahasiswa :white_check_mark:
-   Insert Riwayat Pendidikan Mahasiswa :white_check_mark:
-   Insert Mata Kuliah :hourglass_flowing_sand:

<br/>

## Kontak

Email : rivan.hadinata@gmail.com

<br/>

## Credits

-   Dashboard Template : <a href="https://github.com/BootstrapDash/skydash-free-bootstrap-admin-template" target="_blank">Skydash from BootstrapDash</a>
