<?php
require "koneksi.php";

if (isset($_POST['iduser'])) {
    $iduser = $_POST['iduser'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET nama='$nama', username='$username', email='$email', role='$role' WHERE iduser='$iduser'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('Data berhasil diupdate');
                window.location.href = '../dt_pengguna.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data pengguna. Silakan coba lagi.');
                window.location.href = '../dt_pengguna.php';
            </script>";
    }
} else {
    header('Location: ../dt_pengguna.php');
    exit;
}
?>