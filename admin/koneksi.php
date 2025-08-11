<?php

$_HOST = "localhost";
$_USERNAME = "root";
$_PASSWORD = "";
$_DATABASE = "db_portofolio_3_2025";

$koneksi = mysqli_connect($_HOST, $_USERNAME, $_PASSWORD, $_DATABASE);
if (!$koneksi) {
    echo "Koneksi Gagal :(";
}
