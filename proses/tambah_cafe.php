<?php
require 'koneksi.php';

if (isset($_POST['nm_cafe']) && isset($_POST['alamat']) && isset($_POST['deskripsi'])) {



    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Data untuk tabel cafes
        $nm_cafe = $_POST['nm_cafe'];
        $inisial_cafe = $_POST['inisial'];
        $alamat = $_POST['alamat'];
        $deskripsi = $_POST['deskripsi'];

        // Masukkan data ke tabel cafes
        $sql1 = "INSERT INTO cafes (nm_cafe, inisial_cafe, alamat, deskripsi) VALUES ('$nm_cafe', '$inisial_cafe', '$alamat', '$deskripsi')";
        if ($conn->query($sql1) === TRUE) {
            $last_id = $conn->insert_id; // Dapatkan ID terakhir yang disisipkan

            // Data untuk tabel alternatif
            $fasilitas = 0;
            $menu_minuman = 0;
            $menu_makanan = 0;
            $suasana = 0;
            $lokasi = 0;
            $harga_minuman = 0;
            $harga_makanan = 0;

            // Masukkan data ke tabel alternatif dengan menggunakan foreign key
            $sql2 = "INSERT INTO alternatif (cafe_id, fasilitas, menu_minuman, menu_makanan, suasana, lokasi, harga_minuman, harga_makanan) VALUES ('$last_id', '$fasilitas', '$menu_minuman', '$menu_makanan', '$suasana', '$lokasi', '$harga_minuman', '$harga_makanan')";
            if ($conn->query($sql2) === TRUE) {
                // Jika kedua penyisipan berhasil, commit transaksi
                $conn->commit();
                echo "<script>
            alert('Data cafe berhasil ditambahkan, tolong tambahkan data alternatif');
            window.location.href = '../index.php?page=data_cafe';
        </script>";
                // echo "Data berhasil disimpan di kedua tabel.";
            } else {
                // Jika penyisipan ke tabel alternatif gagal, rollback transaksi
                $conn->rollback();
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        } else {
            // Jika penyisipan ke tabel cafes gagal, rollback transaksi
            $conn->rollback();
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        // Jika terjadi pengecualian, rollback transaksi
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script>
            alert('Data tidak lengkap, pastikan semua kolom diisi');
            window.location.href = '../dt_cafe.php';
        </script>";
}
