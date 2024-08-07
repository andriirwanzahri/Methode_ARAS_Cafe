<?php
require 'proses/koneksi.php';
?>

<h1 class="mt-4">Hitung SPK ARAS</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Lihat Rekomendasi</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple" class="table">
            <tbody>
                <?php
                // Ambil Data Kriteria
                $query = "SELECT * FROM kriteria";
                $result = $conn->query($query);
                $kriteria = [];
                while ($row = $result->fetch_assoc()) {
                    $kriteria[] = $row;
                }
                ?>
                <tr onclick="toggleContent('content1')">
                    <td>
                        <h3>Data Kriteria dan Bobot</h3>
                    </td>
                </tr>
                <tr id="content1" class="toggle-content">
                    <td>
                        <?php
                        echo "<table class='table' border='1'><tr>
                        <th>Nama kriteria</th>
                        <th>Bobot</th>
                        <th>Jenis</th>
                        </tr>";
                        foreach ($kriteria as $kriterium) {
                            echo "<tr>
                            <td>{$kriterium['nama_kriteria']}</td>";
                            echo "<td>{$kriterium['bobot']}</td>";
                            echo "<td>{$kriterium['jenis_bobot']}</td>";
                            echo "</tr>";
                        }
                        echo "</table><br>";
                        ?>
                    </td>
                </tr>
                <tr onclick="toggleContent('content2')">
                    <td>
                        <h3>Data Alternatif</h3>
                    </td>
                </tr>
                <tr id="content2" class="toggle-content">
                    <td>
                        <?php
                        // Ambil Data Alternatif
                        $query = "SELECT * FROM alternatif";
                        $result = $conn->query($query);
                        $alternatif = [];
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            $alternatif[] = $row;
                        }

                        echo "<table class='table' border='1'><tr>
                        <th>Nama Alternatif</th>";
                        foreach ($kriteria as $kriterium) {
                            echo "<th>{$kriterium['nama_kriteria']}</th>";
                        }
                        echo "</tr>";
                        foreach ($alternatif as $alt) {
                            echo "<tr>
                            <td>A" . $no++ . "</td>";
                            foreach ($kriteria as $kriterium) {
                                echo "<td>{$alt[$kriterium['nama_kriteria']]}</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table><br>";

                        // Ambil Data Cafe
                        $query = "SELECT * FROM cafes";
                        $result = $conn->query($query);
                        $cafes = [];
                        while ($row = $result->fetch_assoc()) {
                            $cafes[] = $row;
                        }

                        // Debug Data Cafe
                        // echo "<pre>";
                        // print_r($cafes);
                        // echo "</pre>";

                        // Keluarkan nilai score dan nama cafe
                        $skor = [];
                        $names = [];
                        foreach ($alternatif as $alt) {
                            // Cari data cafe berdasarkan cafe_id
                            $cafe = array_filter($cafes, function ($c) use ($alt) {
                                return $c['id_cafe'] == $alt['cafe_id'];
                            });

                            // Ambil inisial cafe
                            if (!empty($cafe)) {
                                $cafe = array_values($cafe)[0]; // Ambil elemen pertama hasil filter
                                $names[] = $cafe['inisial_cafe'];
                            } else {
                                $names[] = "Tidak Diketahui"; // Jika cafe_id tidak ditemukan
                            }

                            // Tambahkan skor
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

                        // Debug Data Skor dan Names
                        // echo "<pre>";
                        // print_r($names);
                        // print_r($skor);
                        // echo "</pre>";
                        ?>
                    </td>
                </tr>
                <tr onclick="toggleContent('content3')">
                    <td>
                        <h3>Perhitungan SPK ARAS</h3>
                    </td>
                </tr>
                <tr id="content3" class="toggle-content">
                    <td>
                        <?php
                        // Langkah 1: Matriks Keputusan
                        $m = count($alternatif);
                        $n = count($kriteria);
                        $X = $skor;

                        // Tampilkan Matriks Keputusan
                        echo "Langkah 1: Matriks Keputusan<br>";
                        echo "<table class='table' border='1'><tr><th>Alternatif</th>";
                        foreach ($kriteria as $kriterium) {
                            echo "<th>{$kriterium['nama_kriteria']}</th>";
                        }
                        echo "</tr>";
                        foreach ($X as $i => $row) {
                            echo "<tr><td>{$names[$i]}</td>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table><br>";

                        // Langkah 2: Nilai Optimum
                        $X0 = [];
                        foreach ($kriteria as $j => $kriterium) {
                            if ($kriterium['jenis_bobot'] == 'Benefit') {
                                $X0[$j] = max(array_column($skor, $j));
                            } else {
                                $X0[$j] = min(array_column($skor, $j));
                            }
                        }

                        // Tambahkan Optimum ke dalam baris Matrix
                        array_unshift($X, $X0);

                        // Tampilkan nilai optimum
                        echo "Langkah 2: Nilai Optimum<br>";
                        echo "<table class='table' border='1'><tr><th>Optimum</th>";
                        foreach ($kriteria as $kriterium) {
                            echo "<th>{$kriterium['nama_kriteria']}</th>";
                        }
                        echo "</tr><tr><td>A0</td>";
                        foreach ($X0 as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr></table><br>";

                        // Langkah 3: Normalisasi Matriks Keputusan
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

                        // Tampilkan Matriks Keputusan Ternormalisasi
                        echo "Langkah 3: Matriks Keputusan Ternormalisasi<br>";
                        echo "<table class='table' border='1'><tr><th>Alternatif</th>";
                        foreach ($kriteria as $kriterium) {
                            echo "<th>{$kriterium['nama_kriteria']}</th>";
                        }
                        echo "</tr>";
                        foreach ($X_norm as $i => $row) {
                            echo "<tr><td>" . ($i == 0 ? "A0" : $names[$i - 1]) . "</td>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table><br>";

                        // Langkah 4: Matriks Keputusan Ternormalisasi Berbobot
                        $D = [];
                        foreach ($X_norm as $i => $row) {
                            foreach ($row as $j => $xij) {
                                $D[$i][$j] = $xij * $kriteria[$j]['bobot'];
                            }
                        }

                        // Tampilkan Matriks Keputusan Ternormalisasi Berbobot
                        echo "Langkah 4: Matriks Keputusan Ternormalisasi Berbobot<br>";
                        echo "<table class='table' border='1'><tr><th>Alternatif</th>";
                        foreach ($kriteria as $kriterium) {
                            echo "<th>{$kriterium['nama_kriteria']}</th>";
                        }
                        echo "</tr>";
                        foreach ($D as $i => $row) {
                            echo "<tr><td>" . ($i == 0 ? "A0" : $names[$i - 1]) . "</td>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table><br>";

                        // Langkah 5: Nilai dari fungsi optimalisasi,
                        $S = [];
                        foreach ($D as $i => $row) {
                            $S[$i] = array_sum($row);
                        }

                        // Tampilkan Nilai dari fungsi optimalisasi,
                        echo "Langkah 5: Nilai Fungsi Optimalisasi,<br>";
                        echo "<table class='table' border='1'><tr><th>Alternatif</th><th>Nilai Optimalisasi</th></tr>";
                        foreach ($S as $i => $value) {
                            echo "<tr><td>" . ($i == 0 ? "A0" : $names[$i - 1]) . "</td><td>$value</td></tr>";
                        }
                        echo "</table><br>";

                        // Langkah 6: Nilai Rangking
                        $R = [];
                        foreach ($S as $i => $value) {
                            if ($i == 0) continue; // Skip A0
                            $R[$i] = $value / $S[0];
                        }

                        // Tampilkan Nilai Rangking
                        echo "Langkah 6: Nilai Rangking<br>";
                        echo "<table class='table' border='1'><tr><th>Alternatif</th><th>Nilai Rangking</th></tr>";
                        foreach ($R as $i => $value) {
                            echo "<tr><td>{$names[$i - 1]}</td><td>$value</td></tr>";
                        }
                        echo "</table><br>";

                        // Urutkan berdasarkan Nilai Rangking tertinggi
                        arsort($R);

                        // Tampilkan Hasil Akhir
                        echo "Hasil Akhir Rekomendasi<br>";
                        echo "<table class='table' border='1'><tr><th>Ranking</th><th>Alternatif</th><th>Nilai Rangking</th></tr>";
                        $ranking = 1;
                        foreach ($R as $i => $value) {
                            echo "<tr><td>$ranking</td><td>{$names[$i - 1]}</td><td>$value</td></tr>";
                            $ranking++;
                        }
                        echo "</table><br>";
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    function toggleContent(id) {
        var content = document.getElementById(id);
        if (content.style.display === "none") {
            content.style.display = "table-row";
        } else {
            content.style.display = "none";
        }
    }
</script>