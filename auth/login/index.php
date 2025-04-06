<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
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
                        echo '<script>alert("Selamat Datang, min! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/admin/";</script>'; // Arahkan ke halaman admin
                    } else {
                        echo '<script>alert("Selamat Datang! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/";</script>'; // Arahkan ke halaman user
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
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off"><br>
            </div>
            <div class="input-box">
                <span><i class="fas fa-eye-slash" id="eye" onclick="openPass()"></i></span>
                <input type="password" name="pass_user" id="pass_user" placeholder="Password" required><br>
            </div>

            <a href="../daftar/" class="forgot-pass">Lupa Password?</a>
            <button type="submit" name="masuk">Masuk</button>
            <p style="font-size: 14px; text-align: center; margin: 20px 0px 0px 0px">Belum punya akun? <a href="../daftar/">Daftar di sini!</a></p>
        </form>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>