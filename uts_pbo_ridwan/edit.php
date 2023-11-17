<?php
require 'function.php';

$mahasiswa = new Mahasiswa($koneksi);

$id = $_GET['id_mahasiswa'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa where id_mahasiswa='$id'");

if (isset($_POST['submit'])) {
    $id = $_POST['id_mahasiswa'];  // Ubah id menjadi id_mahasiswa

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];

    $foto = $_FILES["foto"];

    // Proses unggah foto
    if ($_FILES["foto"]["name"] != "") {
        $foto = $_FILES["foto"];
        $namaFoto = $foto["name"];
        $lokasiFoto = $foto["tmp_name"];
        $lokasiTujuan = "upload/$namaFoto";

        if (move_uploaded_file($lokasiFoto, $lokasiTujuan)) {
            $mahasiswa->updateMahasiswa($id, $nama, $nim, $alamat, $email, $no_telp, $namaFoto);
            echo "Data mahasiswa berhasil diperbarui.";
        } else {
            echo "Gagal mengunggah foto.";
        }
    } else {
        // Jika tidak ada foto yang diunggah
        $mahasiswa->updateMahasiswa($id, $nama, $nim, $alamat, $email, $no_telp, $foto);
        echo "Data mahasiswa berhasil diperbarui.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Mahasiswa</title>
</head>
<body>
    <h2>Form Update Mahasiswa</h2>
    <?php while ($d = mysqli_fetch_assoc($data)) : ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_mahasiswa" value="<?= $d['id_mahasiswa']; ?>">

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= $d['nama']; ?>" required><br>

            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" value="<?= $d['nim']; ?>" required><br>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required><?= $d['alamat']; ?></textarea><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $d['email']; ?>" required><br>

            <label for="no_telp">No Telp:</label>
            <input type="tel" id="no_telp" name="no_telp" value="<?= $d['no_telp']; ?>" required><br>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" accept="image/*"><br>
            <img src="upload/<?= $d['foto']; ?>" alt="Foto" style="width: 50px; height: 50px;"><br>

            <input type="submit" name="submit" value="Update">
        </form>
    <?php endwhile; ?>
</body>
</html>
