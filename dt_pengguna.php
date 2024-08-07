<?php
require 'proses/koneksi.php';

if (!isset($_SESSION['log'])) {
    header('Location: auth/login.php');
    exit();
}

$sql = mysqli_query($conn, "SELECT * FROM users");
?>
<h1 class="mt-4">Data Pengguna</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Pengguna</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i> DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $ambilsemuadatausers = mysqli_query($conn, "SELECT * FROM users");
                while ($data = mysqli_fetch_array($ambilsemuadatausers)) {
                    $iduser = $data['iduser'];
                    $nama = $data['nama'];
                    $username = $data['username'];
                    $email = $data['email'];
                    $role = $data['role'];
                ?>
                    <tr>
                        <td><?= $iduser; ?></td>
                        <td><?= $nama; ?></td>
                        <td><?= $username; ?></td>
                        <td><?= $email; ?></td>
                        <td><?= $role; ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $iduser; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <!-- Modal edit data users -->
                                <div class="modal fade" id="ModalEdit<?= $iduser; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data
                                                    Users</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="proses/edit_users.php">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Id User</label>
                                                        <input type="number" class="form-control" value="<?= $iduser; ?>" disabled>
                                                        <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Nama</label>
                                                        <input name="nama" type="text" class="form-control" value="<?= $nama; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Username</label>
                                                        <input name="username" type="text" class="form-control" value="<?= $username; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Email</label>
                                                        <input name="email" type="email" class="form-control" value="<?= $email; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Role</label>
                                                        <select name="role" class="form-control">
                                                            <option value="admin" <?= $role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                            <option value="masyarakat" <?= $role == 'masyarakat' ? 'selected' : ''; ?>>Masyarakat</option>
                                                        </select>
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
                                <!-- Akhir Modal edit data users -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $iduser; ?>">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <!-- Modal hapus data users -->
                                <div class="modal fade" id="ModalHapus<?= $iduser; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalHapus">Hapus Data User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="proses/hapus_users.php">
                                                <input type="hidden" name="iduser" value="<?= $iduser; ?>">
                                                <div class="modal-body"> Apakah Anda Yakin menghapus
                                                    User <?= $nama; ?>? </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal hapus data users -->
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <!-- Modal tambah Admin -->
            <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="proses/tambah_admin.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input name="nama" type="text" class="form-control" placeholder="Nama Admin" required>
                                </div>
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <input name="jk" type="text" class="form-control" placeholder="Jenis Kelamin" required>
                                </div>
                                <div class="mb-3">
                                    <input name="nohp" type="number" class="form-control" placeholder="No Hp" required>
                                </div>
                                <div class="mb-3">
                                    <input name="jabatan" type="text" class="form-control" placeholder="Jabatan" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="addadmin">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal tambah Admin -->
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
</body>

</html>