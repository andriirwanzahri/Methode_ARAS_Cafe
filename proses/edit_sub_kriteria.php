<?php
require "koneksi.php";

// Ambil data dari form
$id_sub_kriteria = $_POST['id_sub_kriteria'];
$kriteria_id = $_POST['kriteria_id'];
$nm_sub = $_POST['nm_sub'];
$bobot = $_POST['bobot'];
$keterangan = $_POST['keterangan'];
// Validasi apakah semua field tidak kosong
if (empty($id_sub_kriteria) || empty($kriteria_id) || empty($nm_sub)) {
    echo "<script>
            alert('Maaf, semua data tidak boleh kosong');
            window.location = '../dt_sub_kriteria.php';
        </script>";
    exit;
}

// Query untuk mengupdate data sub kriteria
$sql = "UPDATE sub_kriteria SET kriteria_id='$kriteria_id', nm_sub='$nm_sub' , nilai='$bobot', keterangan='$keterangan' WHERE id_sub_kriteria='$id_sub_kriteria' ";

// Eksekusi query dan cek apakah berhasil
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Data berhasil diubah');
            window.location = '../index.php?page=data_sub_kriteria';
        </script>";
} else {
    echo "<script>
            alert('Gagal mengubah data: " . mysqli_error($conn) . "');
            window.location = '../index.php?page=data_sub_kriteria';
        </script>";
}
