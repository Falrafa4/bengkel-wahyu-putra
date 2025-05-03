<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";

if (isset($_GET['hapus'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
    $no_pesanan = $_GET['hapus'];

    if (deletePemesanan($conn, $no_pesanan)) {
        $_SESSION['eksekusi'] = "Data Berhasil Dihapus!";
        header("location: ./");
        exit();
    } else {
        echo $stmt->execute();
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

    <title>Pemesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="container-crud">
            <section class="daftar-crud">
                <h1>Data Pemesanan</h1>
                <hr>
                <a href="kelola/" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>

                <?php if (isset($_SESSION['eksekusi'])) { ?>
                    <div class="success-update">
                        <em><?= $_SESSION['eksekusi'] ?></em>
                        <i class="fas fa-close" onclick="closeAlert()"></i>
                    </div>
                <?php unset($_SESSION['eksekusi']);
                }
                ?>

                <?php
                $querySelect = "SELECT p.no_pesanan,p.id_pelanggan,p.waktu_pemesanan,CONCAT(p.nama_jalan,', ',p.kecamatan,', ',p.kabupaten_kota,', ',p.provinsi,', ',p.kode_pos) AS alamat_lengkap,p.detail,p.id_service,p.status_pesanan
                    FROM pemesanan p ";
                $sql = mysqli_query($conn, $querySelect);
                ?>

                <table class="table-crud">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>ID Pelanggan</th>
                        <th>Waktu Pemesanan</th>
                        <th>Alamat</th>
                        <th>Detail Alamat</th>
                        <th>ID Service</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                        <tr>
                            <td style="text-align: center;"><?= $result['no_pesanan'] ?></td>
                            <td style="text-align: center;"><?= $result['id_pelanggan'] ?></td>
                            <td style="text-align: center;"><?= $result['waktu_pemesanan'] ?></td>
                            <td><?= $result['alamat_lengkap'] ?></td>
                            <td><?php if ($result['detail'] == NULL) echo "-";
                                else echo $result['detail']; ?></td>
                            <td style="text-align: center;"><?= $result['id_service'] ?></td>
                            <td><?= $result['status_pesanan'] ?></td>
                            <td class="action">
                                <a href="./kelola/?ubah=<?= $result['no_pesanan'] ?>" class="btn edit"><i class="fas fa-pen-to-square"></i></a>
                                <a href="./?hapus=<?= $result['no_pesanan'] ?>" data-id="" class="btn hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
        </div>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn.hapus').forEach(button => {
            button.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            })
        })
    </script>
</body>

</html>