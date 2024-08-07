<?php
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sr_cafe";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data cafe
$alternatif_sql = "SELECT * FROM skor_alternatif";
$alternatif_result = $conn->query($alternatif_sql);

// Ambil data kriteria dan bobot
$kriteria_sql = "SELECT * FROM kriteria";
$kriteria_result = $conn->query($kriteria_sql);

// Buat array untuk menyimpan data cafe dan kriteria
$alternatif = [];
$kriteria = [];

// Simpan data cafe ke array
if ($alternatif_result->num_rows > 0) {
    while ($row = $alternatif_result->fetch_assoc()) {
        $alternatif[] = $row;
    }
}

// Simpan data kriteria ke array
if ($kriteria_result->num_rows > 0) {
    while ($row = $kriteria_result->fetch_assoc()) {
        $kriteria[$row['nama_kriteria']] = [
            'bobot' => $row['bobot'],
            'jenis_bobot' => $row['jenis_bobot'] // Menyimpan jenis kriteria (benefit atau cost)
        ];
    }
}

// Tampilkan matrik keputusan beserta jenis bobotnya
echo "<h1>Matrik Keputusan dengan Jenis Kriteria</h1>";
echo "<table border='1'>";
echo "<tr><th>Alternatif</th>";
foreach (array_keys($kriteria) as $key) {
    echo "<th>$key</th>";
}
echo "</tr>";

foreach ($alternatif as $alter) {
    echo "<tr>";
    echo "<td>{$alter['simbol_alternatif']}</td>";
    foreach (array_keys($kriteria) as $key) {
        echo "<td>{$alter[$key]}</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Tampilkan jenis dan bobot kriteria
echo "<h1>Jenis dan Bobot Kriteria</h1>";
echo "<table border='1'>";
echo "<tr><th>Kriteria</th><th>Jenis</th><th>Bobot</th></tr>";

foreach ($kriteria as $key => $value) {
    echo "<tr>";
    echo "<td>$key</td>";
    echo "<td>{$value['jenis_bobot']}</td>";
    echo "<td>{$value['bobot']}</td>";
    echo "</tr>";
}
echo "</table>";

// Cari nilai terbesar dan terkecil untuk setiap kriteria
$max_values = [];
$min_values = [];

$kriteria_keys = array_keys($kriteria);

foreach ($kriteria_keys as $key) {
    $max_values[$key] = max(array_column($alternatif, $key));
    $min_values[$key] = min(array_column($alternatif, $key));
}

// Tampilkan nilai terbesar dan terkecil untuk setiap kriteria
echo "<h1>Nilai Terbesar dan Terkecil untuk Setiap Kriteria</h1>";
echo "<table border='1'>";
echo "<tr><th>Kriteria</th><th>Nilai Terbesar</th><th>Nilai Terkecil</th></tr>";

foreach ($kriteria_keys as $key) {
    echo "<tr>";
    echo "<td>$key</td>";
    echo "<td>{$max_values[$key]}</td>";
    echo "<td>{$min_values[$key]}</td>";
    echo "</tr>";
}
echo "</table>";

// Tentukan nilai A0
$A0 = [];
foreach ($kriteria_keys as $key) {
    if ($kriteria[$key]['jenis_bobot'] == 'Benefit') {
        $A0[$key] = $max_values[$key];
    } else {
        $A0[$key] = $min_values[$key];
    }
}

// Tampilkan nilai A0
echo "<h1>Nilai A0 (Alternatif Ideal)</h1>";
echo "<table border='1'>";
echo "<tr><th>Kriteria</th><th>Nilai A0</th></tr>";
foreach ($A0 as $key => $value) {
    echo "<tr><td>$key</td><td>$value</td></tr>";
}
echo "</table>";

// Tambahkan A0 ke alternatif untuk normalisasi
$A0['simbol_alternatif'] = 'A0';
array_unshift($alternatif, $A0);

// Tampilkan matriks keputusan dengan A0
echo "<h1>Matriks Keputusan dengan A0</h1>";
echo "<table border='1'>";
echo "<tr><th>Alternatif</th>";
foreach (array_keys($kriteria) as $key) {
    echo "<th>$key</th>";
}
echo "</tr>";

foreach ($alternatif as $alter) {
    echo "<tr>";
    echo "<td>{$alter['simbol_alternatif']}</td>";
    foreach (array_keys($kriteria) as $key) {
        echo "<td>{$alter[$key]}</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Proses normalisasi
echo "<h1>Proses Normalisasi</h1>";
echo "<table border='1'>";
echo "<tr><th>Alternatif</th>";
foreach ($kriteria_keys as $key) {
    echo "<th>Normalisasi $key</th>";
}
echo "</tr>";

// Inisialisasi array untuk menyimpan nilai normalisasi
$normalized_alternatif = [];

foreach ($alternatif as $alter) {
    echo "<tr>";
    echo "<td>{$alter['simbol_alternatif']}</td>";
    $normalized_alter = [];
    foreach ($kriteria_keys as $key) {
        if ($kriteria[$key]['jenis_bobot'] == 'Benefit') {
            // Normalisasi kriteria benefit dengan membagi nilai kriteria dengan nilai maksimum
            $sum_values = array_sum(array_column($alternatif, $key));
            $normalized_alter[$key] = $alter[$key] / $sum_values;
        } else {
            // Normalisasi kriteria cost dengan rumus 1/nilai / sum (1/nilai)
            $denominator = array_sum(array_map(function ($alt) use ($key) {
                return 1 / $alt[$key];
            }, $alternatif));
            $normalized_alter[$key] = (1 / $alter[$key]) / $denominator;
        }
        echo "<td>" . number_format($normalized_alter[$key], 3, '.', '') . "</td>";
    }
    $normalized_alternatif[$alter['simbol_alternatif']] = $normalized_alter;
    echo "</tr>";
}
echo "</table>";

// Hitung skor ARAS untuk setiap cafe
$aras_scores = [];

foreach ($normalized_alternatif as $cafe_name => $criteria_values) {
    $aras_score = 0;
    foreach ($criteria_values as $key => $value) {
        // Hitung skor dengan mengalikan nilai normalisasi dengan bobot kriteria dan menjumlahkannya
        $aras_score += $value * $kriteria[$key]['bobot'];
    }
    $aras_scores[$cafe_name] = $aras_score;
}

// Tampilkan hasil
arsort($aras_scores);

echo "<h1>Rangking Cafe Berdasarkan Skor ARAS:</h1>";
echo "<table border='1'>";
echo "<tr><th>Rangking</th><th>Cafe</th><th>Skor ARAS</th></tr>";
$rank = 1;
foreach ($aras_scores as $cafe_name => $score) {
    echo "<tr><td>$rank</td><td>$cafe_name</td><td>" . number_format($score, 3, '.', '') . "</td></tr>";
    $rank++;
}
echo "</table>";

// Tutup koneksi
$conn->close();
?>