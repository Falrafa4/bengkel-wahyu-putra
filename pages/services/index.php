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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

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

        <div class="card-row">
            <section class="card">
                <div class="layanan-header">
                    <img src="../../assets/img/product-2.jpg" alt="Jasa Perbaikan">
                </div>
                <div class="layanan-desc">
                    <h2>Jasa Perbaikan</h2>
                    <hr style="margin-top: 15px; width: 80px">
                    <p>Kami melayani perbaikan material, perbaikan cetakan yang rusak, serta modifikasi unit atau komponen sesuai kebutuhan Anda. Baik itu penambahan, pengurangan, maupun penyesuaian bentuk dan fungsi.</p>
                    <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a>
                </div>
            </section>
            <section class="card">
                <div class="layanan-header">
                    <img src="../../assets/img/product-matras-2.jpg" alt="Jasa Pembuatan Baru">
                </div>
                <div class="layanan-desc">
                    <h2>Jasa Pembuatan Baru</h2>
                    <hr style="margin-top: 15px; width: 80px">
                    <p>Kami menerima pesanan pembuatan barang baru sesuai kebutuhan Anda, mulai dari cetakan atau matras, logo emboss timbul maupun cekung, sparepart mesin, hingga berbagai komponen lainnya yang berkaitan dengan logam maupun nonlogam.</p>
                    <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a>
                </div>
            </section>
        </div>

        <h1>Daftar Mesin Kami</h1>
        <hr>
        <p class="main-desc">Mesin berguna sebagai alat dan penunjang dalam mengeksekusi pesanan Anda dengan kualitas tinggi.</p>

        <div class="card-row">
            <section class="card">
                <div class="layanan-header">
                    <img src="../../assets/img/machineh-2.jpg" alt="product-edm-2">
                </div>
                <div class="layanan-desc">
                    <h2>Mesin Bubut</h2>
                    <hr style="margin-top: 15px; width: 80px">
                    <p>Layanan bubut kami mencakup pembuatan benda-benda, sparepart, dan alat yang bundar. Kami menggunakan mesin bubut berkualitas untuk menghasilkan produk yang berkualitas pula.</p>
                    <!-- <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a> -->
                </div>
            </section>
            <section class="card">
                <div class="layanan-header">
                    <img src="../../assets/img/machineh-1.jpg" alt="product-edm-2">
                </div>
                <div class="layanan-desc">
                    <h2>Mesin Frais/Milling</h2>
                    <hr style="margin-top: 15px; width: 80px">
                    <p>Milling adalah proses pemesinan yang digunakan untuk membentuk benda kerja dengan presisi tinggi, terutama pada material berbentuk kotak atau persegi panjang.</p>
                    <!-- <a href="../../dashboard/" class="black-btn btn">Pesan Sekarang</a> -->
                </div>
            </section>
        </div>
        <section class="card-full">
            <div class="card-full-header">
                <img src="../../assets/img/bengkel-2.jpg" alt="product-sparepart">
            </div>
            <div class="card-full-desc">
                <h2>Mesin EDM</h2>
                <hr style="margin: 15px 0px; border: 1px solid #ffffff; width: 80px">
                <p>Electric Discharge Machine (EDM) adalah teknik pemesinan presisi tinggi yang menggunakan percikan listrik untuk membentuk material. Proses ini cocok untuk membuat tulisan, logo, dan bentuk khusus seperti kunci L, baik yang tembus maupun tidak. Selain itu, EDM dapat menghasilkan pola garis, tekstur doff, serta detail halus yang sulit dicapai dengan metode konvensional.</p>
                <!-- <a href="../../dashboard/" class="white-btn btn">Pesan Sekarang</a> -->
            </div>
        </section>

        <!-- DAFTAR LAYANAN END -->
    </main>

    <!-- FOOTER -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php" ?>
    <!-- FOOTER END -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>