<?php
require 'function.php';

$mahasiswa = new Mahasiswa($koneksi);
$result = $mahasiswa->lihatMahasiswa();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $mahasiswa->hapusMahasiswa($id);
    echo "Data mahasiswa berhasil dihapus.";
    exit();
}
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
    <h2>Data Mahasiswa:</h2>
    <a href="tambah.php" class="btn btn-primary text-white">Tambah</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Foto</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id_mahasiswa'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['no_telp'] ?></td>
                    <td><img src="upload/<?= $row['foto'] ?>" alt='Foto' style='width: 50px; height: 50px;'></td>
                    <td>
                        <form action="" method="post">
                            <a class="btn btn-success" href="edit.php?id_mahasiswa=<?= $row['id_mahasiswa'] ?>">Edit</a>
                            <input type="hidden" name="id" value="<?= $row['id_mahasiswa'] ?>">
                            <input class="btn btn-danger" type="submit" value="Hapus">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>