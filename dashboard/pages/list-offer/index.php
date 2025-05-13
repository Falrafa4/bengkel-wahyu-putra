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

    <main class="daftarPesanan offer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <div class="main-content">
                <h1>Surat Penawaran</h1><hr class="hr-standar" style="width: 10dvw;">
                <p>Berisi surat penawaran dari Bengkel Wahyu Putra</p>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 200px;">No Pesanan</th>
                            <th style="width: 250px;">Status Pesanan</th>
                            <th>Tanggal Terbit</th>
                            <th>Surat Penawaran</th>
                            <th style="width: 250px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($_SESSION['notif'] as $notif) : ?>
                        <tr>
                            <td><?= $notif['nomor_pesanan'] ?></td>
                            <td><?= $notif['status_pesanan'] ?></td>
                            <td><?= $notif['tgl_penawaran'] ?></td>
                            <td><button onclick="download('../../../uploads/penawaran/<?= $notif['surat_penawaran'] ?>')"><i class="fas fa-download"></i> Unduh Surat</button></td>
                            <td>
                                <button class="agree"><i class="fas fa-check"></i> Setuju</button>
                                <button class="reject"><i class="fas fa-xmark"></i> Tolak</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if($_SESSION['notif'] == []): ?>
                        <tr>
                            <td colspan="8" style="font-style:italic; color:#adadad; font-size:14px;">Belum Ada Penawaran. Mohon Bersabar Menunggu.</td>
                        </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script>
        function download(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        }
    </script>
</body>

</html>