<?php 
    //inisialisasi session
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

    // $query = "SELECT p.no_pesanan, CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan, p.waktu_pemesanan, CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota) AS alamat_lengkap, s.nama_service, p.status_pesanan, pi.nama_item, pi.material, pi.jumlah_item
    // FROM pemesanan p
    // JOIN service s
    // ON p.id_service = s.id_service
    // JOIN pemesanan_item pi
    // ON p.no_pesanan = pi.no_pesanan
    // WHERE id_pelanggan = ?;";
    $query = "SELECT *, CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan, p.waktu_pemesanan, CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota) AS alamat_lengkap
    FROM pemesanan p
    JOIN service s
    ON p.id_service = s.id_service
    JOIN pemesanan_item pi
    ON p.no_pesanan = pi.no_pesanan
    WHERE id_pelanggan = ?;";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $_SESSION['data']['id_pelanggan']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $pesanan = [];
        while($data = $result->fetch_assoc()) {
            $pesanan[] = $data;
        }
        $_SESSION['pesanan'] = $pesanan;
    } else {
        $_SESSION['pesanan'] = [];
    }

    // kasih tahu ke pelanggan dengan notif sederhana
    $query = "SELECT *, CONCAT('WP', LPAD(ps.no_pesanan, 5, '0')) AS nomor_pesanan
            FROM penawaran pw
            JOIN pemesanan ps ON ps.no_pesanan = pw.no_pesanan
            WHERE ps.id_pelanggan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $_SESSION['data']['id_pelanggan']);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $notif = [];
        $notifText = [];

        while($row = $result->fetch_assoc()) {
            $notifText[] = "Anda mendapatkan surat penawaran dengan <strong>Nomor Pesanan " . $row['nomor_pesanan'] . "</strong>";
            $notif[] = $row;
        }

        $_SESSION['notif'] = $notif;
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
            <h1><?= $_SESSION['data']['nama_pelanggan']?>!</h1>
            <table>
                <tr>
                    <td><h1>Dashboard</h1></td>
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
                    <td class="button"><a href="pages/settings/"><i class="fas fa-pen-to-square"></i> Edit Profil</a></td>
                </tr>
            </table>

            <div class="riwayat-notif">
                <div class="riwayat">
                    <h2>Daftar & Riwayat Pesanan</h2>
                    <hr class="hr-standar">
                    <div class="msg-riwayat">
                        <?php foreach ($_SESSION['pesanan'] as $pesanan) { ?>
                        <a href="pages/my-order/detail/?detail=<?= $pesanan['no_pesanan'] ?>" class="riwayat-box">
                            <p>
                                <?php
                                if($pesanan['status_pesanan'] == "Menunggu Penawaran") {
                                    echo "Pesanan " . $pesanan['status_pesanan'];
                                } else if($pesanan['status_pesanan'] == "Dalam Proses") {
                                    echo "Pesanan Sedang " . $pesanan['status_pesanan'];
                                } else {
                                    echo "Pesanan Telah " . $pesanan['status_pesanan'];
                                }
                                ?>
                            </p>
                            <p>Cek rincian pesanan <?= $pesanan['nomor_pesanan'] . " - " . $pesanan['nama_item'] ?> dengan jenis layanan <?= $pesanan['nama_service'] ?> di sini</p>
                            <i class="fas fa-chevron-right"></i>
                            <hr>
                        </a>
                        <?php } ?>
                        <?php 
                        if($_SESSION['pesanan'] == []) { 
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
                    <h2>Notifikasi Penawaran</h2><hr>
                    <?php foreach($notifText as $notif) : ?>
                        <p class="notif-text"><?= $notif ?></p>
                    <?php endforeach; 

                    if($notifText == []): ?>
                    <div class="msg-notif">
                        <em>Belum ada notifikasi</em>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </section>
    </main>

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