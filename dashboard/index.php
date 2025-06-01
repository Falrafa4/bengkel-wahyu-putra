<?php
//inisialisasi session
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

$query = "SELECT p.*, s.nama_service, pi.nama_item, CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan
    FROM pemesanan p
    JOIN service s ON p.id_service = s.id_service
    JOIN pemesanan_item pi ON p.no_pesanan = pi.no_pesanan
    WHERE id_pelanggan = ?
    ORDER BY waktu_pemesanan DESC
	LIMIT 3;";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['data']['id_pelanggan']);
$stmt->execute();
$result_riwayat = $stmt->get_result();

// kasih tahu ke pelanggan dengan notif sederhana
$notif = "SELECT *, CONCAT('WP', LPAD(ps.no_pesanan, 5, '0')) AS nomor_pesanan, DATE_FORMAT(pw.tgl_penawaran, '%d-%m-%Y') as tgl_penawaran
            FROM penawaran pw
            JOIN pemesanan ps ON ps.no_pesanan = pw.no_pesanan
            WHERE ps.id_pelanggan = ? AND pw.status_penawaran = 'Diterbitkan'
            ORDER BY pw.tgl_penawaran DESC;";
$stmt_notif = $conn->prepare($notif);
$stmt_notif->bind_param('i', $_SESSION['data']['id_pelanggan']);
$stmt_notif->execute();
$result_notif = $stmt_notif->get_result();

// $result = getPenawaran($conn, $_SESSION['data']['id_pelanggan']);
if ($result_notif->num_rows > 0) {
    $notif = [];
    $notifText = [];

    while ($row = $result_notif->fetch_assoc()) {
        $notifText[] = $row['tgl_penawaran'] . " - Anda mendapatkan surat penawaran untuk <strong>Nomor Pesanan " . $row['nomor_pesanan'] . "</strong>";
        $notif[] = $row;

        $_SESSION['notif'] = $row;
    }
} else {
    $notifText = [];
    $_SESSION['notif'] = [];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/user.css">
    <link rel="shortcut icon" href="../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

    <title>Dashboard - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main class="home">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <h2>Selamat Datang,</h2>
            <h1><?= $_SESSION['data']['nama_pelanggan'] ?>!</h1>
            <table>
                <tr>
                    <td>
                        <h1>Dashboard</h1>
                    </td>
                </tr>
                <tr>
                    <td class="info">Nama Lengkap</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['nama_pelanggan'] ?></td>
                </tr>
                <tr>
                    <td class="info">Email</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['email'] ?></td>
                </tr>
                <tr>
                    <td class="info">No. Telepon</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['no_telp'] ?></td>
                </tr>
                <tr>
                    <td class="info">Jenis Akun</td>
                    <td>:</td>
                    <td class="data"><?= $_SESSION['data']['jenis_akun'] ?></td>
                </tr>
                <?php
                if ($_SESSION['data']['jenis_akun'] == 'Perusahaan') { ?>
                    <tr>
                        <td class="info">Nama Perusahaan</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['nama_perusahaan'] ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="button"><a href="pages/settings/"><i class="fas fa-pen-to-square"></i> Edit Profil</a></td>
                </tr>
            </table>

            <div class="riwayat-notif">
                <div class="riwayat">
                    <h2>Daftar & Riwayat Pesanan</h2>
                    <hr class="hr-standar">
                    <div class="msg-riwayat">
                        <?php while ($riwayat = $result_riwayat->fetch_assoc()) { ?>
                            <a href="pages/my-order/detail/?detail=<?= $riwayat['no_pesanan'] ?>" class="riwayat-box">
                                <p>
                                    <?php
                                    if ($riwayat['status_pesanan'] == "Menunggu Penawaran") {
                                        echo "Pesanan " . $riwayat['status_pesanan'];
                                    } elseif ($riwayat['status_pesanan'] == "Dalam Proses") {
                                        echo "Pesanan Sedang " . $riwayat['status_pesanan'];
                                    } elseif ($riwayat['status_pesanan'] == "Penawaran Diterbitkan") {
                                        echo "Penawaran Pesanan Telah Diterbitkan";
                                    } elseif ($riwayat['status_pesanan'] == "Selesai") {
                                        echo "Pesanan Telah Selesai";
                                    } else {
                                        echo "Pesanan Dalam " . $riwayat['status_pesanan'];
                                    }
                                    ?>
                                </p>
                                <p>Cek rincian pesanan <?= $riwayat['nomor_pesanan'] . " - " . $riwayat['nama_item'] ?> dengan jenis layanan <?= $riwayat['nama_service'] ?> di sini</p>
                                <i class="fas fa-chevron-right"></i>
                                <hr>
                            </a>
                        <?php } ?>
                        <?php
                        if ($result_riwayat->num_rows == 0) {
                        ?>
                            <div class="no-order">
                                <em>Anda belum membuat pesanan sama sekali.</em>
                                <a href="pages/new-order/">
                                    <i class="fas fa-circle-plus"></i>
                                    Buat Pesanan Baru
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="notif">
                    <h2>Notifikasi Penawaran</h2>
                    <hr>
                    <?php foreach ($notifText as $notif) : ?>
                        <p class="notif-text"><?= $notif ?></p>
                    <?php endforeach;

                    if ($notifText == []): ?>
                        <div class="msg-notif">
                            <em>Belum ada notifikasi</em>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    </main>

    <script src="../assets/js/main.js"></script>
    <script>
        const notifText = document.querySelectorAll('.notif-text');
        notifText.forEach(notif => {
            notif.addEventListener('click', function() {
                window.location.href = "pages/list-offer/";
            })
        });
    </script>
</body>

</html>