<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
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
                <h1>Data Pembayaran</h1><hr>
                <a class="btn-add" onclick='
                        Swal.fire({
                            title: "Informasi!",
                            text: "Tambah Pembayaran hanya bisa dilakukan oleh user",
                            icon: "info"
                        })
                '><i class="fas fa-plus"></i> Tambah Data</a>
        
                <?php if(isset($_SESSION['eksekusi'])) {?>
                <div class="success-update">
                    <em><?= $_SESSION['eksekusi'] ?></em>
                    <i class="fas fa-close" onclick="closeAlert()"></i>
                </div>
                <?php unset($_SESSION['eksekusi']); }
                ?>
        
                <?php 
                    $querySelect = "SELECT * FROM pembayaran;";
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
                    <?php while($result = mysqli_fetch_assoc($sql)){?>
                    <tr>
                        <td><?= $result['id_pembayaran'] ?></td>
                        <td><?= $result['no_pesanan'] ?></td>
                        <td>
                            <?= $result['metode_pembayaran'] == 'BCA' ? '<img src="../../../assets/img/bca.png" width="100%">' : '<img src="../../../assets/img/mandiri.png" width="100%">' ?>
                        </td>
                        <td><?= number_format($result['total_bayar'], 0, ',', '.') ?></td>
                        <td><?= $result['tgl_bayar'] ?></td>
                        
                        <td style="width: 25%; text-align: center;">
                            <img src="../../../uploads/pembayaran/<?= $result['bukti_bayar'] ?>" alt="" width="100%">
                            <a class="button" href="../../../uploads/pembayaran/<?= $result['bukti_bayar'] ?>" download>Download</a>
                        </td>

                        <td
                        <?= $result['status_bayar'] == 'Sedang Dikonfirmasi' ? 'class="row-yellow"' : '' ?>
                        ><?= $result['status_bayar'] ?></td>
                        <td class="action">
                            <a href="./kelola/?id=<?= $result['id_pembayaran'] ?>" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($sql) == 0) { ?>
                        <tr >
                            <td colspan="8" style="text-align: center; padding: 40px 0px; font-style: italic;">Belum ada data</td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
        </div>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>
</html>