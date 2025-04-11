<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/services.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    <title>Services - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>OUR SERVICES</h1>
        <hr>
        <p>Kami siap melayani pemesanan Anda kapanpun dan di manapun.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <!-- DAFTAR LAYANAN -->
        <h1>Daftar Layanan Kami</h1>
        <hr>
        <div id="bubut"></div>
        <div id="milling"></div>
        <p class="main-desc">Berikut adalah daftar layanan yang kami sediakan untuk Anda.</p>
        <?php
        require_once "../../includes/global/koneksi.php";
        $result = mysqli_query($conn, "SELECT * FROM service");
        $layanan = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $layanan[] = $row;
        }

        $total = count($layanan);

        for ($i = 0; $i < $total; $i++) {
            if ($i == $total - 1 && $total % 2 == 1) { ?>
                <section class="card-full">
                    <div class="card-full-header">
                        <img src="../../assets/img/<?= $layanan[$i]['nama_gambar'] ?>" alt="product-sparepart">
                    </div>
                    <div class="card-full-desc">
                        <h2>Jasa Pengerjaan <?= $layanan[$i]['nama_service'] ?></h2>
                        <hr style="margin: 15px 0px; border: 1px solid #ffffff; width: 80px">
                        <p><?= $layanan[$i]['deskripsi'] ?></p>
                        <a href="../../dashboard/" class="white-btn btn">Pesan Sekarang</a>
                    </div>
                </section>
            <?php   } else {
                if ($i % 2 == 0) echo '<div class="card-row">';
            ?>
                <section class="card">
                    <div class="layanan-header">
                        <img src="../../assets/img/<?= $layanan[$i]['nama_gambar'] ?>" alt="product-edm-2">
                    </div>
                    <div class="layanan-desc">
                        <h2>Jasa Pengerjaan <?= $layanan[$i]['nama_service'] ?></h2>
                        <hr style="margin-top: 15px; width: 80px">
                        <p><?= $layanan[$i]['deskripsi'] ?></p>
                        <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a>
                    </div>
                </section>
        <?php if ($i % 2 != 0) echo '</div>';
            }
        } ?>
        <!-- DAFTAR LAYANAN END -->
    </main>

    <!-- FOOTER -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php" ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>