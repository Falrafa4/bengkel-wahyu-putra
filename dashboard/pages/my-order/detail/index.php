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

    // var_dump($result);
    // die();
    $gambar_jasa = $result['gambar_jasa'];
    $nama_service = $result['nama_service'];
    $nama_item = $result['nama_item'];
    $material = $result['material'];
    $jumlah_item = $result['jumlah_item'];
    $waktu_pemesanan = $result['waktu_pemesanan'];
    $status_pesanan = $result['status_pesanan'];

    $desain_gambar = $result['desain_gambar'];
    $nama_jalan = $result['nama_jalan'];
    $kecamatan = $result['kecamatan'];
    $kabupaten_kota = $result['kabupaten_kota'];
    $provinsi = $result['provinsi'];
    $kode_pos = $result['kode_pos'];
    $detail = $result['detail'];
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
                            <img src="../../../../assets/img/<?= $gambar_jasa ?>" alt="Jasa">
                            <h1>Jasa <?= $nama_service ?></h1>
                        </div>
                        <table>
                            <tr>
                                <th>Jenis Layanan</th>
                                <td><?= $nama_service ?></td>
                            </tr>
                            <tr>
                                <th>Nama Item</th>
                                <td><?= $nama_item ?></td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td><?= $material ?? '-' ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Item</th>
                                <td><?= $jumlah_item ?></td>
                            </tr>
                            <tr>
                                <th>Waktu Pemesanan</th>
                                <td><?= $waktu_pemesanan ?></td>
                            </tr>
                            <tr>
                                <th>Status Pesanan</th>
                                <td><?= $status_pesanan ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="desain-alamat">
                    <div class="desain">
                        <h2>Desain Gambar</h2>
                        <iframe src="../../../../uploads/desain/<?= $desain_gambar ?>"></iframe>
                    </div>
                    <div class="alamat">
                        <h2>Alamat Lengkap</h2>
                        <table>
                            <tr>
                                <th>Nama Jalan</th>
                                <td><?= $nama_jalan ?></td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td><?= $kecamatan ?></td>
                            </tr>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <td><?= $kabupaten_kota ?></td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td><?= $provinsi ?></td>
                            </tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td><?= $kode_pos ?></td>
                            </tr>
                            <tr>
                                <th>Detail Alamat</th>
                                <td><?= $detail ?? '-' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </main>
</body>

</html>