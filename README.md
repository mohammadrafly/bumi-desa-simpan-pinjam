<br />
<div id="readme-top" align="center">
  <a href="https://github.com/mohammadrafly/pupak-indonesia">
    <img src="images/logo-project.png" alt="Logo" width="120" height="80">
  </a>

<h3 align="center">Sistem Simpan Pinjam Bumi Desa</h3>

  <p align="center">
    Sistem Simpan Pinjam yang visinya untuk mempermudah rekap dan pendataan simpan pinjam di sebuah desa
    <br />
  </p>
</div>

<!-- GETTING STARTED -->
## Getting Started

## BUMDES
Ikuti langkah-langkah dibawah ini:

### Built With

* CI4

### Prerequisites
\
Penting! install bahan dibawah ini:
* composer
* phpmyadmin (xampp,laragon)
* php-8+
* php-ext: mbstring & intl
* terminal/cmd (administrator/root)

### Installation

* ganti env menjadi .env
* setting env
   ```sh
    database.default.database = ci4
    database.default.username = root
    database.default.password = root
   ```
* Install Dependencies |
  Jika terjadi error, hapus composer.lock terlebih dahulu
   ```sh
   composer update
   ```
* Migrate Database
   ```sh
   import bumdes.sql ke phpmyadmin
   ```
* Run App
   ```sh
   php spark serve
   ```
