
<?php

// Koneksi ke database (gantilah sesuai dengan pengaturan database Anda)
$host = "localhost";
$username = "root";
$password = "";
$database = "uts_pbo";

$koneksi = mysqli_connect( $host, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}