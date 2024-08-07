<?php
session_start();
require '../proses/koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi data, pastikan tidak ada field yang kosong
    if (empty($nama) || empty($email) || empty($username) || empty($password)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.location.href = 'register.php';
            </script>";
        exit;
    }

    // Enkripsi password (disarankan untuk menggunakan metode yang lebih aman, seperti bcrypt)
    $encrypted_password = md5($password);

    // Check apakah username atau email sudah ada di database
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Username or email already exists.');
                window.location.href = 'register.php';
            </script>";
        exit;
    }

    // Query untuk insert data ke database
    $query = "INSERT INTO users (nama, email, username, password, role) 
            VALUES ('$nama', '$email', '$username', '$encrypted_password', 'masyarakat')";

    $result = mysqli_query($conn, $query);

    if ($result) {

        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $nama;

        header('Location: ../user_index.php');
        exit;
    } else {
        echo "<script>
                alert('Failed to register. Please try again later.');
                window.location.href = 'register.php';
            </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register - SB Admin</title>
    <link href="../css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputNama" name="nama" type="text" placeholder="Enter your full name" required>
                                            <label for="inputNama">Full name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" required>
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Enter your username" required>
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" required>
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <button class="btn btn-primary btn-block" type="submit" name="register">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
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
</body>

</html>