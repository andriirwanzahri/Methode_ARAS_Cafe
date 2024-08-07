<?php
session_start();
require 'proses/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['log'])) {
    header('Location: auth/login.php');
    exit();
}

// Mengambil informasi pengguna dari session
$iduser = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Jika pengguna bukan admin, arahkan ke halaman login dengan pesan peringatan
if ($role !== 'admin') {
    echo "<script>
        alert('Maaf, Anda tidak memiliki akses!');
        window.location = 'auth/login.php';
    </script>";
    exit();
}

// Menghitung jumlah kriteria
$result = mysqli_query($conn, "SELECT COUNT(*) as total_kriteria FROM kriteria");
$data = mysqli_fetch_assoc($result);
$total_kriteria = $data['total_kriteria'];

// Menghitung jumlah alternatif
$result = mysqli_query($conn, "SELECT COUNT(*) as total_alternatif FROM cafes");
$data = mysqli_fetch_assoc($result);
$total_alternatif = $data['total_alternatif'];

// Menghitung jumlah pengguna
$result = mysqli_query($conn, "SELECT COUNT(*) as total_pengguna FROM users");
$data = mysqli_fetch_assoc($result);
$total_pengguna = $data['total_pengguna'];
// Menghitung jumlah Data cafe
$result = mysqli_query($conn, "SELECT COUNT(*) as total_pengguna FROM cafes");
$data = mysqli_fetch_assoc($result);
$total_cafes = $data['total_pengguna'];
require 'header.php';

if (isset($_GET['page'])) {
    if ($_GET['page'] == "data_kriteria") {
        include 'dt_kriteria.php';
    } else if ($_GET['page'] == "data_cafe") {
        include 'dt_cafe.php';
    } else if ($_GET['page'] == "data_sub_kriteria") {
        include 'dt_sub_kriteria.php';
    } else if ($_GET['page'] == "data_alternatif") {
        include 'dt_alternatif.php';
    } else if ($_GET['page'] == "perhitungan_spk_aras") {
        include 'lihat_rekomendasi.php';
    } else if ($_GET['page'] == "data_pengguna") {
        include 'dt_pengguna.php';
    } elseif ($_GET['page'] == "logout") {

        $_SESSION = [];
        session_unset();
        session_destroy();
        echo "<script>location='auth/login.php';</script>";
    }
} else {
    include 'dashboard.php';
}

require 'footer.php';
