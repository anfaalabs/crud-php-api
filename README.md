# Simple CRUD menggunakan sistem API pada PHP

## Instalasi

masuk ke folder `htdocs` dan clone repository ini

```
$ git clone https://github.com/anfaalabs/crud-php-api kampusku
```

buat satu database dengan nama bebas, contoh: `kampusku`

kemudian, import data yang ada di folder `database`

jika sudah berhasil diimport, edit file `_config.php`

```php
<?php

$db_connection = (object) [
  "SERVER" => "localhost", // ubah dengan server mu jika berbeda
  "USER" => "root", // ubah usernya jika berbeda
  "PASSWORD" => "", // isi passwordnya jika usernya dipakein password
  "DB_NAME" => "kampusku" // isi dengan nama database yang kamu buat
];

$base_path = "http://localhost/kampusku/"; // ubah base_path atau folder root aplikasi kalian

```
