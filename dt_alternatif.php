<?php
require 'proses/koneksi.php';

// Query untuk mengambil data dari tabel skor_alternatif
$ambilsemuadata = mysqli_query($conn, "SELECT * FROM alternatif");

if (isset($_POST['updateAlternatif'])) {
    $id_alternatif = $_POST['id_alternatif'];
    $id_cafe = $_POST['id_cafe'];
    $fasilitas = $_POST['fasilitas'];
    $menu_minuman = $_POST['menu_minuman'];
    $menu_makanan = $_POST['menu_makanan'];
    $suasana = $_POST['suasana'];
    $lokasi = $_POST['lokasi'];
    $harga_makanan = $_POST['harga_makanan'];
    $harga_minuman = $_POST['harga_minuman'];

    // Query untuk memperbarui data pada tabel skor_alternatif
    $query = "UPDATE alternatif SET cafe_id='$id_cafe', fasilitas='$fasilitas', menu_minuman='$menu_minuman', menu_makanan='$menu_makanan', suasana='$suasana', lokasi='$lokasi', harga_makanan='$harga_makanan', harga_minuman='$harga_minuman' WHERE id_alternatif='$id_alternatif'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                alert('Data alternatif berhasil diperbarui');
                window.location.href = 'index.php?page=data_alternatif';
            </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data');
                window.location.href = 'index.php?page=data_alternatif';
            </script>";
    }
}

?>
<h1 class="mt-4">Data Alternatif</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Alternatif</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah Alternatif</button> -->
        <a href="proses/exdater.php" target="_blank" class="btn btn-info">Export Data</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <th>Inisial_Cafe</th>
                <th>C1 (Fasilitas)</th>
                <th>C2 (Menu Minuman)</th>
                <th>C3 (Menu Makanan)</th>
                <th>C4 (Suasana)</th>
                <th>C5 (Lokasi)</th>
                <th>C6 (Harga Makanan)</th>
                <th>C7 (Harga Minuman)</th>
                <th>Aksi </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Inisial_Cafe</th>
                    <th>C1 (Fasilitas)</th>
                    <th>C2 (Menu Minuman)</th>
                    <th>C3 (Menu Makanan)</th>
                    <th>C4 (Suasana)</th>
                    <th>C5 (Lokasi)</th>
                    <th>C6 (Harga Makanan)</th>
                    <th>C7 (Harga Minuman)</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM alternatif sa JOIN cafes c ON c.id_cafe = sa.cafe_id");
                while ($data = mysqli_fetch_array($ambilsemuadata)) {
                    $id_alternatif = $data['id_alternatif'];
                    $id_cafe = $data['id_cafe'];
                    $nm_cafe = $data['nm_cafe'];
                    $inisial_cafe = $data['inisial_cafe'];
                    $fasilitas = $data['fasilitas'];
                    $menu_minuman = $data['menu_minuman'];
                    $menu_makanan = $data['menu_makanan'];
                    $suasana = $data['suasana'];
                    $lokasi = $data['lokasi'];
                    $harga_makanan = $data['harga_makanan'];
                    $harga_minuman = $data['harga_minuman'];
                ?>
                    <tr>
                        <td><?= $inisial_cafe; ?></td>
                        <td><?= $fasilitas; ?></td>
                        <td><?= $menu_minuman; ?></td>
                        <td><?= $menu_makanan; ?></td>
                        <td><?= $suasana; ?></td>
                        <td><?= $lokasi; ?></td>
                        <td><?= $harga_makanan; ?></td>
                        <td><?= $harga_minuman; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $id_alternatif; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <!-- Modal Edit Data Alternatif -->
                            <div class="modal fade" id="ModalEdit<?= $id_alternatif; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                Alternatif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_alternatif" value="<?= $id_alternatif; ?>">
                                                <input type="hidden" name="id_cafe" value="<?= $id_cafe; ?>">
                                                <div class="mb-3">
                                                    <label for="nm_cafe" class="col-form-label">Nama
                                                        Cafe</label>
                                                    <input name="nm_cafe" type="text" class="form-control" value="<?= $nm_cafe; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fasilitas" class="col-form-label">Fasilitas</label>
                                                    <input name="fasilitas" type="number" class="form-control" value="<?= $fasilitas; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="menu_minuman" class="col-form-label">Menu Minuman</label>
                                                    <input name="menu_minuman" type="number" class="form-control" value="<?= $menu_minuman; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="menu_makanan" class="col-form-label">Menu Makanan</label>
                                                    <input name="menu_makanan" type="number" class="form-control" value="<?= $menu_makanan; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="suasana" class="col-form-label">Suasana</label>
                                                    <input name="suasana" type="number" class="form-control" value="<?= $suasana; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi" class="col-form-label">Lokasi</label>
                                                    <input name="lokasi" type="number" class="form-control" value="<?= $lokasi; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_makanan" class="col-form-label">Harga Makanan</label>
                                                    <input name="harga_makanan" type="number" class="form-control" value="<?= $harga_makanan; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_minuman" class="col-form-label">Harga Minuman</label>
                                                    <input name="harga_minuman" type="number" class="form-control" value="<?= $harga_minuman; ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name="updateAlternatif">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $id_alternatif; ?>"><i class="fa-solid fa-trash"></i></button>
                            <!-- Modal Hapus Data Alternatif -->
                            <div class="modal fade" id="ModalHapus<?= $id_alternatif; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                Alternatif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="proses/hapus_alternatif.php">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_perhitungan" value="<?= $id_perhitungan; ?>"> Apakah Anda yakin
                                                ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="hapusAlternatif">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; SR Cafe 2024</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
<!-- Modal Tambah Data Alternatif -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="proses/tambah_alternatif.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cafe_id" class="col-form-label">Nama Cafe</label>
                        <input name="cafe_id" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fasilitas" class="col-form-label">Fasilitas</label>
                        <input name="fasilitas" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="menu_minuman" class="col-form-label">Menu Minuman</label>
                        <input name="menu_minuman" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="menu_makanan" class="col-form-label">Menu Makanan</label>
                        <input name="menu_makanan" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="suasana" class="col-form-label">Suasana</label>
                        <input name="suasana" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="col-form-label">Lokasi</label>
                        <input name="lokasi" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_makanan" class="col-form-label">Harga Makanan</label>
                        <input name="harga_makanan" type="number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_minuman" class="col-form-label">Harga Minuman</label>
                        <input name="harga_minuman" type="number" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="tambahAlternatif">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>