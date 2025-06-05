<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

$query = "SELECT *, CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan, p.waktu_pemesanan, CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota,', ',p.provinsi,' ',p.kode_pos) AS alamat_lengkap
    FROM pemesanan p
    JOIN service s
    ON p.id_service = s.id_service
    JOIN pemesanan_item pi
    ON p.no_pesanan = pi.no_pesanan
    WHERE id_pelanggan = ?;";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['data']['id_pelanggan']);
$stmt->execute();
$result_pesanan = $stmt->get_result();
if ($result_pesanan->num_rows > 0) {
    $pesanan = [];
    while ($data = $result_pesanan->fetch_assoc()) {
        $pesanan[] = $data;
    }
} else {
    $pesanan = [];
}

if (isset($_POST['search'])) {
    $keyword = '%' . $_POST['search'] . '%';

    $query = "SELECT *,
    CONCAT('WP', LPAD(p.no_pesanan, 5, '0')) AS nomor_pesanan,
    CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota,' ',p.kode_pos) AS alamat_lengkap
    FROM pemesanan p
    JOIN service s ON p.id_service = s.id_service
    JOIN pemesanan_item pi ON p.no_pesanan = pi.no_pesanan
    WHERE id_pelanggan = ? AND (CONCAT_WS(' ', p.no_pesanan, pi.nama_item, p.nama_jalan, p.kecamatan, p.kabupaten_kota, p.provinsi, p.kode_pos, p.status_pesanan)LIKE ?);";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $_SESSION['data']['id_pelanggan'], $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pesananSearch = [];
        while ($data = $result->fetch_assoc()) {
            $pesananSearch[] = $data;
        }
        $pesanan = $pesananSearch;
    } else {
        $pesanan = [];
    }
}
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
                <h1>Daftar Pesanan</h1>
                <hr class="hr-standar" style="width: 10dvw">
                <p>Berisi daftar pesanan yang telah Anda buat sebelumnya.</p>
                <form action="./" method="post" class="search">
                    <input type="text" name="search" id="search" placeholder="Cari...">
                    <button type="submit">
                        <i class="fas fa-search" style="font-size: 1rem;"></i>
                    </button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%;">No Pesanan</th>
                            <th style="width: 10%">Nama Item</th>
                            <th style="width: 30%;">Desain Gambar</th>
                            <th>Alamat</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pesanan as $row) { ?>
                            <tr>
                                <td><?= $row['nomor_pesanan'] ?></td>
                                <td><?= $row['nama_item'] ?></td>
                                <td>
                                    <?php
                                    $split = explode('.', $row['desain_gambar']);
                                    $ekstensi = $split[count($split) - 1];

                                    if ($ekstensi == 'pdf') { ?>
                                        <iframe src="../../../uploads/desain/<?= $row['desain_gambar'] ?>" width="100%" height="200px"></iframe>
                                    <?php } else {
                                    ?>
                                        <img src="../../../uploads/desain/<?= $row['desain_gambar'] ?>" alt="" style="width: 100%;">
                                    <?php } ?>
                                </td>
                                <td style="text-align: left;"><?= $row['alamat_lengkap'] ?></td>
                                <td style="font-weight: bold;
                                <?php
                                if ($row['status_pesanan'] == 'Menunggu Penawaran' || $row['status_pesanan'] == 'Konfirmasi Pembayaran') {
                                    echo 'background-color: #e4efff';
                                } elseif ($row['status_pesanan'] == 'Penawaran Diterbitkan') {
                                    echo 'background-color: #ffd670';
                                } elseif ($row['status_pesanan'] == 'Negosiasi Penawaran') {
                                    echo 'background-color: #ff7975';
                                } elseif ($row['status_pesanan'] == 'Dalam Proses') {
                                    echo 'background-color: #70abff';
                                } elseif ($row['status_pesanan'] == 'Menunggu Pembayaran') {
                                    echo 'background-color: #ffd670';
                                } else {
                                    echo 'background-color: #e4ffe4';
                                }
                                ?>
                                ">
                                    <?php
                                    echo $row['status_pesanan'];
                                    if ($row['status_pesanan'] == 'Penawaran Diterbitkan') {
                                        echo "<br><br><a href='../list-offer/'>Lihat</a>";
                                    }
                                    ?>

                                </td>
                                <td>
                                    <a href="detail/?detail=<?= $row['no_pesanan'] ?>">
                                        Detail
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <?php if ($row['status_pesanan'] == 'Menunggu Pembayaran') : ?>
                                        <a class="agree" href="../payment/?no=<?= $row['no_pesanan'] ?>">
                                            Bayar
                                            <i class="fas fa-receipt"></i>
                                        </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php }
                        if ($pesanan == []) {
                        ?>
                            <tr>
                                <td colspan="8" class="no-record">Anda Belum Membuat Pesanan</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- <iframe src="../../../uploads/desain/test.pdf" width="600" height="400"></iframe> -->
            </div>
        </section>
    </main>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>