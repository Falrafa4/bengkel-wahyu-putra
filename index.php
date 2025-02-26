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
    <nav>
        <div class="logo">
            <a href="#"><img src="assets/img/logo-wp-circle.png" alt="logo"></a>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="pages/services/">Services</a></li>
                <li><a href="pages/gallery/">Gallery</a></li>
                <li><a href="pages/contact/">Contact</a></li>
                <li><a href="pages/about/">About</a></li>
            </ul>
        </div>
        <div class="right-bar">
            <ul>
            <?php if(!isset($_SESSION['data'])){ ?>
                <li><a href="auth/login/" class="login <?= ($namaFolder == "login") ? 'active' : '' ?>">Login</a></li>
            <?php } else {?>
            <li>
                <i class="fas fa-user-circle"></i>
                <span><?= $_SESSION['data']['username']; ?></span>
                <div class="dropdown">
                    <ul>
                        <li><a href="auth/dashboard/<?= ($_SESSION['data']['role'] == 'Admin' ? 'admin.php' : 'user.php') ?>">Dashboard</a></li>
                        <li><a href="auth/logout.php">Logout</a></li>
                    </ul>
                </div>
            </li>
            <?php } ?>
            </ul>
        </div>


        <!-- sidebar -->
        <a id="toggleSideBar" onclick="toggleClick()"><i class="fas fa-bars"></i></a>
        <div class="ham-bar">
            <a href="#" class="active">Home</a>
            <a href="pages/services/">Services</a>
            <a href="pages/gallery/">Gallery</a>
            <a href="pages/contact/">Contact</a>
            <a href="pages/about/">About</a>
            <a href="auth/login/">Login</a>
        </div>
    </nav>
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
    <footer>
        <section class="footer-top">
            <div class="footer-logo">
                <img src="assets/img/logo-wp-circle.png" alt="">
                <p>Bengkel Wahyu Putra</p>
                <p>Jl. Tropodo I Surya Citra Residence Blok J No.3 Waru - Sidoarjo 61256</p>
            </div>
            <div class="footer-nav">
                <p>Lihat Juga</p>
                <a href="pages/services/">Layanan Kami</a>
                <a href="pages/about/">Tentang Kami</a>
                <a href="pages/gallery/">Galeri Kerja</a>
                <a href="wip.php">Informasi Lowongan</a>
            </div>
        </section>
        <section class="footer-bottom">
            <p>&copy; 2024 Bengkel Wahyu Putra. All Rights Reserved</p>
            <div class="footer-sosmed">
                <a href="mailto:jasabengkelwahyuputra@gmail.com"><i class="fas fa-envelope"></i></a>
                <a href="http://wa.me/6281216977427"><i class="fab fa-square-whatsapp"></i></a>
                <a href="#"><i class="fab fa-square-facebook"></i></a>
                <a href="#"><i class="fab fa-square-instagram"></i></a>
            </div>
        </section>
    </footer>
    <!-- FOOTER END -->
    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>