<?php

// class ARAS
// {
//     private $conn;
//     public $kriteria = [];
//     public $alternatif = [];

//     public function __construct($conn)
//     {
//         $this->conn = $conn;
//         $this->fetchKriteria();
//     }

//     private function fetchKriteria()
//     {
//         $sql = "SELECT nama_kriteria, bobot, jenis_bobot FROM kriteria";
//         $result = $this->conn->query($sql);

//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $this->kriteria[] = $row;
//             }
//         } else {
//             throw new Exception('No criteria found in the database.');
//         }
//     }

//     public function fetchAlternatives()
//     {
//         $sql = "SELECT * FROM alternatif";
//         $result = $this->conn->query($sql);

//         if ($result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 $this->alternatif[] = $row;
//             }
//         } else {
//             throw new Exception('No alternatives found in the database.');
//         }
//     }

//     public function createDecisionMatrix()
//     {
//         $decision_matrix = [];
//         $max_values = [];
//         $min_values = [];

//         foreach ($this->kriteria as $krit) {
//             $values = array_column($this->alternatif, $krit['nama_kriteria']);
//             if (empty($values)) {
//                 throw new Exception("No values found for criteria '{$krit['nama_kriteria']}'.");
//             }
//             $max_values[$krit['nama_kriteria']] = max($values);
//             $min_values[$krit['nama_kriteria']] = min($values);
//         }

//         foreach ($this->alternatif as $alt) {
//             $row = [];
//             foreach ($this->kriteria as $krit) {
//                 $value = $alt[$krit['nama_kriteria']];
//                 if ($krit['jenis_bobot'] == 'benefit') {
//                     $normalized = $value / $max_values[$krit['nama_kriteria']];
//                 } else {
//                     $normalized = $min_values[$krit['nama_kriteria']] / $value;
//                 }
//                 $row[$krit['nama_kriteria']] = $normalized;
//             }
//             $decision_matrix[$alt['cafe_id']] = $row;
//         }
//         return $decision_matrix;
//     }

//     public function normalizeMatrix($decision_matrix)
//     {
//         $normalized_matrix = [];
//         $sigma = array_sum(array_map('array_sum', $decision_matrix));

//         foreach ($decision_matrix as $alt => $row) {
//             $normalized_row = [];
//             foreach ($row as $key => $value) {
//                 $normalized_row[$key] = $value / $sigma;
//             }
//             $normalized_matrix[$alt] = $normalized_row;
//         }
//         return $normalized_matrix;
//     }

//     public function weightNormalizedMatrix($normalized_matrix)
//     {
//         $weighted_matrix = [];
//         foreach ($normalized_matrix as $alt => $row) {
//             $weighted_row = [];
//             foreach ($row as $key => $value) {
//                 $kriteria = array_filter($this->kriteria, function ($k) use ($key) {
//                     return $k['nama_kriteria'] == $key;
//                 });
//                 $kriteria = array_values($kriteria)[0];
//                 $weighted_row[$key] = $value * $kriteria['bobot'];
//             }
//             $weighted_matrix[$alt] = $weighted_row;
//         }
//         return $weighted_matrix;
//     }

//     public function calculateOptimizationValue($weighted_matrix)
//     {
//         $optimization_values = [];
//         foreach ($weighted_matrix as $alt => $row) {
//             $optimization_values[$alt] = array_sum($row);
//         }
//         return $optimization_values;
//     }

//     public function calculateUtilityRanking($optimization_values)
//     {
//         $utility_ranking = [];
//         $s0 = max($optimization_values);

//         foreach ($optimization_values as $alt => $value) {
//             $utility_ranking[$alt] = $value / $s0;
//         }
//         arsort($utility_ranking);
//         return $utility_ranking;
//     }

//     public function printNormalizedMatrix($normalized_matrix)
//     {
//         echo "<table class='table'><thead><tr><th>Nama Alternatif</th>";
//         foreach ($this->kriteria as $krit) {
//             echo "<th>{$krit['nama_kriteria']}</th>";
//         }
//         echo "</tr></thead><tbody>";
//         foreach ($normalized_matrix as $alt => $values) {
//             echo "<tr><td>{$alt}</td>";
//             foreach ($values as $val) {
//                 echo "<td>{$val}</td>";
//             }
//             echo "</tr>";
//         }
//         echo "</tbody></table>";
//     }
// }

// try {

//     $conn = new mysqli('localhost', 'root', '', 'sr_cafe');
//     if ($conn->connect_error) {
//         throw new Exception('Database connection failed: ' . $conn->connect_error);
//     }

//     $aras = new ARAS($conn);
//     $aras->fetchAlternatives();
//     $decisionMatrix = $aras->createDecisionMatrix();
//     $normalizedMatrix = $aras->normalizeMatrix($decisionMatrix);
//     $weightedMatrix = $aras->weightNormalizedMatrix($normalizedMatrix);
//     $optimizationValues = $aras->calculateOptimizationValue($weightedMatrix);
//     $utilityRanking = $aras->calculateUtilityRanking($optimizationValues);
//     // $aras->printNormalizedMatrix($normalizedMatrix);
// } catch (Exception $e) {
//     echo 'Error: ' . $e->getMessage();
// }

// require 'proses/koneksi.php';

// // Ambil Data Kriteria
// $query = "SELECT * FROM kriteria";
// $result = $conn->query($query);
// $kriteria = [];
// while ($row = $result->fetch_assoc()) {
//     $kriteria[] = $row;
// }

// // Ambila Data Alternatif
// $query = "SELECT * FROM alternatif";
// $result = $conn->query($query);
// $alternatif = [];
// while ($row = $result->fetch_assoc()) {
//     $alternatif[] = $row;
// }

// // Ambil Data Cafe
// $query = "SELECT * FROM cafes";
// $result = $conn->query($query);
// $cafes = [];
// while ($row = $result->fetch_assoc()) {
//     $cafes[] = $row;
// }

// //  keluarkan nilai score dan nama cafe
// $skor = [];
// $names = [];
// foreach ($alternatif as $alt) {
//     $names[] = $cafes[$alt['cafe_id'] - 1]['nm_cafe']; // ambil Nama Cafe
//     $skor[] = [
//         $alt['fasilitas'],
//         $alt['menu_minuman'],
//         $alt['menu_makanan'],
//         $alt['suasana'],
//         $alt['lokasi'],
//         $alt['harga_minuman'],
//         $alt['harga_makanan']
//     ];
// }

// // Langkah 1: Matriks Keputusan
// $m = count($alternatif);
// $n = count($kriteria);
// $X = $skor;

// // tampilkan Matriks Keputusan
// echo "Langkah 1: Matriks Keputusan<br>";
// echo "<table border='1'><tr><th>Alternatif</th>";
// foreach ($kriteria as $kriterium) {
//     echo "<th>{$kriterium['nama_kriteria']}</th>";
// }
// echo "</tr>";
// foreach ($X as $i => $row) {
//     echo "<tr><td>{$names[$i]}</td>";
//     foreach ($row as $value) {
//         echo "<td>$value</td>";
//     }
//     echo "</tr>";
// }
// echo "</table><br>";

// // Langkah 2: Nilai Optimum
// $X0 = [];
// foreach ($kriteria as $j => $kriterium) {
//     if ($kriterium['jenis_bobot'] == 'Benefit') {
//         $X0[$j] = max(array_column($skor, $j));
//     } else {
//         $X0[$j] = min(array_column($skor, $j));
//     }
// }

// // Tambahkan Optimum kedalam baris Matrix
// array_unshift($X, $X0);

// // Tampilkan nilai optimum
// echo "Langkah 2: Nilai Optimum<br>";
// echo "<table border='1'><tr><th>Optimum</th>";
// foreach ($kriteria as $kriterium) {
//     echo "<th>{$kriterium['nama_kriteria']}</th>";
// }
// echo "</tr><tr><td>Optimum</td>";
// foreach ($X0 as $value) {
//     echo "<td>$value</td>";
// }
// echo "</tr></table><br>";

// // Langkah 3: Normalisasi Matriks Keputusan
// $X_norm = [];
// for ($i = 0; $i <= $m; $i++) {
//     for ($j = 0; $j < $n; $j++) {
//         if ($kriteria[$j]['jenis_bobot'] == 'Benefit') {
//             $X_norm[$i][$j] = $X[$i][$j] / array_sum(array_column($X, $j));
//         } else {
//             $X_norm[$i][$j] = (1 / $X[$i][$j]) / array_sum(array_map(function ($x) use ($j) {
//                 return 1 / $x[$j];
//             }, $X));
//         }
//     }
// }

// // tampilkan matriks keputusan ternormalisasi
// echo "Langkah 3: Matriks Keputusan Ternormalisasi<br>";
// echo "<table border='1'><tr><th>Alternatif</th>";
// foreach ($kriteria as $kriterium) {
//     echo "<th>{$kriterium['nama_kriteria']}</th>";
// }
// echo "</tr>";
// foreach ($X_norm as $i => $row) {
//     echo "<tr><td>" . ($i == 0 ? "Optimum" : $names[$i - 1]) . "</td>";
//     foreach ($row as $value) {
//         echo "<td>$value</td>";
//     }
//     echo "</tr>";
// }
// echo "</table><br>";

// // Langkah 4: Matriks Keputusan Ternormalisasi Berbobot
// $D = [];
// foreach ($X_norm as $i => $row) {
//     foreach ($row as $j => $xij) {
//         $D[$i][$j] = $xij * $kriteria[$j]['bobot'];
//     }
// }

// // Tampilkan matriks keputusan ternormalisasi berbobot
// echo "Langkah 4: Matriks Keputusan Ternormalisasi Berbobot<br>";
// echo "<table border='1'><tr><th>Alternatif</th>";
// foreach ($kriteria as $kriterium) {
//     echo "<th>{$kriterium['nama_kriteria']}</th>";
// }
// echo "</tr>";
// foreach ($D as $i => $row) {
//     echo "<tr><td>" . ($i == 0 ? "Optimum" : $names[$i - 1]) . "</td>";
//     foreach ($row as $value) {
//         echo "<td>$value</td>";
//     }
//     echo "</tr>";
// }
// echo "</table><br>";

// // Langkah 5: Nilai Fungsi Optimalisasi (Si)
// $S = [];
// foreach ($D as $i => $row) {
//     $S[$i] = array_sum($row);
// }

// // tampilkan Nilai Fungsi Optimalisasi
// echo "Langkah 5: Nilai Fungsi Optimalisasi (Si)<br>";
// echo "<table border='1'><tr><th>Alternatif</th><th>Si</th></tr>";
// foreach ($S as $i => $si) {
//     echo "<tr><td>" . ($i == 0 ? "Optimum" : $names[$i - 1]) . "</td><td>$si</td></tr>";
// }
// echo "</table><br>";

// // Langkah 6: Peringkat Alternatif
// $K = [];
// for ($i = 1; $i <= $m; $i++) {
//     $K[$i] = $S[$i] / $S[0];
// }

// // Tampilkan Peringkat Alternatif
// arsort($K);
// $solusi_optimal = key($K);

// // Tampilkan Peringkat
// echo "Langkah 6: Peringkat Alternatif (Ki)<br>";
// echo "<table border='1'><tr><th>Alternatif</th><th>Ki</th></tr>";
// foreach ($K as $i => $ki) {
//     echo "<tr><td>{$names[$i - 1]}</td><td>$ki</td></tr>";
// }
// echo "</table><br>";

// // Tampilkan Solusi Optimal yang di rekomendasikan
// echo "Alternatif Optimal: " . $names[$solusi_optimal - 1] . "<br>";

// $conn->close();
