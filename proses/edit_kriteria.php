<?php
require "koneksi.php";

$kriteria_id = $_POST['kriteria_id'];
$nama_kriteria = $_POST['nama_kriteria'];
$bobot = $_POST['bobot'];
$jenis_bobot = $_POST['jenis_bobot'];

// Validasi apakah bobot adalah angka valid
if (!is_numeric($bobot)) {
    echo "<script>
            alert('Maaf, bobot harus berupa angka');
            window.location = '../dt_kriteria.php';
        </script>";
    exit;
}

if (empty($nama_kriteria) || empty($bobot) || empty($jenis_bobot)) {
    echo "<script>
            alert('Maaf, semua data tidak boleh kosong');
            window.location = '../dt_kriteria.php';
        </script>";
} else {
    $sql = mysqli_query($conn, "UPDATE kriteria SET nama_kriteria='$nama_kriteria', bobot='$bobot', jenis_bobot='$jenis_bobot' WHERE kriteria_id='$kriteria_id'");
    if ($sql) {
        echo "<script>
                alert('Data berhasil diubah');
                window.location = '../dt_kriteria.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data');
                window.location = '../dt_kriteria.php';
            </script>";
    }
}
?>