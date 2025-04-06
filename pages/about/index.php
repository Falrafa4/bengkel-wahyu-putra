<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/about.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    <title>About Us - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>ABOUT US</h1><hr>
        <p>Kami berkomitmen dalam mengerjakan setiap pesanan yang hadir.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <section class="pengertian">
            <p><strong>Bengkel Wahyu Putra</strong> adalah bengkel yang berlokasi di Desa Tropodo, Waru, Sidoarjo, dan bergerak di bidang jasa bubut. Kami menyediakan berbagai layanan seperti pembuatan sparepart, bubut frais, EDM bandsaw, moulding, pembuatan logo emboss, dan lainnya. Dengan pengalaman yang terus bertambah dari waktu ke waktu, kami telah melayani berbagai macam pesanan dengan dedikasi dan profesionalisme.</p>
        </section>

        <section class="sejarah">
            <h1>Timeline Kami</h1><hr>
            <p>Sejak tahun 2018, Bengkel Wahyu Putra melayani kebutuhan Anda.</p>

            <div class="sejarah-card">
                <div class="card-a">
                    <i class="fas fa-industry"></i>
                    <h3>2018</h3>
                    <p>Kami berdiri pada akhir tahun 2018 sebagai bengkel kecil yang membuka jasa bubut di Tropodo, Waru, Sidoarjo.</p>
                </div>
                <div class="card-b">
                    <i class="fas fa-gear"></i>
                    <h3>2024-Sekarang</h3>
                    <p>Kami terus dipercaya oleh pelanggan untuk mengerjakan pesanan mereka. Dengan demikian, kami telah mengumpulkan banyak pengalaman dalam melayani setiap pesanan.</p>
                </div>
            </div>
        </section>

        <section class="owner">
            <div class="owner-gradient">
                <div class="profile">
                    <h1>Profil Pemilik<br>Bengkel Wahyu Putra</h1><hr>
                    <p>"Perkenalkan, nama saya Mu'anam, pemilik Bengkel Wahyu Putra yang telah berdiri sejak akhir tahun 2018. Kami bergerak di bidang jasa pembuatan matras/moulding untuk plastik, karet, plat/plong, serta pembuatan sparepart mesin, logo emboss dan berbagai kebutuhan lainnya."</p>
                    <cite>- Mu'anam</cite>
                    <cite>Owner Bengkel Wahyu Putra</cite>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php"; ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>