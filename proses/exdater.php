<?php
require 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kriteria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h2>Data Kriteria</h2>
        <div class="data-tables datatable-dark">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id Alternatif</th>
                        <th>Nama Cafe</th>
                        <th>Fasilitas</th>
                        <th>Menu Minuman</th>
                        <th>Menu Makanan</th>
                        <th>Suasana</th>
                        <th>Lokasi</th>
                        <th>Harga Makanan</th>
                        <th>Harga Minuman</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM alternatif sa JOIN cafes c ON c.id_cafe = sa.cafe_id");
                    while ($data = mysqli_fetch_array($ambilsemuadata)) {
                        $nm_cafe = $data['nm_cafe'];
                        $fasilitas = $data['fasilitas'];
                        $menu_minuman = $data['menu_minuman'];
                        $menu_makanan = $data['menu_makanan'];
                        $suasana = $data['suasana'];
                        $lokasi = $data['lokasi'];
                        $harga_makanan = $data['harga_makanan'];
                        $harga_minuman = $data['harga_minuman'];
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $nm_cafe; ?></td>
                            <td><?= $fasilitas; ?></td>
                            <td><?= $menu_minuman; ?></td>
                            <td><?= $menu_makanan; ?></td>
                            <td><?= $suasana; ?></td>
                            <td><?= $lokasi; ?></td>
                            <td><?= $harga_makanan; ?></td>
                            <td><?= $harga_minuman; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
    </script>
</body>

</html>