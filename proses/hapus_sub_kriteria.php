<?php
require "koneksi.php";

$id_sub_kriteria = $_POST['id_sub_kriteria'];

$sql = mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");

if ($sql) {
        echo "<script>
                alert('Data berhasil dihapus');
                window.location = '../index.php?page=data_sub_kriteria';
        </script>";
} else {
        echo "<script>
                alert('Data gagal dihapus');
                window.location = '../index.php?page=data_sub_kriteria';
        </script>";
}
