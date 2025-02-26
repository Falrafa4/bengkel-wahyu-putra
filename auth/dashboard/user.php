<?php 
    //inisialisasi session
    session_start();

    //mengecek apakah ada session user yang aktif, jika tidak maka diarahkan ke login.php
    if(!isset($_SESSION['data']['role']) || $_SESSION['data']['role'] !== 'User'){
        header("location: ../login/"); // arahkan ke login.php
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
        <h1>Halaman Dashboard</h1>
        <div class="nav-dash">
            <a href="../../">Home</a> |
            <a href="../logout.php">Logout</a> | 
            <a href="../hapus_akun.php" onclick="return confirm('Apakah Anda yakin untuk menghapus akun ini?')">Hapus Akun</a>
        </div>
        <hr>
        <h3>Selamat Datang, <?php echo $_SESSION['data']['nama_pelanggan']; ?>!</h3>
        <p style="font-style: italic;">Halaman ini akan muncul setelah user login.</p>

    </main>

    <!-- FOOTER -->
    <?php include "../../includes/footer.php"; ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
</body>
</html>