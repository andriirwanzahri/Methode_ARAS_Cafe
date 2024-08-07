<?php
require 'proses/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kriteria Cafe</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin: 20px auto;
            max-width: 800px;
        }

        .criteria-table th,
        .criteria-table td {
            vertical-align: middle;
        }

        .criteria-table td {
            padding: 10px;
        }

        .criteria-row {
            border: 2px solid #007bff;
            /* Blue border for visibility */
            border-radius: 5px;
            background-color: #f8f9fa;
            /* Light background color */
            margin-bottom: 15px;
            /* Space between criteria rows */
        }

        .criteria-row th {
            background-color: #3cb371;
            /* Blue background for header */
            color: white;
            text-align: center;
        }

        .criteria-row td {
            padding: 15px;
        }

        .criteria-row label {
            display: block;
            margin-bottom: 5px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container form-container p-5">
        <h1 class="text-center">Pilih Kriteria Cafe</h1>
        <form class="my-5 mx-auto " action="user_index.php?page=hasil_rekomendasi" method="post">
            <?php
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
                echo "<div class='criteria-row'>";
                echo "<table class='table table-striped table-bordered mb-0'>";
                echo "<thead><tr><th colspan='2'>{$data['nama_kriteria']}</th></tr></thead>";
                echo "<tbody>";

                foreach ($data['sub_kriteria'] as $sub) {
                    echo "<tr>
                            <td>
                                <label>
                                    <input type='radio' name='kriteria_{$kriteria_id}' value='{$sub['nilai']}' required>
                                    {$sub['nm_sub']}
                                </label>
                            </td>
                          </tr>";
                }

                echo "</tbody></table></div>";
            }

            $conn->close();
            ?>
            <button class="btn btn-info btn-submit" type="submit">Dapatkan Rekomendasi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>