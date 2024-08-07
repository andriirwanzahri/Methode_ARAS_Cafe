<?php
require 'proses/koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM sub_kriteria");
?>
<h1 class="mt-4">Data Sub Kriteria</h1>
<ol class="breadcrumb mb=4">
    <li class="breadcrumb-item active">Sub Kriteria</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah Sub Kriteria</button>
        <a href="proses/exsubkrit.php" target="_blank" class="btn btn-info">Export Data</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id Sub Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Sub Kriteria</th>
                    <th>Bobot</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id Sub Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Sub Kriteria</th>
                    <th>Bobot</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM sub_kriteria s, kriteria k WHERE k.kriteria_id = s.kriteria_id");
                while ($data = mysqli_fetch_array($ambilsemuadata)) {
                    $id_sub_kriteria = $data['id_sub_kriteria'];
                    $nama_kriteria = $data['nama_kriteria'];
                    $nm_sub = $data['nm_sub'];
                    $nilai = $data['nilai'];
                    $keterangan = $data['keterangan'];
                ?>
                    <tr>
                        <td><?= $id_sub_kriteria; ?></td>
                        <td><?= $nama_kriteria; ?></td>
                        <td><?= $nm_sub; ?></td>
                        <td><?= $nilai; ?></td>
                        <td><?= $keterangan; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $id_sub_kriteria; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <!-- Modal edit data sub kriteria -->
                            <div class="modal fade" id="ModalEdit<?= $id_sub_kriteria; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Sub
                                                Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="proses/edit_sub_kriteria.php">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_sub_kriteria" value="<?= $id_sub_kriteria; ?>">
                                                <div class="mb-3">
                                                    <label for="kriteria_id" class="col-form-label">Nama
                                                        Kriteria</label>
                                                    <select class="form-select" name="kriteria_id">
                                                        <?php
                                                        $result = mysqli_query($conn, "SELECT * FROM kriteria");
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row['kriteria_id'] . '" ' . ($row['kriteria_id'] == $data['kriteria_id'] ? 'selected' : '') . '>' . $row['nama_kriteria'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nm_sub" class="col-form-label">Sub
                                                        Kriteria</label>
                                                    <input name="nm_sub" type="text" class="form-control" value="<?= $nm_sub; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bobot" class="col-form-label">Bobot</label>
                                                    <input name="bobot" type="text" class="form-control" value="<?= $nilai; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="col-form-label">Keterangan</label>
                                                    <input name="keterangan" type="text" class="form-control" value="<?= $keterangan; ?>" required>
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
                            <!-- Akhir Modal edit data sub kriteria -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $id_sub_kriteria; ?>"><i class="fa-solid fa-trash"></i></button>
                            <!-- Modal hapus data sub kriteria -->
                            <div class="modal fade" id="ModalHapus<?= $id_sub_kriteria; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalHapus">Hapus data Sub
                                                Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="proses/hapus_sub_kriteria.php">
                                            <input type="hidden" name="id_sub_kriteria" value="<?= $id_sub_kriteria; ?>">
                                            <div class="modal-body"> Apakah Anda yakin ingin menghapus
                                                Sub Kriteria <?= $nm_sub; ?>? </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal hapus data sub kriteria -->
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
<!-- Modal tambah sub kriteria -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="proses/tambah_sub_kriteria.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kriteria_id" class="col-form-label">Kriteria</label>
                        <select class="form-select" name="kriteria_id">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM kriteria");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['kriteria_id'] . '">' . $row['nama_kriteria'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nm_sub" class="col-form-label">Sub Kriteria</label>
                        <input type="text" class="form-control" id="nm_sub" name="nm_sub" required>
                    </div>
                    <div class="mb-3">
                        <label for="bobot" class="col-form-label">Bobot</label>
                        <input type="number" class="form-control" id="bobot" name="bobot" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
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
<!-- Akhir Modal tambah sub kriteria -->
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

</html>