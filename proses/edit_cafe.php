<?php
require 'koneksi.php';
session_start(); // Mulai session jika diperlukan

if (isset($_POST['id_cafe']) && isset($_POST['nm_cafe']) && isset($_POST['alamat']) && isset($_POST['deskripsi'])) {
    $id_cafe = $_POST['id_cafe'];
    $nm_cafe = $_POST['nm_cafe'];
    $inisial = $_POST['inisial'];
    $alamat = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE cafes SET nm_cafe='$nm_cafe', inisial_cafe='$inisial', alamat='$alamat', deskripsi='$deskripsi' WHERE id_cafe='$id_cafe'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('Data berhasil diubah');
                window.location.href = '../index.php?page=data_cafe';
            </script>";
    } else {
        echo "<script>
                alert('Gagal mengedit data cafe');
                window.location.href = '../index.php?page=data_cafe';
            </script>";
    }
} else {
    echo "<script>
            alert('Data tidak lengkap');
            window.location.href = '../index.php?page=data_cafe';
        </script>";
}
