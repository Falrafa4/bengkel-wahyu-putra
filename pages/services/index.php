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
    <?php include "../../includes/nav.php" ?>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>OUR SERVICES</h1><hr>
        <p>Kami siap melayani pemesanan anda kapanpun dan di manapun.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <!-- DAFTAR LAYANAN -->
        <h1>Daftar Layanan Kami</h1><hr>
        <p class="main-desc">Ada banyak sekali jenis layanan yang kami terima. Di antaranya adalah sebagai berikut.</p>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/product-2.jpg" alt="product-edm-2">
            </div>
            <div class="layanan-description">
                <h2>Jasa EDM</h2>
                <p>Pertama dan yang utama, Kami menyediakan jasa EDM sesuai kebutuhan Anda. Pesanan dapat disesuaikan dengan keinginan dan spesifikasi yang Anda butuhkan.</p>
                <p>Electric Discharge Machine (EDM) adalah mesin yang memanfaatkan arus listrik untuk memotong atau membentuk benda. Cara kerjanya menggunakan ampere strom dengan mendekatkan katoda ke anoda, Sehingga dapat membentuk benda yang kita inginkan dan didinginkan dengan minyak tertentu.</p>
                <a href="<?php if(isset($_SESSION['data'])) {echo '../../auth/dashboard/user.php';} else {echo '../../auth/login/';} ?>" class="black-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/product-matras-1.jpg" alt="product-moulding">
            </div>
            <div class="layanan-description">
                <h2>Matras / Cetakan</h2>
                <p>Matras, atau yang biasa disebut cetakan, adalah alat yang digunakan untuk mencetak sesuatu sesuai dengan bentuk yang telah ditentukan. Kami menyediakan jasa pembuatan cetakan matras dengan bahan berkualitas untuk hasil terbaik.</p>
                <a href="../wip.html" class="white-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/sparepart-product.jpg" alt="product-sparepart">
            </div>
            <div class="layanan-description">
                <h2>Sparepart</h2>
                <p>Sparepart adalah suatu barang yang mengandung berbagai komponen dalam satu kesatuan dan memiliki fungsi tertentu. Sparepart banyak sekali digunakan pada berbagai jenis kendaraan, sehingga jenisnya sangat beragam.</p>
                <a href="../wip.html" class="black-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/moulding-product.jpg" alt="product-moulding">
            </div>
            <div class="layanan-description">
                <h2>Moulding</h2>
                <p>Moulding adalah proses pembuatan dengan membentuk bahan baku cair atau lentur dengan menggunakan bingkai kaku yang di sebut cetakan. Saat ini, kami melayani jasa moulding plastik dan karet.</p>
                <a href="../wip.html" class="white-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/plong-logam-product.jpg" alt="product-plong-logam">
            </div>
            <div class="layanan-description">
                <h2>Plong Logam</h2>
                <p>Plong Logam adalah proses pemotongan atau pelubangan logam menggunakan mesin khusus.</p>
                <a href="../wip.html" class="black-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <section class="layanan">
            <div class="layanan-header">
                <img src="../../assets/img/logo-emboss-product.jpg" alt="product-logo-emboss">
            </div>
            <div class="layanan-description">
                <h2>Logo Emboss</h2>
                <p>Emboss adalah teknik finishing yang membuat permukaan cetak tampak timbul, memberikan kesan elegan. Bengkel kami melayani jasa emboss, khususnya untuk logo, dengan hasil presisi dan berkualitas tinggi untuk kebutuhan branding Anda.</p>
                <a href="../wip.html" class="white-btn btn">Pesan Sekarang</a>
            </div>
        </section>
        <!-- DAFTAR LAYANAN END -->

        <!-- Layanan Lainnya -->
        <section class="other">
            <h1>Lainnya Dari Kami</h1><hr>
            <div class="card-container">
                <div class="other-card">
                    <h3>Service Matras/Cetakan</h3>
                    <p>Selain pembuatan matras, kami juga melayani perbaikan matras yang rusak atau perlu diperbaiki.</p>
                </div>
                <div class="other-card">
                    <h3>Service Sparepart</h3>
                    <p>Sparepart Anda rusak? Perlu diperbaiki? Kami melayani perbaikan sparepart Anda.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include "../../includes/footer.php" ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>