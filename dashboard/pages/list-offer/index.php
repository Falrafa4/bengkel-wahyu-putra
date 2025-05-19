<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
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

    <!-- Sweetalert2 -->
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Daftar Pesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <?php
    if (isset($_GET['no'])) {
        // Acc pesanan dengan mengubah status penawaran
        $no_pesanan = $_GET['no'];

        if (updateStatusPenawaran($conn, 3, $no_pesanan)) {
            echo '<script>Swal.fire({
                title: "Berhasil!",
                text: "Surat Penawaran diterima! Terima kasih atas kepercayaan Anda",
                icon: "success",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./";
                    console.log("Ini Redirect");
                }
            });</script>';
        }
    }
    ?>

    <main class="daftarPesanan offer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <div class="main-content">
                <h1>Surat Penawaran</h1>
                <hr class="hr-standar" style="width: 10dvw;">
                <p>Berisi surat penawaran dari Bengkel Wahyu Putra</p>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 200px;">No Pesanan</th>
                            <th style="width: 250px;">Status Penawaran</th>
                            <th>Tanggal Terbit</th>
                            <th>Surat Penawaran</th>
                            <th style="width: 250px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $penawaran = getPenawaran($conn, $_SESSION['data']['id_pelanggan']);
                        while ($row = $penawaran->fetch_assoc()) : ?>
                            <tr>
                                <td><a href="../my-order/detail/?detail=<?= $row['no_pesanan'] ?>"><?= $row['nomor_pesanan'] ?></a></td>
                                <td><?= $row['status_penawaran'] ?></td>
                                <td><?= $row['tgl_penawaran'] ?></td>
                                <td><button onclick="download('../../../uploads/penawaran/<?= $row['surat_penawaran'] ?>')"><i class="fas fa-download"></i> Unduh Surat</button></td>
                                <td class="<?= $row['status_penawaran'] == 'Disetujui' ? 'offer-agree' : '' ?>">
                                    <?php if ($row['status_penawaran'] == 'Disetujui') : ?>
                                        <i class="fas fa-check"></i> Penawaran Disetujui
                                    <?php else : ?>
                                        <button class="agree" data-no="<?= $row['no_pesanan'] ?>" data-nomor="<?= $row['nomor_pesanan'] ?>">
                                            <i class="fas fa-check"></i> Setuju
                                        </button>
                                        <button class="warning nego" data-no="<?= $row['no_pesanan'] ?>" onclick="modalAktif('<?= $row['nomor_pesanan'] ?>','<?= $row['no_pesanan'] ?>')">
                                            <i class="fas fa-handshake"></i> Nego
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        <?php if ($_SESSION['notif'] == []): ?>
                            <tr>
                                <td colspan="8" style="font-style:italic; color:#adadad; font-size:14px;">Belum Ada Penawaran. Mohon Bersabar Menunggu.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

                <div class="modal" id="modal">
                    <div class="bg"></div>
                    <form action="" method="POST" class="wrapper">
                        <h1>Ajukan Negosiasi</h1>
                        <input type="hidden" name="no_pesanan" id="no_pesanan">
                        <div class="input-box">
                            <input type="text" name="nomor" id="nomor" disabled>
                        </div>
                        <div class="input-box">
                            <select name="" id="">
                                <option value="" selected hidden>Pilih Jenis Negosiasi</option>
                                <option value="">Harga</option>
                                <option value="">Estimasi</option>
                                <option value="">Lainnya (tulis di catatan)</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <textarea name="catatan" id="catatan" placeholder="Tambah Catatan (Opsional)"></textarea>
                            <!-- <input type="text" name="catatan" id="catatan" placeholder="Tambah Catatan"> -->
                        </div>
                        <button class="button kirim" type="submit">Kirim</button>
                        <button class="button hapus" type="button" onclick="modalNonaktif()">Batal</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        // download surat
        function download(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        }

        // untuk menampilkan modal
        function modalAktif(nomor, noPesanan) {
            document.getElementById('nomor').value = nomor;
            document.getElementById('no_pesanan').value = noPesanan;
            document.getElementById('modal').style.display = 'flex';
        }

        // untuk menutup modal
        function modalNonaktif() {
            document.getElementById('modal').style.display = 'none';
        }

        window.addEventListener('load', function() {
            document.getElementById('modal').style.display = 'none';
        });

        // 
        document.querySelectorAll('.agree').forEach(agree => {
            const no = agree.dataset.no;
            const nomor = agree.dataset.nomor;
            agree.addEventListener('click', function() {
                Swal.fire({
                    title: "Konfirmasi",
                    text: `Apakah Anda yakin untuk menerima Surat Penawaran agar pesanan ${nomor} segera dikerjakan?`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './?no=' + encodeURIComponent(no);
                    }
                });
            });
        });
    </script>
</body>

</html>