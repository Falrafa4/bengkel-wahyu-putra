<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../assets/img/logo-wp-circle.png">
    <title>Dashboard - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main class="daftarPesanan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>
        
        <section class="utama">
            <div class="main-content">
                <h1>Daftar Pesanan</h1>
                <table>
                    <tr>
                        <th>No Pesanan</th>
                        <th style="width: 150px;">Waktu</th>
                        <th style="width: 150px;">Status</th>
                        <th>Nama Item</th>
                        <th style="width: 100px;">Jumlah</th>
                        <th>Material</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while($data = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $data['nomor_pesanan'] ?></td>
                        <td><?= $data['waktu_pemesanan'] ?></td>
                        <td><?= $data['status_pesanan'] ?></td>
                        <td><?= $data['nama_item'] ?></td>
                        <td><?= $data['jumlah_item'] ?></td>
                        <td><?= $data['material'] == NULL ? '-' : $data['material'] ?></td>
                        <td><?= $data['alamat_lengkap'] ?></td>
                        <td>
                            <a href="">Detail</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="detail-content">
                <h1>Detail Pesanan</h1>
            </div>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
</body>
</html>