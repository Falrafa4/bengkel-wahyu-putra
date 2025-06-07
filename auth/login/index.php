<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

    if(isset($_SESSION['data'])) {
        if($_SESSION['data']['role'] === 'User') {
            header('location: ../../dashboard/');
        } else {
            header('location: ../../dashboard/admin/');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
        
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

    <!-- Sweetalert2 -->
    <script src="../../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Login - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <?php
        $pesan = '';
        if(isset($_POST['masuk'])){
            $email = $_POST['email'];
            $password = $_POST['pass_user'];
            $storedPassword = getPassword($conn, $email);

            if (password_verify($password, $storedPassword)) {
                $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ? AND password = ?");
                $stmt->bind_param("ss", $email, $storedPassword);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
                $_SESSION['data'] = $data;

                if ($data) {
                    if ($data['role'] === 'Admin') {
                        echo '<script>
                        Swal.fire({
                            title: "Login Sukses!",
                            text: "Selamat datang, ' . $data['nama_pelanggan'] .'!",
                            icon: "success",
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href="../../dashboard/admin/";
                        });
                        </script>'; // Arahkan ke halaman admin
                    } else {
                        echo '<script>
                        Swal.fire({
                            title: "Login Sukses!",
                            text: "Selamat datang, ' . $data['nama_pelanggan'] .'!",
                            icon: "success",
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href="../../dashboard/";
                        });
                        </script>'; // Arahkan ke halaman user
                    }
                    exit();
                } else {
                    $pesan = 'Email/Password yang dimasukkan tidak sesuai.';
                }
            }
            // else if(md5($password) === $storedPassword) {
            //     $newHash = password_hash($password, PASSWORD_DEFAULT);
            //     updatePassword($conn, $email, $newHash);

            //     $storedPassword = getPassword($conn, $email);

            //     if (password_verify($password, $storedPassword)) {
            //         $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ? AND password = ?");
            //         $stmt->bind_param("ss", $email, $storedPassword);
            //         $stmt->execute();
            //         $result = $stmt->get_result();
            //         $data = $result->fetch_assoc();
            //         $_SESSION['data'] = $data;
    
            //         if ($data) {
            //             if ($data['role'] === 'Admin') {
            //                 echo '<script>alert("Selamat Datang, min! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/admin/";</script>'; // Arahkan ke halaman admin
            //             } else {
            //                 echo '<script>alert("Selamat Datang! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/";</script>'; // Arahkan ke halaman user
            //             }
            //             exit();
            //         } else {
            //             $pesan = 'Email/Password yang dimasukkan tidak sesuai.';
            //         }
            //     } else {
            //         $pesan = 'Email/Password yang dimasukkan tidak sesuai.';
            //     }
            // }
            else {
                $pesan = 'Email/Password yang dimasukkan tidak sesuai.';
            }
        }
    ?>
    <main>
        <form action="index.php" method="post">
            <h2>Selamat Datang!</h2>
            <p style="margin: 20px 0px 10px 0px">Masuk ke akun Anda untuk melanjutkan pemesanan.</p>
            <em><?= $pesan ?></em>

            <div class="input-box">
                <span><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off" autofocus><br>
            </div>
            <div class="input-box">
                <span><i class="fas fa-eye-slash" id="eye" onclick="openPass(this)"></i></span>
                <input type="password" name="pass_user" id="pass_user" placeholder="Password" required><br>
            </div>

            <a href="../forgot_password/" class="forgot-pass">Lupa Password?</a>
            <button type="submit" name="masuk">Masuk</button>
            <p style="font-size: 14px; text-align: center; margin: 20px 0px 0px 0px">Belum punya akun? <a href="../daftar/">Daftar di sini!</a></p>
        </form>
    </main>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>