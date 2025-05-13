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

    <title>Pemesanan Item - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="container-crud">
            <section class="daftar-crud">
                <h1>Data Item</h1><hr>
                <a href="../pemesanan/kelola/" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>
        
                <?php if(isset($_SESSION['eksekusi'])) {?>
                <div class="success-update">
                    <em><?= $_SESSION['eksekusi'] ?></em>
                    <i class="fas fa-close" onclick="closeAlert()"></i>
                </div>
                <?php unset($_SESSION['eksekusi']); }
                ?>
        
                <?php 
                    $querySelect = "SELECT * FROM pemesanan_item";
                    $sql = mysqli_query($conn, $querySelect);
                ?>
        
                <table class="table-crud">
                    <tr>
                        <th>ID Item</th>
                        <th>No Pesanan</th>
                        <th>Nama Item</th>
                        <th style="width: 300px;">Desain Gambar</th>
                        <th>Material</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while($result = mysqli_fetch_assoc($sql)){?>
                    <tr>
                        <td style="text-align: center"><?= $result['id_item'] ?></td>
                        <td style="text-align: center"><?= $result['no_pesanan'] ?></td>
                        <td><?= $result['nama_item'] ?></td>
                        <td style="text-align: center">
                            <?php 
                            $desain_gambar = $result['desain_gambar'];
                            $split = explode('.', $desain_gambar);
                            $ekstensi = $split[count($split)-1];

                            if($ekstensi == 'pdf'):
                            ?>
                            <iframe src="../../../uploads/desain/<?= $result['desain_gambar'] ?>" width="100%" height="200px"></iframe>
                            <?php else : ?>
                            <img src="../../../uploads/desain/<?= $result['desain_gambar'] ?>" alt="" width="80%">
                            <?php endif ?>
                            <a class="button" href="../../../uploads/desain/<?= $result['desain_gambar'] ?>" download>Download</a>
                        </td>
                        <td><?php if($result['material'] == NULL) echo "-"; else echo $result['material']; ?></td>
                        <td><?= $result['jumlah_item'] ?></td>
                        <td class="action" style="text-align: center">
                            <a href="../pemesanan/kelola/" class="btn edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                            <!-- <a href="" class="btn hapus"><i class="fas fa-trash"></i></a> -->
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </section>
        </div>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>
</html>