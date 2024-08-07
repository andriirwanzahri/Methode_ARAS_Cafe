<?php
require 'koneksi.php';

if (isset($_POST['id_cafe'])) {
    $id_cafe = $_POST['id_cafe'];

    $sql = "DELETE FROM cafes WHERE id_cafe='$id_cafe'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('Data cafe berhasil dihapus');
                window.location.href = '../dt_cafe.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data cafe');
                window.location.href = '../dt_cafe.php';
            </script>";
    }
} else {
    echo "<script>
            alert('ID cafe tidak ditemukan');
            window.location.href = '../dt_cafe.php';
        </script>";
}
?>