<?php 
    //inisialisasi session
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

    $query = "SELECT CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan, p.waktu_pemesanan, CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota) AS alamat_lengkap, s.nama_service, p.status_pesanan, pi.nama_item, pi.material, pi.jumlah_item
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/user.css">
    <link rel="shortcut icon" href="../assets/img/logo-wp-circle.png">
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
                    <h2>Daftar & Riwayat Pesanan</h2><hr>
                    <div class="msg-riwayat">
                        <?php foreach ($_SESSION['pesanan'] as $pesanan) { ?>
                        <p><?= $pesanan['nama_item'] ?></p>
                        <?php } 
                        if($_SESSION['pesanan'] == []) { 
                        ?>
                        <div class="no-order">
                            <em>Anda belum memiliki pesanan sama sekali.</em>
                            <a href="pages/new-order/">
                                <i class="fas fa-circle-plus"></i>
                                Buat Pesanan Baru
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="notif">
                    <h2>Notifikasi</h2><hr>
                    <div class="msg-notif">
                        <em>Belum ada notifikasi</em>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
</body>
</html>