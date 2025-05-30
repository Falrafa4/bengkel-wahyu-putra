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
                $querySelect = "SELECT pemesanan.* ,CONCAT(nama_jalan,', ',kecamatan,', ',kabupaten_kota,', ',provinsi,', ',kode_pos) AS alamat_lengkap, pelanggan.nama_pelanggan, service.nama_service
                FROM pemesanan
                JOIN pelanggan ON pemesanan.id_pelanggan = pelanggan.id_pelanggan
                JOIN service ON pemesanan.id_service = service.id_service ORDER BY pemesanan.no_pesanan ASC";
                $sql = mysqli_query($conn, $querySelect);
                ?>

                <table class="table-crud">
                    <tr>
                        <th style="width: 50px;">No. Psnn</th>
                        <th>Pelanggan</th>
                        <th>Waktu Pemesanan</th>
                        <th>Alamat</th>
                        <th>Detail Alamat</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($result = mysqli_fetch_assoc($sql)) { $no_pesanan = $result['no_pesanan']; ?>
                        <tr>
                            <td style="text-align: center;" id="<?= $result['no_pesanan'] ?>"><?= $result['no_pesanan'] ?></td>
                            <td><?= $result['nama_pelanggan'] ?></td>
                            <td style="text-align: center;"><?= $result['waktu_pemesanan'] ?></td>
                            <td><?= $result['alamat_lengkap'] ?></td>
                            <td><?php if ($result['detail'] == NULL) echo "-";
                                else echo $result['detail']; ?></td>
                            <td style="text-align: center;"><?= $result['nama_service'] ?></td>
                            <td class="<?= $result['status_pesanan'] == 'Menunggu Penawaran' ? 'row-yellow' : '' ?>"><?= $result['status_pesanan'] ?></td>
                            <td class="action">
                                <a href="./kelola/?ubah=<?= $result['no_pesanan'] ?>" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                                <br><br>
                                <?php if($result['status_pesanan'] == 'Menunggu Penawaran') : ?>
                                    <a <?= $result['status_pesanan'] == 'Menunggu Penawaran' ? "href='../penawaran/kelola/?no=$no_pesanan'" : '' ?> class="btn warning"><i class="fas fa-envelope"></i> Buat Surat</a>
                                    <br><br>
                                <?php endif; ?>
                                <a href="../pemesanan_item/#<?= $result['no_pesanan']-1 ?>" class="btn blue"><i class="fas fa-arrow-right"></i> Lihat Item</a>
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