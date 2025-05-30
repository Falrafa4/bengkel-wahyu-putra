<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

if (isset($_GET['hapus'])) {
    $id_penawaran = $_GET['hapus'];
    $no_pesanan = $_GET['no'];

    if (deletePenawaran($conn, $id_penawaran)) {
        if (updateStatusPesanan($conn, $no_pesanan, 1)) {
            $_SESSION['eksekusi'] = "Data Berhasil Dihapus!";
            header("location: ./");
            exit();
        } else {
            die("Terjadi kesalahan saat mengupdate status pesanan");
        }
    } else {
        die("Terjadi kesalahan saat menghapus data penawaran");
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

    <title>Penawaran - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="container-crud">
            <section class="daftar-crud">
                <h1>Data Penawaran</h1>
                <p>Berisi surat penawaran dari pemilik bengkel.</p><br>
                <hr>
                <a href="../pemesanan/" class="btn-add" id="addOffer"><i class="fas fa-plus"></i> Tambah Data</a>

                <?php if (isset($_SESSION['eksekusi'])) { ?>
                    <div class="success-update">
                        <em><?= $_SESSION['eksekusi'] ?></em>
                        <i class="fas fa-close" onclick="closeAlert()"></i>
                    </div>
                <?php unset($_SESSION['eksekusi']);
                }
                ?>

                <?php
                $querySelect = "SELECT * FROM penawaran";
                $sql = mysqli_query($conn, $querySelect);
                ?>

                <table class="table-crud">
                    <tr>
                        <th>ID Penawaran</th>
                        <th>No Pesanan</th>
                        <th>Surat Penawaran</th>
                        <th>Harga</th>
                        <th>Tgl Penawaran</th>
                        <th>Status Penawaran</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                        <tr>
                            <td><?= $result['id_penawaran'] ?></td>
                            <td><?= $result['no_pesanan'] ?></td>
                            <td><iframe src="../../../uploads/penawaran/<?= $result['surat_penawaran'] ?>"></iframe></td>
                            <td><?= number_format($result['harga'], 0, ',', '.') ?></td>
                            <td><?= $result['tgl_penawaran'] ?></td>

                            <td class="
                            <?php
                            $status = '';
                            if ($result['status_penawaran'] == 'Negosiasi') {
                                $status = "<i class='fas fa-handshake'></i> Negosiasi";
                                echo 'row-yellow';
                            } elseif ($result['status_penawaran'] == 'Disetujui') {
                                $status = "<i class='fas fa-check'></i> Disetujui";
                                echo 'row-green';
                            } else {
                                $status = "<i class='fas fa-envelope'></i> Diterbitkan";
                            }
                            ?>
                            " <?php //echo $result['status_penawaran'] == 'Disetujui' ? 'colspan="2"' : ''; ?> style="text-align: center;"><?= $status ?></td>
                            
                            <?php if($result['status_penawaran'] != 'Disetujui') : ?>
                            <td class="action">
                                <a href="kelola/?no=<?= $result['no_pesanan'] ?>&edit=1" class="btn edit"><i class="fas fa-pen-to-square"></i></a>
                                <a href="./?hapus=<?= $result['id_penawaran'] ?>&no=<?= $result['no_pesanan'] ?>" class="btn hapus"><i class="fas fa-trash"></i></a>
                            </td>

                            <?php else : 
                                echo '<td style="text-align: center;"> - </td>'; 
                            endif;
                            ?> 
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

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
    <script>
        document.getElementById('addOffer').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                icon: "info",
                title: "Pesanan Belum Dipilih",
                showCancelButton: true,
                confirmButtonText: "Pilih Pesanan",
                cancelButtonText: "Batal",
                text: "Harap memilih pesanan untuk menambahkan surat penawaran"
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '../pemesanan/';
                }
            });
        })

        document.querySelectorAll('.btn.hapus').forEach(button => {
            button.addEventListener('click', function(e) {
                const role = this.dataset.role;
                const id = this.dataset.id;
                const href = this.getAttribute('href');

                e.preventDefault();

                Swal.fire({
                    title: 'Hapus Penawaran?',
                    text: 'Tindakan ini tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Tidak!'
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