<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pemilihan Kriteria Cafe - SR CAFE</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .toggle-content {
            display: none;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">SISTEM REKOM CAFE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="auth/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                        </a>
                        <a class="nav-link" href="index.php?page=data_kriteria">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Data Kriteria
                        </a>
                        <a class="nav-link" href="index.php?page=data_sub_kriteria">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Data Sub Kriteria
                        </a>
                        <a class="nav-link" href="index.php?page=data_cafe">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Data Cafe
                        </a>
                        <a class="nav-link" href="index.php?page=data_alternatif">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Data Alternatif
                        </a>
                        <a class="nav-link" href="index.php?page=perhitungan_spk_aras">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Perhitungan ARAS
                        </a>
                        <!-- <a class="nav-link" href="memilih.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Pemilihan Kriteria Cafe
                        </a> -->
                        <a class="nav-link" href="index.php?page=data_pengguna">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Data Pengguna
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">