<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

if (isset($_POST['konfirmasi'])) {
    $id_pembayaran = $_POST['id_pembayaran'];
    $no_pesanan = $_POST['no_pesanan'];

    if (updateStatusPembayaran($conn, $id_pembayaran, 2)) {
        if (updateStatusPesanan($conn, $no_pesanan, 7)) {
            $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
            header("location: ./");
        } else {
            die("Gagal mengupdate status pesanan");
        }
    } else {
        die("Gagal mengupdate status negosiasi");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/global.css">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/admin.css">
    <link rel="shortcut icon" href="/bengkel-wahyu-putra/assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/fontawesome/css/all.css">

    <!-- Sweetalert2 -->
    <script src="/bengkel-wahyu-putra/assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Pembayaran - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="container-crud">
            <section class="daftar-crud">
                <h1>Data Pembayaran</h1>
                <hr>

                <?php if (isset($_SESSION['eksekusi'])) { ?>
                    <div class="success-update">
                        <em><?= $_SESSION['eksekusi'] ?></em>
                        <i class="fas fa-close" onclick="closeAlert()"></i>
                    </div>
                <?php unset($_SESSION['eksekusi']);
                }
                ?>

                <?php
                $querySelect = "SELECT * FROM pembayaran ORDER BY tgl_bayar DESC;";
                $sql = mysqli_query($conn, $querySelect);
                ?>

                <table class="table-crud">
                    <tr>
                        <th>ID Pembayaran</th>
                        <th>No. Pesanan</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Bayar</th>
                        <th>Tgl Bayar</th>
                        <th>Bukti Bayar</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                        <tr>
                            <td><?= $result['id_pembayaran'] ?></td>
                            <td><?= $result['no_pesanan'] ?></td>
                            <td>
                                <?= $result['metode_pembayaran'] == 'BCA' ? '<img src="../../../assets/img/bca.png" width="100%">' : '<img src="../../../assets/img/mandiri.png" width="100%">' ?>
                            </td>
                            <td><?= number_format($result['total_bayar'], 0, ',', '.') ?></td>
                            <td style="width: 15%; text-align: center;"><?= $result['tgl_bayar'] ?></td>

                            <td style="width: 25%; text-align: center;">
                                <img src="../../../uploads/pembayaran/<?= $result['bukti_bayar'] ?>" alt="" width="100%">
                                <a class="button" href="../../../uploads/pembayaran/<?= $result['bukti_bayar'] ?>" download>Download</a>
                            </td>

                            <td <?= $result['status_bayar'] == 'Sedang Dikonfirmasi' ? 'class="row-yellow"' : 'class="row-green" colspan=2' ?> style="text-align: center;">
                                <?= $result['status_bayar'] ?>
                            </td>

                            <?php if ($result['status_bayar'] == 'Sedang Dikonfirmasi') : ?>
                                <td class="action">
                                    <!-- <a href="./kelola/?id=<?= $result['id_pembayaran'] ?>" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a> -->
                                    <form action="./" method="post" class="form_konfirmasi">
                                        <input type="hidden" name="no_pesanan" value="<?= $result['no_pesanan'] ?>">
                                        <input type="hidden" name="id_pembayaran" value="<?= $result['id_pembayaran'] ?>">
                                        <button type="submit" name="konfirmasi" class="btn blue" onclick="return confirm('Apakah Anda yakin ingin mengonfirmasi pesanan ini?')">Konfirmasi</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                    <?php if (mysqli_num_rows($sql) == 0) { ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px 0px; font-style: italic;">Belum ada data</td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
        </div>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/script.js"></script>
</body>

</html>