<?php 
    //inisialisasi session
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    <title>Admin - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="utama">
            <section class="welcome">
                <h1>Dashboard Admin</h1>
                <hr>
                <h3>Selamat Datang, <?php echo $_SESSION['data']['nama_pelanggan']; ?>!</h3>
                <p style="font-style: italic;">Halaman ini adalah halaman khusus para admin. Jika anda bukan admin, selamat Anda dapat membobol sistem kami :)</p><br>
            </section>
            <section class="informasi">
                <table>
                    <tr>
                        <td><h1>Informasi Admin</h1></td>
                    </tr>
                    <tr>
                        <td class="info">Nama Lengkap</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['nama_pelanggan']?></td>
                    </tr>
                    <tr>
                        <td class="info">Email</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['email']?></td>
                    </tr>
                    <tr>
                        <td class="info">No. Telepon</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['no_telp']?></td>
                    </tr>
                    <tr>
                        <td class="info">Jenis Akun</td>
                        <td>:</td>
                        <td class="data"><?= $_SESSION['data']['jenis_akun']?></td>
                    </tr>
                    <tr>
                        <td class="button"><a href="settings/"><i class="fas fa-pen-to-square"></i> Edit Profil</a></td>
                    </tr>
                </table>
            </section>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>