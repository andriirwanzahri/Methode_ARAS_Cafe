<?php
require 'proses/koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM kriteria");
?>

<h1 class="mt-4">Data Kriteria</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Kriteria</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah Kriteria</button>
        <a href="proses/exkrit.php" target="_blank" class="btn btn-info">Export Data</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot Kriteria</th>
                    <th>Jenis Kriteria</th>
                    <th>Inisial Kriteria</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot Kriteria</th>
                    <th>Jenis Kriteria</th>
                    <th>Inisial Kriteria</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $no = 1;
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM kriteria");
                while ($data = mysqli_fetch_array($ambilsemuadata)) {
                    $kriteria_id = $data['kriteria_id'];
                    $nama_kriteria = $data['nama_kriteria'];
                    $bobot = $data['bobot'];
                    $jenis_bobot = $data['jenis_bobot'];
                    $smbl_kriteria = $data['smbl_kriteria'];


                ?>
                    <tr>

                        <td><?= $no++; ?></td>
                        <td><?= $nama_kriteria; ?></td>
                        <td><?= $bobot; ?></td>
                        <td><?= $jenis_bobot; ?></td>
                        <td><?= $smbl_kriteria; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $kriteria_id; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $kriteria_id; ?>"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="ModalEdit<?= $kriteria_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kriteria
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="proses/edit_kriteria.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="kriteria_id" value="<?= $kriteria_id; ?>">
                                        <div class="mb-3">
                                            <label for="nama_kriteria" class="col-form-label">Nama
                                                Kriteria</label>
                                            <input name="nama_kriteria" type="text" class="form-control" value="<?= $nama_kriteria; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bobot" class="col-form-label">Bobot
                                                Kriteria</label>
                                            <input name="bobot" type="number" step="0.01" class="form-control" value="<?= $bobot; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_bobot" class="col-form-label">Jenis
                                                Kriteria</label>
                                            <select name="jenis_bobot" class="form-control" required>
                                                <option value="Benefit" <?= $jenis_bobot == 'Benefit' ? 'selected' : ''; ?>>Benefit</option>
                                                <option value="Cost" <?= $jenis_bobot == 'Cost' ? 'selected' : ''; ?>>Cost</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="smbl_kriteria" class="col-form-label">Inisial
                                                Kriteria</label>
                                            <input name="smbl_kriteria" type="text" class="form-control" value="<?= $smbl_kriteria; ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hapus -->
                    <div class="modal fade" id="ModalHapus<?= $kriteria_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus data Kriteria
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="proses/hapus_kriteria.php">
                                    <input type="hidden" name="kriteria_id" value="<?= $kriteria_id; ?>">
                                    <div class="modal-body">Apakah Anda yakin menghapus kriteria
                                        <?= $nama_kriteria; ?>?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
<!-- Modal Tambah -->
<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="proses/tambah_kriteria.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kriteria" class="col-form-label">Nama Kriteria</label>
                        <input name="nama_kriteria" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="col-form-label">Bobot Kriteria</label>
                        <input name="bobot" type="number" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_bobot" class="col-form-label">Jenis Kriteria</label>
                        <select name="jenis_bobot" class="form-control" required>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="smbl_kriteria" class="col-form-label">Inisial Kriteria</label>
                        <input name="smbl_kriteria" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>