<?php
require 'koneksi.php';

if (isset($_POST['tambahAlternatif'])) {
    $cafe_id = $_POST['cafe_id'];
    $fasilitas = $_POST['fasilitas'];
    $menu_minuman = $_POST['menu_minuman'];
    $menu_makanan = $_POST['menu_makanan'];
    $suasana = $_POST['suasana'];
    $lokasi = $_POST['lokasi'];
    $harga_makanan = $_POST['harga_makanan'];
    $harga_minuman = $_POST['harga_minuman'];

    // Check if the cafe_id exists in the cafe table
    $cafe_check_query = "SELECT * FROM cafes WHERE id_cafe = '$cafe_id'";
    $result = mysqli_query($conn, $cafe_check_query);

    if (mysqli_num_rows($result) > 0) {
        // Cafe exists, proceed with insertion
        $query = "INSERT INTO alternatif (nm_cafe, fasilitas, menu_minuman, menu_makanan, suasana, lokasi, harga_makanan, harga_minuman) 
                VALUES ('$cafe_id', '$fasilitas', '$menu_minuman', '$menu_makanan', '$suasana', '$lokasi', '$harga_makanan', '$harga_minuman')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location='../dt_alternatif.php';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan!'); window.location='../dt_alternatif.php';</script>";
        }
    } else {
        // Cafe does not exist
        echo "<script>alert('Cafe tidak ditemukan!'); window.location='../dt_alternatif.php';</script>";
    }
}
?>