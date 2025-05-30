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
                <h1>Negosiasi Penawaran</h1>
                <p>Negosiasi surat penawaran dari Pelanggan.</p><br>
                <hr>
                <!-- <a href="kelola/" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a> -->
        
                <?php if(isset($_SESSION['eksekusi'])) {?>
                <div class="success-update">    
                    <em><?= $_SESSION['eksekusi'] ?></em>
                    <i class="fas fa-close" onclick="closeAlert()"></i>
                </div>
                <?php unset($_SESSION['eksekusi']); }
                ?>
        
                <?php 
                    $querySelect = "SELECT ng.*, ps.no_pesanan  FROM negosiasi_penawaran ng
JOIN penawaran pw ON pw.id_penawaran = ng.id_penawaran
JOIN pemesanan ps ON ps.no_pesanan = pw.no_pesanan";
                    $sql = mysqli_query($conn, $querySelect);
                ?>
        
                <table class="table-crud">
                    <tr>
                        <th>No Pesanan</th>
                        <th>ID Penawaran</th>
                        <th>Waktu Negosiasi</th>
                        <th>Jenis Negosiasi</th>
                        <th>Harga Tawaran</th>
                        <th>Estimasi Tawaran</th>
                        <th>Catatan</th>
                        <th>Status Negosiasi</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while($result = mysqli_fetch_assoc($sql)){?>
                    <tr>
                        <td style="text-align: center;"><?= $result['no_pesanan'] ?></td>
                        <td style="text-align: center;"><?= $result['id_penawaran'] ?></td>
                        <td><?= $result['waktu_negosiasi'] ?></td>
                        <td><?= $result['jenis_negosiasi'] ?></td>  
                        <td><?= $result['harga_tawaran'] ?? '-' ?></td>
                        <td><?= $result['estimasi_tawaran'] ?? '-' ?></td>
                        <td><?= $result['catatan'] ?? '-' ?></td>
                        <td class="<?= $result['status_negosiasi'] == 'Negosiasi' ? 'row-yellow' : '' ?>"><?= $result['status_negosiasi'] ?></td>
                        <td class="action">
                            <a href="" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                            <a class="btn warning" style="display: block; width: fit-content;" onclick="modalAktif(<?= $result['no_pesanan'] ?>, <?= $result['id_penawaran'] ?>)"><i class="fas fa-envelope"></i> Buat Surat Baru</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(mysqli_num_rows($sql) == 0) { ?>
                        <tr >
                            <td colspan="8" style="text-align: center; padding: 40px 0px; font-style: italic;">Belum ada data</td>
                        </tr>
                    <?php } ?>
                </table>

                <!-- MODAL FORM -->
                <div class="modal" id="modal">
                    <div class="bg"></div>
                    <form action="./" method="POST" class="wrapper" enctype="multipart/form-data">
                        <h1>Upload Penawaran Baru</h1>
                        <input type="hidden" name="id_penawaran" id="id_penawaran">
                        <input type="hidden" readonly name="no_pesanan" id="no_pesanan">

                        <div class="input-box">
                            <label for="harga">Harga Baru</label>
                            <input type="number" name="harga" id="harga">
                        </div>
                        <div class="input-box">
                            <label for="surat_penawaran">Upload Surat Baru</label>
                            <input type="file" name="surat_penawaran" id="surat_penawaran" placeholder="Surat Penawaran" accept=".pdf, .jpg, .jpeg, .png">
                        </div>

                        <button class="button kirim" type="submit" name="negosiasi">Kirim</button>
                        <button class="button hapus" type="button" onclick="modalNonaktif()">Batal</button>
                    </form>
                </div>
            </section>
        </div>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
    <script>
        // untuk menampilkan modal
        function modalAktif(noPesanan, idPenawaran) {
            // document.getElementById('nomor').value = nomor;
            document.getElementById('no_pesanan').value = noPesanan;
            document.getElementById('id_penawaran').value = idPenawaran;
            document.getElementById('modal').style.display = 'flex';
        }

        // untuk menutup modal
        function modalNonaktif() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
</html>