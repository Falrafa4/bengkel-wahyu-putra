<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/gallery.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

    <title>Gallery - Bengkel Wahyu Putra</title>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>

    <!-- HEADER & BG FOTO -->
    <header>
        <h1>GALLERY KAMI</h1><hr>
        <p>Berikut ini adalah galeri dari bengkel kami. Temukan hasil kerja terbaik dari kami untuk Anda.</p>
    </header>
    <!-- HEADER & BG FOTO END -->

    <main>
        <div class="full-img" id="fullImgBox">
            <img src="../assets/img/machineh-1.jpg" alt="mesin1" id="fullImg">
            <i class="fa-solid fa-xmark" onclick="closeFullImg()"></i>
        </div>
        <div class="gallery">
            <img src="../../assets/img/machineh-1.jpg" alt="mesin1" onclick="openFullImg(this.src)">
            <img src="../../assets/img/machineh-2.jpg" alt="mesin2" onclick="openFullImg(this.src)">
            <img src="../../assets/img/machineh-3.jpg" alt="mesin3" onclick="openFullImg(this.src)">
            <img src="../../assets/img/machineh-4.jpg" alt="mesin4" onclick="openFullImg(this.src)">
            <img src="../../assets/img/logo-emboss-product.jpg" alt="logo-emboss" onclick="openFullImg(this.src)">
            <img src="../../assets/img/product-1.jpg" alt="product1" onclick="openFullImg(this.src)">
            <img src="../../assets/img/product-2.jpg" alt="product2" onclick="openFullImg(this.src)">
            <img src="../../assets/img/product-3.jpg" alt="product3" onclick="openFullImg(this.src)">
            <img src="../../assets/img/bengkel-2.jpg" alt="bengkel1" onclick="openFullImg(this.src)">
            <img src="../../assets/img/bengkel-5.jpg" alt="bengkel1" onclick="openFullImg(this.src)">
            <img src="../../assets/img/product-matras-1.jpg" alt="" onclick="openFullImg(this.src)">
            <img src="../../assets/img/product-matras-2.jpg" alt="" onclick="openFullImg(this.src)">
            <img src="../../assets/img/unknown-product.jpg" alt="" onclick="openFullImg(this.src)">
        </div>
    </main>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/footer.php"; ?>
    <script src="../../assets/js/main.js"></script>

    <script>
        let fullImgBox = document.getElementById('fullImgBox')
        let fullImg = document.getElementById('fullImg')

        function openFullImg(pic) {
            fullImgBox.style.display = 'flex';
            fullImg.src = pic;
        }

        function closeFullImg() {
            fullImgBox.style.display = 'none';
        }
    </script>
</body>
</html>