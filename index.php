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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="shortcut icon" href="assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

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
                    <h2>Fast Respon</h2>
                    <p>Kami selalu bersedia serta tanggap setiap saat ketika dihubungi.</p>
                </section>
                <section class="card">
                    <i class="fas fa-truck-fast"></i>
                    <h2>Siap Antar ke Lokasi</h2>
                    <p>Kami menyediakan service tambahan bila perlu untuk mengantarkan pesanan.</p>
                </section>
                <section class="card">
                    <i class="fas fa-square-check"></i>
                    <h2>Cepat dan Andal</h2>
                    <p>Kami mampu mengerjakan desain-desain mulai dari yang dasar hingga yang kompleks dan rumit.</p>
                </section>
            </div>
        </section>

        <section class="layanan">
            <h1>Layanan Kami</h1>
            <div class="roll">
                <div class="wrapper-roll">
                    <div class="image-roll perbaikan">
                        <img src="assets/img/product-2.jpg" alt="Jasa Perbaikan">
                        <div class="roll-desc">
                            <h3>Jasa Perbaikan</h3>
                            <p>Layanan Perbaikan kami mencakup...... <a href="pages/services/#bubut">Lihat Selengkapnya</a></p>
                        </div>
                    </div>
                    <div class="image-roll produksi">
                        <img src="assets/img/product-matras-2.jpg" alt="Jasa Produksi Baru">
                        <div class="roll-desc">
                            <h3>Jasa Produksi Baru</h3>
                            <p>Layanan Produksi Baru kami mencakup...... <a href="pages/services/#bubut">Lihat Selengkapnya</a></p>
                        </div>
                    </div>
                </div>
                <i class="fas fa-chevron-left"></i>
                <i class="fas fa-chevron-right"></i>
            </div>
        </section>

        <section class="alur">
            <h1>Alur Pemesanan</h1>
            <div class="alur-card">
                <section class="card">
                    <i class="fas fa-user-plus"></i>
                    <h2>Daftar dan Login</h2>
                    <p>Buat akun baru atau login ke akun Bengkel Wahyu Putra Anda. Anda akan memiliki akses ke akun Anda.</p>
                </section>
                <section class="card">
                    <i class="fas fa-file-lines"></i>
                    <h2>Buat Pesanan</h2>
                    <p>Setelah masuk ke akun Bengkel Wahyu Putra Anda, silahkan buat pesanan sesuai dengan kebutuhan.</p>
                </section>
                <section class="card">
                    <i class="fas fa-gear"></i>
                    <h2>Pesanan Dikerjakan</h2>
                    <p>Anda akan menerima surat penawaran di bagian Penawaran. Jika setuju, maka pesanan Anda segera dikerjakan.</p>
                </section>
            </div>
        </section>

        <section class="quote">
            <div class="quote-fill">
                <p>"Bekerjalah seakan-akan kalian hidup terus. Dan jangan lupa ibadah seakan-akan esuk tiada..."</p><br>
                <strong>Mu'anam</strong>
                <p>Pemilik Bengkel Wahyu Putra</p>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php require_once "includes/global/footer.php"; ?>
    <!-- FOOTER END -->
    <!-- <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script> -->
    <script src="assets/js/main.js"></script>
    <script>
        const right = document.querySelector('.fa-chevron-right');
        const left = document.querySelector('.fa-chevron-left');

        const perbaikan = document.querySelector('.perbaikan');
        const produksi = document.querySelector('.produksi');
        // const edm = document.querySelector('.edm');
        
        // const zIndexEdm = window.getComputedStyle(edm).zIndex;
        
        right.addEventListener("click", function(){
            const zIndexPerbaikan = window.getComputedStyle(perbaikan).zIndex;
            const zIndexProduksi = window.getComputedStyle(produksi).zIndex;

            if(zIndexPerbaikan === "1") {
                perbaikan.style.zIndex = '-1';
                produksi.style.zIndex = '1';
                // edm.style.zIndex = '-1';
            } 
            else if(zIndexProduksi === "1") {
                perbaikan.style.zIndex = '1';
                produksi.style.zIndex = '-1';
                // edm.style.zIndex = '1';
            }
        })

        left.addEventListener("click", function(){
            const zIndexPerbaikan = window.getComputedStyle(perbaikan).zIndex;
            const zIndexProduksi = window.getComputedStyle(produksi).zIndex;

            if(zIndexPerbaikan === "1") {
                perbaikan.style.zIndex = '-1';
                produksi.style.zIndex = '1';
                console.log('keubah');
                // edm.style.zIndex = '1';
            } 
            else if(zIndexProduksi === "1") {
                perbaikan.style.zIndex = '1';
                produksi.style.zIndex = '-1';
                // edm.style.zIndex = '-1';
            }
        })
    </script>
</body>
</html>