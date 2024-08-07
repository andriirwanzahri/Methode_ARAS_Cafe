<?php
require "koneksi.php";

$iduser = $_POST['iduser'];

$sql = "DELETE FROM users WHERE iduser='$iduser'";
$result = mysqli_query($conn, $sql);

if ($result) {
        echo "<script>
        alert('Data berhasil dihapus');
        window.location.href = '../dt_pengguna.php';
        </script>";
} else {
        echo "<script>
        alert('Data gagal dihapus');
        window.location.href = '../dt_pengguna.php';
        </script>";
}
?>