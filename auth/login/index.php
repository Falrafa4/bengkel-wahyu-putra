<?php 
    session_start();
    include('../../config/koneksi.php');
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
    <?php include "../../includes/nav.php"; ?>
    <!-- NAVBAR END -->

    <?php
        $pesan = '';
        if(isset($_POST['masuk'])){ //jika ada aksi method POST dengan name=masuk
            $email = $_POST['email']; //simpan email
            $password = md5($_POST['pass_user']); //simpan password

            // Gunakan Prepared Statement
            $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = mysqli_fetch_assoc($result);

            if ($data && $password === $data['password']) {
                $_SESSION['data'] = $data;
        
                // Redirect berdasarkan role
                if ($data['role'] === 'Admin') {
                    echo '<script>alert("Selamat Datang, min! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/admin/admin.php";</script>'; // Arahkan ke halaman admin
                } else {
                    echo '<script>alert("Selamat Datang! '.$data['nama_pelanggan'].'"); location.href="../../dashboard/pages/dashboard.php";</script>'; // Arahkan ke halaman user
                }
                exit(); // Hentikan eksekusi setelah redirect
            }
            else {
                $pesan = 'Email/Password yang dimasukkan tidak sesuai.';
            }
        }
    ?>
    <main>
        <form action="index.php" method="post">
            <h2>Selamat Datang!</h2>
            <p style="margin: 20px 0px 10px 0px">Masuk ke akun Bengkel Wahyu Putra Anda.</p>
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