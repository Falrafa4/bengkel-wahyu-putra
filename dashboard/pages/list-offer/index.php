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
        $id_penawaran = $_GET['no'];

        if (updateStatusPenawaran($conn, 3, $id_penawaran)) {
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

    if (isset($_POST['negosiasi'])) {
        $no_pesanan = $_POST['no_pesanan'];
        $id_penawaran = $_POST['id_penawaran'];
        $jenis_negosiasi = $_POST['jenis_negosiasi'];
        $harga_tawaran = !empty($_POST['harga_tawaran']) ? $_POST['harga_tawaran'] : null;
        $estimasi_tawaran = !empty($_POST['estimasi_tawara ']) ? $_POST['estimasi_tawara '] : null;
        $catatan = !empty($_POST['catatan']) ? $_POST['catatan'] : null;

        if (insertNegosiasi($conn, $id_penawaran, $jenis_negosiasi, $harga_tawaran, $estimasi_tawaran, $catatan)) {
            if(updateStatusPenawaran($conn, 2, $id_penawaran)) {
                if(updateStatusPesanan($conn, $no_pesanan, 3)) {
                    echo '<script>Swal.fire({
                        title: "Berhasil!",
                        text: "Pengajuan negosiasi sukses dikirim. Harap menunggu surat terbaru dari kami. Terima kasih",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "./";
                        }
                    });</script>';
                } else {
                    die('Gagal update status pesanan :(');
                }
            } else {
                die('Gagal update status penawaran :(');
            }
        } else {
            die('Gagal membuat negosiasi :(');
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
                            <th style="width: 10%;">No Pesanan</th>
                            <th style="width: 15%;">Status Penawaran</th>
                            <th style="width: 15%;">Tanggal Terbit</th>
                            <th>Surat Penawaran</th>
                            <th style="width: 20%;">Aksi</th>
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
                                <td>
                                    <iframe src="../../../uploads/penawaran/<?= $row['surat_penawaran'] ?>" frameborder="0" width="100%"></iframe>
                                    <button onclick="download('../../../uploads/penawaran/<?= $row['surat_penawaran'] ?>')">
                                        <i class="fas fa-download"></i> Unduh Surat
                                    </button>
                                </td>
                                <td class="action <?= $row['status_penawaran'] == 'Disetujui' ? 'offer-agree' : ($row['status_penawaran'] == 'Negosiasi' ? 'offer-nego' : '') ?>">
                                    <?php if ($row['status_penawaran'] == 'Disetujui') : ?>
                                        <i class="fas fa-check"></i> Penawaran Disetujui
                                    <?php elseif ($row['status_penawaran'] == 'Negosiasi') : ?>
                                        <i class="fas fa-clock"></i> Penawaran Dalam Proses Negosiasi
                                    <?php else : ?>
                                        <button class="agree" data-id="<?= $row['id_penawaran'] ?>" data-nomor="<?= $row['nomor_pesanan'] ?>">
                                            <i class="fas fa-check"></i> Setuju
                                        </button>
                                        <button type="button" class="warning nego" data-no="<?= $row['no_pesanan'] ?>" onclick="modalAktif('<?= $row['nomor_pesanan'] ?>','<?= $row['id_penawaran'] ?>','<?= $row['no_pesanan'] ?>')">
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
                    <form action="./" method="POST" class="wrapper">
                        <h1>Ajukan Negosiasi</h1>
                        <input type="hidden" name="no_pesanan" id="no_pesanan">
                        <input type="hidden" name="id_penawaran" id="id_penawaran">
                        <div class="input-box">
                            <input type="text" name="nomor" id="nomor" disabled>
                        </div>
                        <div class="input-box">
                            <select name="jenis_negosiasi" id="jenis_negosiasi" onchange="inputNego()">
                                <option value="" selected hidden>Pilih Jenis Negosiasi</option>
                                <option value="Harga">Harga</option>
                                <option value="Estimasi">Estimasi</option>
                                <option value="Harga & Estimasi">Harga & Estimasi</option>
                                <option value="Lainnya">Lainnya (tulis di catatan)</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <input type="number" name="harga_tawaran" id="harga" placeholder="Harga Tawaran (Isi dengan angka)" style="display: none;">
                        </div>
                        <div class="input-box">
                            <input type="text" name="estimasi_tawaran" id="estimasi" placeholder="Estimasi Tawaran" style="display: none;">
                        </div>
                        <div class="input-box">
                            <textarea name="catatan" id="catatan" placeholder="Tambah Catatan (Opsional)" style="display: none;"></textarea>
                        </div>
                        <button class="button kirim" type="submit" name="negosiasi">Kirim</button>
                        <button class="button hapus" type="button" onclick="modalNonaktif()">Batal</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script src="../../../assets/js/main.js"></script>
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
        function modalAktif(nomor, idPenawaran, noPesanan) {
            document.getElementById('nomor').value = nomor;
            document.getElementById('id_penawaran').value = idPenawaran;
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
            const idPenawaran = agree.dataset.id;
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
                        window.location.href = './?no=' + encodeURIComponent(idPenawaran);
                    }
                });
            });
        });

        function inputNego() {
            const jenis = document.getElementById('jenis_negosiasi').value;
            const harga = document.getElementById('harga');
            const estimasi = document.getElementById('estimasi');
            const catatan = document.getElementById('catatan');

            harga.style.display = 'none';
            estimasi.style.display = 'none';
            catatan.style.display = 'none';

            if (jenis === 'Harga') {
                harga.style.display = 'block';
                catatan.style.display = 'block';
            } else if (jenis === 'Estimasi') {
                estimasi.style.display = 'block';
                catatan.style.display = 'block';
            } else if (jenis === 'Lainnya') {
                catatan.style.display = 'block';
            } else if (jenis === 'Harga & Estimasi') {
                harga.style.display = 'block';
                estimasi.style.display = 'block';
                catatan.style.display = 'block';
            }
        }
    </script>
</body>

</html>