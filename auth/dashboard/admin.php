<?php 
    //inisialisasi session
    session_start();
    include "../../config/koneksi.php";

    //mengecek apakah ada session admin yang aktif, jika tidak maka diarahkan ke login.php
    if(!isset($_SESSION['data']['role']) || $_SESSION['data']['role'] !== 'Admin'){
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
        <h1>Halaman Admin</h1>
        <div class="nav-dash">
            <a href="../../">Home</a> |
            <a href="../logout.php">Logout</a> | 
            <a href="#" onclick="return alert('Can\'t delete this account (Administrator Account). Please contact your developer')">Hapus Akun</a>
        </div>
        <hr>
        <h3>Selamat Datang, <?php echo $_SESSION['data']['nama_pelanggan']; ?>!</h3>
        <p style="font-style: italic;">Halaman ini adalah halaman khusus para admin. Jika anda bukan admin, selamat Anda dapat membobol sistem kami :)</p>

    </main>
    <section class="daftar-user">
        <h1>Data Pelanggan</h1><hr>
        <a href="kelola.php" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>

        <?php if(isset($_SESSION['eksekusi'])) {?>
        <div class="success-update">
            <em><?= $_SESSION['eksekusi'] ?></em>
            <i class="fas fa-close" onclick="closeAlert()"></i>
        </div>
        <?php unset($_SESSION['eksekusi']); }
        ?>

        <?php 
            $querySelect = "SELECT * FROM pelanggan;";
            $sql = mysqli_query($conn, $querySelect);
        ?>

        <div class="container-card">
            <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
            <div class="card">
                <h2><?= $result['nama_pelanggan']; ?></h2>
                <h3>@<?= $result['username']; ?></h3>
                <p><i class="fas fa-phone"></i> <?= $result['no_telp']; ?></p>
                <p><i class="fas fa-person"></i> <?= $result['jenis_kelamin']; ?></p>
                <p><i class="fas fa-calendar-days"></i> <?= $result['tgl_lahir']; ?></p>
                <em class="role <?= $result['role']; ?>"><?= $result['role']; ?></em>
                <em class="type <?= $result['jenis_akun']; ?>"><?= $result['jenis_akun']; ?></em>

                <div class="action-btn">
                    <a href="kelola.php?ubah=<?= $result['id_pelanggan']; ?>" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                    <a href="../proses.php?hapus=<?= $result['id_pelanggan']; ?>" class="btn hapus"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include "../../includes/footer.php"; ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>