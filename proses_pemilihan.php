<?php
require 'proses/koneksi.php';

// Ambil Data Kriteria
$query = "SELECT * FROM kriteria";
$result = $conn->query($query);
$kriteria = [];
while ($row = $result->fetch_assoc()) {
    $kriteria[] = $row;
}

// Ambil Data Alternatif
$query = "SELECT * FROM alternatif";
$result = $conn->query($query);
$alternatif = [];
while ($row = $result->fetch_assoc()) {
    $alternatif[] = $row;
}

// Ambil Data Cafe
$query = "SELECT * FROM cafes";
$result = $conn->query($query);
$cafes = [];
while ($row = $result->fetch_assoc()) {
    $cafes[] = $row;
}

// Proses Input Pengguna
$kriteria_pengguna = [];
foreach ($kriteria as $kriterium) {
    $kriteria_id = $kriterium['kriteria_id'];
    $kriteria_pengguna[] = isset($_POST["kriteria_$kriteria_id"]) ? (float)$_POST["kriteria_$kriteria_id"] : 0;
}

// Buat Matriks Keputusan dengan Skor dari Alternatif
$skor = [];
$nama_cafe = [];
foreach ($alternatif as $alt) {
    // Cari data cafe berdasarkan cafe_id
    $cafe = array_filter($cafes, function ($c) use ($alt) {
        return $c['id_cafe'] == $alt['cafe_id'];
    });

    // Ambil inisial cafe
    if (!empty($cafe)) {
        $cafe = array_values($cafe)[0]; // Ambil elemen pertama hasil filter
        $nama_cafe[] = $cafe['nm_cafe'];
    } else {
        $name_cafe[] = "Tidak Diketahui"; // Jika cafe_id tidak ditemukan
    }
    $skor[] = [
        $alt['fasilitas'],
        $alt['menu_minuman'],
        $alt['menu_makanan'],
        $alt['suasana'],
        $alt['lokasi'],
        $alt['harga_minuman'],
        $alt['harga_makanan']
    ];
}

// Langkah 1: Matriks Keputusan
$m = count($alternatif);
$n = count($kriteria);
$X = $skor;

// Langkah 2: Nilai Optimum
$X0 = $kriteria_pengguna;
array_unshift($X, $X0);

// var_dump($X0);
// Tampilkan Nilai Optimum
// echo "<h2>Langkah 2: Nilai Optimum</h2>";
// echo "<table border='1'><tr><th>Optimum</th>";
// foreach ($kriteria as $kriterium) {
//     echo "<th>{$kriterium['nama_kriteria']}</th>";
// }
// echo "</tr><tr><td>Optimum</td>";
// foreach ($X0 as $value) {
//     echo "<td>$value</td>";
// }
// echo "</tr></table><br>";

// Langkah 3: Matriks Keputusan Ternormalisasi
$X_norm = [];
for ($i = 0; $i <= $m; $i++) {
    for ($j = 0; $j < $n; $j++) {
        if ($kriteria[$j]['jenis_bobot'] == 'Benefit') {
            $X_norm[$i][$j] = $X[$i][$j] / array_sum(array_column($X, $j));
        } else {
            $X_norm[$i][$j] = (1 / $X[$i][$j]) / array_sum(array_map(function ($x) use ($j) {
                return 1 / $x[$j];
            }, $X));
        }
    }
}

// Langkah 4: Matriks Keputusan Ternormalisasi Berbobot
$D = [];
foreach ($X_norm as $i => $row) {
    foreach ($row as $j => $xij) {
        $D[$i][$j] = $xij * $kriteria[$j]['bobot'];
    }
}

// Langkah 5: Nilai Fungsi Optimalisasi (Si)
$S = [];
foreach ($D as $i => $row) {
    $S[$i] = array_sum($row);
}


// Langkah 6: Peringkat Alternatif
$K = [];
for ($i = 1; $i <= $m; $i++) {
    // Ki = Si/S0
    $K[$i] = $S[$i] / $S[0];
}

// Tampilkan Peringkat Alternatif
arsort($K);
$solusi_optimal = key($K);

// Cari dan Tampilkan Cafe Terdekat dengan Nilai Optimal
$cafe_terdekat = [];
foreach ($S as $i => $si) {
    if ($i > 0) {
        $perbedaan = abs($si - $S[0]);
        $cafe_terdekat[$nama_cafe[$i - 1]] = $perbedaan;
    }
}

// Urutkan berdasarkan perbedaan dan tampilkan
asort($cafe_terdekat);
// echo "<div class'mt-7'>";
echo "<h2 class='text-center mt-5'>Rekomendasi Cafe Untuk anda</h2>";
echo "<table class='table' border='1'><tr><th>Cafe</th><th>Alamat</th><th>Deskripsi Tempat</th></tr>";
foreach ($cafe_terdekat as $cafe => $perbedaan) {
    // Find the cafe address
    foreach ($cafes as $cafe_detail) {
        // var_dump($cafe_detail);
        if ($cafe_detail['nm_cafe'] == $cafe) {
            $alamat = $cafe_detail['alamat'];
            $deskripsi = $cafe_detail['deskripsi'];
            // break;
        }
    }
    // var_dump($alamat);
    echo "<tr><td>$cafe</td><td>$alamat</td><td>$deskripsi</td></tr>";
}
echo "</table><br>";
echo "<a href='user_index.php' class='btn btn-primary'>Kembali Kehalaman Utama</a>";
// echo "</div>";

$conn->close();
// require 'footer.php';
