<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Recomendasi Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3" href="user_index.php">SISTEM REKOMENDASI CAFE</a>
                <!-- Sidebar Toggle-->
                <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
                <!-- Navbar-->
                <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                    <li class="nav-item">
                        <h4 class="text-white"><?= $_SESSION['nama']; ?></h4>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <main>
                <div class="container">
                    <div class="container-fluid px-4">
                        <?php
                        if (isset($_GET['page'])) {
                            if ($_GET['page'] == "pilihkriteria") {
                                include 'pilihkriteria.php';
                            } else if ($_GET['page'] == "hasil_rekomendasi") {
                                include 'proses_pemilihan.php';
                            } elseif ($_GET['page'] == "logout") {

                                $_SESSION = [];
                                session_unset();
                                session_destroy();
                                echo "<script>location='auth/login.php';</script>";
                            }
                        } else {
                            include 'halamanUtamaUser.php';
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>