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
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.css">

    <title>Daftar Pesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main class="daftarPesanan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>
        
        <section class="utama">
            <div class="main-content">
                <h1>Daftar Pesanan</h1><hr class="hr-standar" style="width: 10dvw">
                <p>Berisi daftar pesanan yang telah Anda buat sebelumnya.</p>
                <table>
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th style="width: 150px;">Waktu</th>
                            <th style="width: 150px;">Status</th>
                            <th style="width: 135px;">Nama Item</th>
                            <th style="width: 110px;">Jumlah</th>
                            <th style="width: 110px;">Material</th>
                            <th>Alamat</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($_SESSION['pesanan'] as $data) { ?>
                    <tr>
                        <td><?= $data['nomor_pesanan'] ?></td>
                        <td><?= $data['waktu_pemesanan'] ?></td>
                        <td><?= $data['status_pesanan'] ?></td>
                        <td><?= $data['nama_item'] ?></td>
                        <td><?= $data['jumlah_item'] ?></td>
                        <td><?= $data['material'] == NULL ? '-' : $data['material'] ?></td>
                        <td><?= $data['alamat_lengkap'] ?></td>
                        <td>
                            <a href="detail/?detail=<?= $data['no_pesanan'] ?>">
                                Detail
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } 
                    if($_SESSION['pesanan'] == []) {
                    ?>               
                    <tr>
                        <td colspan="8" style="font-style:italic; color:#adadad; font-size:14px;">Anda Belum Membuat Pesanan</td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!-- <iframe src="../../../uploads/desain/test.pdf" width="600" height="400"></iframe> -->
            </div>
        </section>
    </main>
</body>
</html>