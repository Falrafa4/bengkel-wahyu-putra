<!-- HOME FROM ANYTHING -->
<!-- FIRST TIME VISITED BY USER -->
<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="shortcut icon" href="assets/img/logo-wp-circle.png">
    <title>Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once "includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <div class="slideshow">
            <div class="wrapper">
                <img src="assets/img/machineh-2.jpg" alt="slide-1">
                <img src="assets/img/machineh-1.jpg" alt="slide-2">
                <img src="assets/img/bengkel-2.jpg" alt="slide-3">
                <img src="assets/img/bengkel-4.jpg" alt="slide-4">
            </div>
        </div>
        <h1>BENGKEL<br>WAHYU PUTRA</h1>
        <hr>
        <p>Jasa Bubut, EDM, Milling, Sparepart, Dan lain-lain</p>
        <p>Kami Memberikan Kualitas yang Terbaik untuk Kebutuhan Anda</p>
        <div class="header-nav">
            <a href="pages/services/" class="nav-layanan">Info Detail</a>
            <a href="pages/contact/" class="nav-hubungi">Hubungi Kami</a>
        </div>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <section class="unggul">
            <h1>Mengapa Harus Bengkel Kami?</h1>
            <div class="unggul-card">
                <section class="card">
                    <i class="fas fa-clock"></i>
                    <h3>Fast Respon</h3>
                    <p>Kami selalu bersedia serta tanggap setiap saat ketika dihubungi.</p>
                </section>
                <section class="card">
                    <i class="fas fa-truck-fast"></i>
                    <h3>Siap Ambil dan Antar</h3>
                    <p>Kami menyediakan service tambahan bila perlu untuk mengambil dan/atau mengantarkan pesanan.</p>
                </section>
                <section class="card">
                    <i class="fas fa-square-check"></i>
                    <h3>Cepat dan Andal</h3>
                    <p>Kami mampu mengerjakan desain-desain mulai dari yang dasar hingga yang kompleks dan rumit.</p>
                </section>
            </div>
        </section>

        <section class="quote">
            <div class="quote-fill">
                <p>"Bekerjalah seakan-akan kalian hidup terus. Dan jangan lupa ibadah seakan-akan esuk tiada..."</p><br>
                <strong>Mu'anam</strong>
                <p>Owner Bengkel Wahyu Putra</p>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once "includes/global/footer.php"; ?>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>