<?php 
    //inisialisasi session
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

    <title>Admin - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="utama admin">
            <section class="welcome">
                <h1>Dashboard Admin</h1>
                <hr>
                <h3>Selamat Datang, <?php echo $_SESSION['data']['nama_pelanggan']; ?>!</h3>
                <p style="font-style: italic;">Halaman ini diperuntukkan khusus bagi administrator. Jika Anda bukan administrator, akses Anda tidak diizinkan.</p><br>
            </section>
            <section class="informasi">
                <?php 
                $admin = $conn->query("SELECT COUNT(id_pelanggan) As jml_admin FROM pelanggan WHERE role = 'Admin'");
                $admin = $admin->fetch_assoc();

                $user = $conn->query("SELECT COUNT(id_pelanggan) As jml_pelanggan FROM pelanggan WHERE role = 'User'");
                $user = $user->fetch_assoc();

                $pesanan = $conn->query("SELECT COUNT(no_pesanan) As jml_pesanan FROM pemesanan");
                $pesanan = $pesanan->fetch_assoc();
                ?>
                <table>
                    <tr>
                        <td><h1>Informasi</h1></td>
                    </tr>
                    <tr>
                        <td class="info">Nama Admin</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['nama_pelanggan']?></td>
                    </tr>
                    <tr>
                        <td class="info">Jumlah Admin</td>
                        <td>:</td>
                        <td class="data"><?= $admin['jml_admin']?></td>
                    </tr>
                    <tr>
                        <td class="info">Jumlah Pelanggan</td>
                        <td>:</td>
                        <td class="data"><?= $user['jml_pelanggan']?></td>
                    </tr>
                    <tr>
                        <td class="info">Banyak Pesanan</td>
                        <td>:</td>
                        <td class="data"><?= $pesanan['jml_pesanan']?></td>
                    </tr>
                </table>
            </section>
            <section class="notif">
                <h1>Notifikasi</h1><hr>
                <?php 
                $notif = $conn->query('SELECT * FROM pemesanan p JOIN pelanggan pl ON pl.id_pelanggan = p.id_pelanggan WHERE p.status_pesanan = 1 OR p.status_pesanan = 3 ORDER BY p.waktu_pemesanan DESC');

                while($row = $notif->fetch_assoc()) :
                
                    if($row['status_pesanan'] == 'Menunggu Penawaran') {
                ?>
                <p class="notif-text">  [<?= $row['waktu_pemesanan'] ?>] - Pesanan <strong><?= $row['no_pesanan'] ?></strong> Menunggu Surat Penawaran</p>
                <?php 
                    } else { ?>
                <p class="notif-text" style="background-color: #70abff;">  [<?= $row['waktu_pemesanan'] ?>] - Pesanan <strong><?= $row['no_pesanan'] ?></strong> Negosiasi</p>
                <?php    }
                endwhile; 
                ?>
            </section>
        </div>
    </main>
    
    <script src="../../assets/js/script.js"></script>
</body>
</html>