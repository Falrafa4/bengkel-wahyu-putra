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
                <h1>Data Penawaran</h1>
                <p>Berisi surat penawaran dari pemilik bengkel.</p><br>
                <hr>
                <a href="kelola/" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>
        
                <?php if(isset($_SESSION['eksekusi'])) {?>
                <div class="success-update">
                    <em><?= $_SESSION['eksekusi'] ?></em>
                    <i class="fas fa-close" onclick="closeAlert()"></i>
                </div>
                <?php unset($_SESSION['eksekusi']); }
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
                        <th>Tgl Penawaran</th>
                        <th>Status Penawaran</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while($result = mysqli_fetch_assoc($sql)){?>
                    <tr>
                        <td><?= $result['id_penawaran'] ?></td>
                        <td><?= $result['no_pesanan'] ?></td>
                        <td><iframe src="../../../uploads/penawaran/<?= $result['surat_penawaran'] ?>"></iframe></td>
                        <td><?= $result['tgl_penawaran'] ?></td>
                        <td><?= $result['status_penawaran'] ?></td>
                        <td class="action">
                            <a href="" class="btn edit"><i class="fas fa-pen-to-square"></i></a>
                            <a href="" class="btn hapus"><i class="fas fa-trash"></i></a>
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