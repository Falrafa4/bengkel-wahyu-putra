<?php 
    //inisialisasi session
    session_start();

    //mengecek apakah ada session user yang aktif, jika tidak maka diarahkan ke login.php
    if(!isset($_SESSION['data']['role']) || $_SESSION['data']['role'] !== 'User'){
        header("location: ../../auth/login/"); // arahkan ke login.php
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    <title>Dashboard - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php include "../../includes/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main>
        <aside>
            <h1>Bengkel Wahyu Putra</h1>
            <div class="nav-dash">
                <a href=""><i class="fas fa-house active"></i>Dashboard</a>
                <a href=""><i class="fas fa-bag-shopping"></i>Buat Pesanan</a>
                <a href=""><i class="fas fa-list"></i>Daftar Pesanan</a>
                <a href=""><i class="fas fa-bell"></i>Notifikasi</a>
                <a href=""><i class="fas fa-comment"></i>Bantuan</a>
                <a href=""><i class="fas fa-pen-to-square"></i>Profil</a>
                <a href="../../auth/logout.php"><i class="fas fa-right-from-bracket"></i>Logout</a>
            </div>
        </aside>
        <section class="utama">
            <h1>Selamat Datang Di Dashboard!</h1>
            <table>
                <tr>
                    <td><h1>Profil Anda</h1></td>
                </tr>
                <tr>
                    <td class="info">Nama Lengkap</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['nama_pelanggan']?></td>
                </tr>
                <tr>
                    <td class="info">Email</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['email']?></td>
                </tr>
                <tr>
                    <td class="info">No. Telepon</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['no_telp']?></td>
                </tr>
                <tr>
                    <td class="info">Jenis Akun</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['jenis_akun']?></td>
                </tr>
                <tr>
                    <td class="button"><a href=""><i class="fas fa-pen-to-square"></i> Edit Profil</a></td>
                </tr>
            </table>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
</body>
</html>