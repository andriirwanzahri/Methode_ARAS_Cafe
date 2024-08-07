<?php
require 'proses/koneksi.php';
require 'matriks_keputusan.php';
require 'header.php';

?>
<h1>Pilih Kriteria Cafe</h1>
<form action="proses_pemilihan.php" method="post">
    <?php
    require 'proses/koneksi.php';

    // Ambil data kriteria dan sub-kriteria dari database
    $query = "SELECT kriteria.kriteria_id, kriteria.nama_kriteria, sub_kriteria.id_sub_kriteria, sub_kriteria.nm_sub, sub_kriteria.nilai 
                  FROM kriteria 
                  JOIN sub_kriteria ON kriteria.kriteria_id = sub_kriteria.kriteria_id";
    $result = $conn->query($query);

    $kriteria = [];
    while ($row = $result->fetch_assoc()) {
        $kriteria[$row['kriteria_id']]['nama_kriteria'] = $row['nama_kriteria'];
        $kriteria[$row['kriteria_id']]['sub_kriteria'][] = $row;
    }

    // Tampilkan form pilihan kriteria
    foreach ($kriteria as $kriteria_id => $data) {
        echo "<h2>{$data['nama_kriteria']}</h2>";
        foreach ($data['sub_kriteria'] as $sub) {
            echo "<label>
                        <input type='radio' name='kriteria_{$kriteria_id}' value='{$sub['nilai']}' required>
                        {$sub['nm_sub']}
                      </label><br>";
        }
    }

    $conn->close();
    ?>
    <input type="submit" value="Dapatkan Rekomendasi">
</form>



<?php require 'footer.php'; ?>