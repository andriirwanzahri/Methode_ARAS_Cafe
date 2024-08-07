<?php
require "koneksi.php";

$kriteria_id = $_POST['kriteria_id'];

$sql = mysqli_query($conn, "DELETE FROM kriteria WHERE kriteria_id=$kriteria_id");

if ($sql) {
        echo "<script>
                alert('Data berhasil dihapus');
                window.location = '../dt_kriteria.php';
        </script>";
} else {
        echo "<script>
                alert('Data gagal dihapus');
                window.location = '../dt_kriteria.php';
        </script>";
}