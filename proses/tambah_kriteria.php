<?php
require 'koneksi.php';

// Tambah kriteria baru
if (isset($_POST['nama_kriteria']) && isset($_POST['bobot']) && isset($_POST['jenis_bobot']) && isset($_POST['smbl_kriteria'])) {
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot = $_POST['bobot'];
    $jenis_bobot = $_POST['jenis_bobot'];
    $smbl_kriteria = $_POST['smbl_kriteria'];

    // Get the current total bobot
    $result = mysqli_query($conn, "SELECT SUM(bobot) as total_bobot FROM kriteria");
    $row = mysqli_fetch_assoc($result);
    $current_total_bobot = $row['total_bobot'];

    // Check if adding the new bobot will exceed 1
    if ($current_total_bobot + $bobot <= 1) {
        $query = "INSERT INTO kriteria (nama_kriteria, bobot, jenis_bobot, smbl_kriteria) VALUES ('$nama_kriteria', '$bobot', '$jenis_bobot', '$smbl_kriteria')";
        $addtotable = mysqli_query($conn, $query);

        if ($addtotable) {
            echo "<script>
                    alert('Data kriteria berhasil ditambahkan');
                    window.location.href = '../dt_kriteria.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan data kriteria');
                    window.location.href = '../dt_kriteria.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Gagal menambahkan data kriteria, total bobot tidak boleh melebihi 1');
                window.location.href = '../dt_kriteria.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Lengkapi data kriteria');
            window.location.href = '../dt_kriteria.php';
        </script>";
}
?>