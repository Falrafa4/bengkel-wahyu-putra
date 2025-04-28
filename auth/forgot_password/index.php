<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
    $pesan = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
                
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">

    <title>Lupa Password - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    <main>
        <form action="./" method="post">
            <h2>Lupa Password</h2>
            <p style="margin: 20px 0px 10px 0px">Masukkan email Anda:</p>
            <em><?= $pesan ?></em>

            <div class="input-box">
                <span><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off"><br>
            </div>

            <a href="../login/" class="forgot-pass">Ingat Password?</a>
            <button type="submit" name="masuk">Lanjut</button>
        </form>
    </main>

    <script src="../../assets/js/main.js"></script>
</body>
</html>