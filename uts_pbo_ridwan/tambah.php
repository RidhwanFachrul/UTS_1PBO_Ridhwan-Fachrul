<?php

require 'function.php';

$mahasiswa = new Mahasiswa($koneksi);

if (isset($_POST['submit'])) {

    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $alamat = $_POST["alamat"];
    $email = $_POST["email"];
    $no_telp = $_POST["no_telp"];

    $foto = $_FILES["foto"];
    $namaFoto = $foto["name"];
    $lokasiFoto = $foto["tmp_name"];
    $lokasiTujuan = "upload/$namaFoto";

    if (move_uploaded_file($lokasiFoto, $lokasiTujuan)) {
        $mahasiswa = new Mahasiswa($koneksi);
        $mahasiswa->tambahMahasiswa($nama, $nim, $alamat, $email, $no_telp, $namaFoto);
        echo "Mahasiswa berhasil ditambahkan.";
    } else {
        echo "Gagal mengunggah foto.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Mahasiswa</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
    <div class="judul">
    <h2>Data Mahasiswa</h2>
    

    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="no_telp">No Telp:</label>
        <input type="tel" id="no_telp" name="no_telp" required><br>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    </div>
</body>
</html>
