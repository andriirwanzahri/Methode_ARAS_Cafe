<?php
require 'koneksi.php';

// Tambah sub kriteria baru
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kriteria_id = $_POST['kriteria_id'];
    $nm_sub = $_POST['nm_sub'];
    $bobot = $_POST['bobot'];
    $keterangan = $_POST['keterangan'];

    $addtotable = mysqli_query($conn, "INSERT INTO sub_kriteria (kriteria_id, nm_sub, nilai, keterangan) VALUES ('$kriteria_id', '$nm_sub', '$bobot', '$keterangan')");

    if ($addtotable) {
        echo "<script>
                alert('Sub kriteria berhasil ditambahkan');
                window.location.href = '../index.php?page=data_sub_kriteria';
            </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan sub kriteria');
                window.location.href = '../index.php?page=data_sub_kriteria';
            </script>";
    }
}
