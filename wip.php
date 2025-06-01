<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="shortcut icon" href="assets/img/logo-wp-circle.png">
    <title>Work In Progress</title>
    <style>
        /* STYLE HEADER */
        header {
            background-image: url(assets/img/machineh-2.jpg);
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.66);
            background-blend-mode: darken;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position-y: -30vh;
            height: 50vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            color: #ffffff;
        }

        header h1 {
            font-size: 80px;
            line-height: 85px;
            font-family: "Oswald", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            letter-spacing: 5px;
        }

        header hr {
            margin: 5px auto 30px auto;
            width: 50%;
        }

        header a {
            margin: 0 10px;
            padding: 15px 30px;
            font-size: 0.9rem;
            color: white;
        }
        /* STYLE HEADER END */
        main {
            background-color: var(--secondary-color);
            height: 30vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        main a {
            font-size: 0.9rem;
            margin-top: 10px;
            background-color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 15px 25px;
            color: white;
            border-radius: 10px;
            transition: all .3s cubic-bezier(0.19, 1, 0.22, 1);
        }
        main a:hover {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <div class="logo">
            <a href="#"><img src="assets/img/logo-wp-circle.png" alt="logo-bengkel-wp"></a>
        </div>
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="services/">Services</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="contact/">Contact</a></li>
                <li><a href="about/">About</a></li>
                <li><a href="auth/login/">Login</a></li>
            </ul>
        </div>

        <!-- sidebar -->
        <a id="toggleSideBar" onclick="toggleClick()"><i class="fas fa-bars"></i></a>
        <div class="ham-bar">
                <a href="../">Home</a>
                <a href="services/">Services</a>
                <a href="#">Gallery</a>
                <a href="contact/">Contact</a>
                <a href="about/">About</a>
                <a href="auth/login/">Login</a>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>Work In Progress</h1><hr>
        <p>Sorry, this page is under construstion.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <p>Thank you for your coming. We will go back soon.</p>
        <a href="/bengkel-wahyu-putra">Go Back to Main Page</a>
    </main>

    <!-- FOOTER -->
    <footer>
        <hr>
        <section class="footer-top">
            <div class="footer-logo">
                <img src="assets/img/logo-wp-circle.png" alt="logo-bengkel-wp">
                <p>Bengkel Wahyu Putra</p>
                <p>Jl. Tropodo I Surya Citra Residence Blok J No.3 Waru - Sidoarjo 61256</p>
            </div>
            <div class="footer-nav">
                <p>Lihat Juga</p>
                <a href="services/">Layanan Kami</a>
                <a href="about/">Tentang Kami</a>
                <a href="#">Galeri Kerja</a>
                <a href="#">Informasi Lowongan</a>
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