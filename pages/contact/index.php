<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/contact.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

    <title>Contact Us - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>CONTACT US</h1><hr>
        <p>Kami siap membantu Anda! Hubungi kami untuk informasi lebih lanjut atau pemesanan jasa.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <div class="contact-page">
            <div class="contact-form">
                <form action="" method="GET">
                    <h2>Kirimkan Pesan Kepada Kami!</h2>
                    <p>Ada pertanyaan atau saran? Isi formulir di bawah, dan kami akan segera merespons pesan Anda.</p>
        
                    <input type="text" name="nama" id="nama" placeholder="Nama" required> <br><br>
                    <input type="email" name="email" id="email" placeholder="Email Anda" required><br><br>
                    <input type="tel" name="telp" id="telp" placeholder="Nomor Telepon" required><br><br>
                    <textarea name="pesan" id="pesan" placeholder="Pesan" required></textarea><br>
                    <input type="submit" value="Kirim Pesan">
                </form>
            </div>
    
            <section class="contact-info">
                <h2>Informasi Kontak</h2>
                <div class="contact-info-desc">
                    <div class="alamat">
                        <i class="fas fa-location-dot"></i>
                        <p style="margin-left: 15px;">Jalan Tropodo I Surya Citra Residence Blok J No. 3 Waru - Sidoarjo 61256</p>
                    </div>
                    <div class="jam">
                        <i class="fas fa-clock"></i>
                        <ul>
                            <li style="margin-left: 30px;">Offline (Senin - Sabtu): 08.00 - 20.00</li>
                            <li style="margin-left: 30px;">Online: 24 Jam</li>
                        </ul>
                    </div>
                    <div class="telepon">
                        <i class="fab fa-whatsapp" style="font-size: 30px;"></i>
                        <p style="margin-left: 10px;">+62812-1697-7427</p>
                    </div>
                    <div class="email">
                        <i class="fas fa-envelope"></i>
                        <p style="margin-left: 15px; margin-bottom: 20px;">jasabengkelwahyuputra @gmail.com</p>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3956.9229216010476!2d112.75263899999999!3d-7.362537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMjEnNDUuMSJTIDExMsKwNDUnMDkuNSJF!5e0!3m2!1sid!2sid!4v1736156936642!5m2!1sid!2sid" width="550" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
        </div>
    </main>

    <!-- FOOTER -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php"; ?>
    <!-- FOOTER END -->
    <script src="../../assets/js/main.js"></script>
</body>
</html>