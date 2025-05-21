<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

// $nama_service;
// $nama_item;
// $material;
// $jumlah_item;
// $waktu_pemesanan;
// $status_pesanan;
// $desain_gambar;
// $nama_jalan;
// $kecamatan;
// $kabupaten_kota;
// $provinsi;
// $kode_pos;
// $detail;

if (isset($_GET['detail'])) {
    $no_pesanan = $_GET['detail'];
    $query = "SELECT * FROM pemesanan p
                JOIN service s
                ON p.id_service = s.id_service
                JOIN pemesanan_item pi
                ON p.no_pesanan = pi.no_pesanan
                WHERE p.no_pesanan = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $no_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
} else {
    header('location: ../');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../assets/fontawesome/css/all.css">

    <title>Detail Pesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main class="detailPesanan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <div class="main-content">
                <h1>Detail Pesanan</h1>

                <a href="../">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <div class="informasi">
                    <h2 style="margin-bottom: 10px;">Informasi Pesanan</h2>
                    <div class="informasi-flex">
                        <div class="img-jasa">
                            <img src="../../../../assets/img/<?= $result['gambar_jasa'] ?>" alt="Jasa">
                            <h1>Jasa <?= $result['nama_service'] ?></h1>
                        </div>
                        <table>
                            <tr>
                                <th>No Pesanan</th>
                                <td><?= $result['no_pesanan'] ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Layanan</th>
                                <td><?= $result['nama_service'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Item</th>
                                <td><?= $result['nama_item'] ?></td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td><?= $result['material'] ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Item</th>
                                <td><?= $result['jumlah_item'] ?></td>
                            </tr>
                            <tr>
                                <th>Waktu Pemesanan</th>
                                <td><?= $result['waktu_pemesanan'] ?></td>
                            </tr>
                            <tr>
                                <th>Status Pesanan</th>
                                <td><?= $result['status_pesanan'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="desain-alamat">
                    <div class="desain">
                        <h2>Desain Gambar</h2>
                        <?php
                        $split = explode('.', $result['desain_gambar']);
                        $ekstensi = $split[count($split) - 1];

                        if ($ekstensi == 'pdf') { ?>
                            <iframe src="../../../../uploads/desain/<?= $result['desain_gambar'] ?>" width="100%" height="200px"></iframe>
                        <?php } else {
                        ?>
                            <img src="../../../../uploads/desain/<?= $result['desain_gambar'] ?>" alt="" style="height: 80%; width: 100%">
                        <?php } ?>
                    </div>
                    <div class="alamat">
                        <h2 style="margin-bottom: 1rem;">Alamat Lengkap</h2>
                        <table>
                            <tr>
                                <th>Nama Jalan</th>
                                <td><?= $result['nama_jalan'] ?></td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td><?= $result['kecamatan'] ?></td>
                            </tr>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <td><?= $result['kabupaten_kota'] ?></td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td><?= $result['provinsi'] ?></td>
                            </tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td><?= $result['kode_pos'] ?></td>
                            </tr>
                            <tr>
                                <th>Detail Alamat</th>
                                <td><?= $result['detail'] ?? '-' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="../../../../assets/js/main.js"></script>
</body>

</html>