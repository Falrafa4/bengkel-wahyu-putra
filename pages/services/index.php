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
        <h1>OUR SERVICES</h1><hr>
        <p>Kami siap melayani pemesanan Anda kapanpun dan di manapun.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <!-- DAFTAR LAYANAN -->
        <h1>Daftar Layanan Kami</h1><hr>
        <p class="main-desc">Berikut adalah daftar layanan yang kami sediakan untuk Anda.</p>

        <div class="container-layanan">
            <section class="bubut">
                <div class="layanan-header">
                    <img src="../../assets/img/machineh-2.jpg" alt="product-edm-2">
                </div>
                <div class="layanan-description">
                    <h2>Jasa Pengerjaan Bubut</h2><hr style="margin-top: 15px; width: 80px">
                    <p>Layanan bubut kami mencakup pembuatan benda-benda, sparepart, dan alat yang bundar. Kami menggunakan mesin bubut berkualitas untuk menghasilkan produk yang berkualitas pula.</p>
                    <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a>
                </div>
            </section>
            <section class="milling">
                <div class="layanan-header">
                    <img src="../../assets/img/machineh-1.jpg" alt="product-moulding">
                </div>
                <div class="layanan-description">
                    <h2>Jasa Pengerjaan Milling</h2><hr style="margin-top: 15px; width: 80px">
                    <p>Milling adalah proses pemesinan yang digunakan untuk membentuk benda kerja dengan presisi tinggi, terutama pada material berbentuk kotak atau persegi panjang.</p>
                    <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a>
                </div>
            </section>
        </div>
        <section class="edm">
            <div class="edm-header">
                <img src="../../assets/img/bengkel-2.jpg" alt="product-sparepart">
            </div>
            <div class="edm-description">
                <h2>Jasa Pengerjaan EDM</h2><hr style="margin: 15px 0px; border: 1px solid #ffffff; width: 80px">
                <p>Electric Discharge Machine (EDM) adalah teknik pemesinan presisi tinggi yang menggunakan percikan listrik untuk membentuk material. Proses ini cocok untuk membuat tulisan, logo, dan bentuk khusus seperti kunci L, baik yang tembus maupun tidak. Selain itu, EDM dapat menghasilkan pola garis, tekstur doff, serta detail halus yang sulit dicapai dengan metode konvensional.</p>
                <a href="../../dashboard/" class="white-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <!-- DAFTAR LAYANAN END -->
    </main>

    <!-- FOOTER -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php" ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>