<?php
require 'proses/koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM cafes");
?>

<h1 class="mt-4">Data Cafe</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Cafe</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambah">Tambah Cafe</button>
        <a href="proses/excafe.php" target="_blank" class="btn btn-info">Export Data</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cafe</th>
                    <th>Inisial Cafe</th>
                    <th>Alamat</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Cafe</th>
                    <th>Inisial Cafe</th>
                    <th>Alamat</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($sql)) {
                    $id_cafe = $data['id_cafe'];
                    $nm_cafe = $data['nm_cafe'];
                    $inisial_cafe = $data['inisial_cafe'];
                    $inisial_cafe = $data['inisial_cafe'];
                    $alamat = $data['alamat'];
                    $deskripsi = $data['deskripsi'];
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nm_cafe; ?></td>
                        <td><?= $inisial_cafe; ?></td>
                        <td><?= $alamat; ?></td>
                        <td><?= $deskripsi; ?></td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $id_cafe; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <!-- Modal edit data cafe -->
                            <div class="modal fade" id="ModalEdit<?= $id_cafe; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                Cafe</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="proses/edit_cafe.php">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_cafe" value="<?= $id_cafe; ?>">
                                                <div class="mb-3">
                                                    <label for="nm_cafe" class="col-form-label">Nama
                                                        Cafe</label>
                                                    <input name="nm_cafe" type="text" class="form-control" value="<?= $nm_cafe; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="inisial" class="col-form-label">inisial</label>
                                                    <input name="inisial" type="text" class="form-control" value="<?= $inisial_cafe; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="col-form-label">Alamat</label>
                                                    <input name="alamat" type="text" class="form-control" value="<?= $alamat; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                                    <input type="text" name="deskripsi" class="form-control" value="<?= $deskripsi; ?>" required">
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
                            <!-- Akhir Modal edit data cafe -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $id_cafe; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <!-- Modal hapus data cafe -->
                            <div class="modal fade" id="ModalHapus<?= $id_cafe; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus data
                                                Cafe</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="proses/hapus_cafe.php">
                                            <input type="hidden" name="id_cafe" value="<?= $id_cafe; ?>">
                                            <div class="modal-body"> Apakah Anda Yakin menghapus Cafe
                                                <?= $nm_cafe; ?>? </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal hapus data cafe -->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<!-- Modal Tambah Cafe -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Cafe Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="proses/tambah_cafe.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nm_cafe" class="col-form-label">Nama Cafe</label>
                        <input name="nm_cafe" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="inisial" class="col-form-label">Inisial Cafe</label>
                        <input name="inisial" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <input name="alamat" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
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
<!-- Akhir Modal Tambah Cafe -->
</body>

</html>