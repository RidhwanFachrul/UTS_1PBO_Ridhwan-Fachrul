<?php

require 'koneksi.php';

class Mahasiswa
{
    private $koneksi;

    public function __construct($db)
    {
        $this->koneksi = $db;
    }

    public function tambahMahasiswa($nama, $nim, $alamat, $email, $no_telp, $foto)
    {
        $query = "INSERT INTO mahasiswa (nama, nim, alamat, email, no_telp, foto) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("ssssss", $nama, $nim, $alamat, $email, $no_telp, $foto);
        $stmt->execute();
        $stmt->close();
    }

    public function lihatMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";
        $result = $this->koneksi->query($query);
        return $result;
    }

    public function lihatDetailMahasiswa($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = ?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function updateMahasiswa($id, $nama, $nim, $alamat, $email, $no_telp, $foto)
    {
        $query = "UPDATE mahasiswa SET nama=?, nim=?, alamat=?, email=?, no_telp=?, foto=? WHERE id_mahasiswa=?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("ssssssi", $nama, $nim, $alamat, $email, $no_telp, $foto, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function hapusMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id_mahasiswa=?";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>