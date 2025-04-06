<?php 
    //inisialisasi session
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

    $id_pelanggan = '';
    $nama_pelanggan = '';
    $email = '';
    $no_telp = '';
    $jenis_akun = '';

    if(isset($_SESSION['data'])) {
        $id_pelanggan = $_SESSION['data']['id_pelanggan'];
        $nama_pelanggan = $_SESSION['data']['nama_pelanggan'];
        $email = $_SESSION['data']['email'];
        $no_telp = $_SESSION['data']['no_telp'];
        $jenis_akun = $_SESSION['data']['jenis_akun'];
    }

    // update profil
    if(isset($_POST['update_profil'])) {
        if(updateProfil($_POST, $conn)) {
            echo "<script>alert('Data Berhasil Diubah!'); location.href = './';</script>";
        } else {
            echo $sql;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../assets/img/logo-wp-circle.png">
    <title>Profil - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main class="settings">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>
        
        <section class="utama">
            <h1 class="settings-head">Pengaturan</h1>
            <form action="index.php" method="post">
                <table>
                    <tr>
                        <td><h1>Edit Profil</h1></td>
                        <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan ?>">
                    </tr>
                    <tr>
                        <td class="info">Nama Lengkap</td>
                        <td class="data"><input type="text" name="nama_pelanggan" value="<?= $nama_pelanggan?>"></td>
                    </tr>
                    <tr>
                        <td class="info">Email</td>
                        <td class="data"><input type="email" name="email" value="<?= $email?>"></td>
                    </tr>
                    <tr>
                        <td class="info">No. Telepon</td>
                        <td class="data"><input type="tel" name="no_telp" value="<?= $no_telp?>"></td>
                    </tr>
                    <tr>
                        <td class="info">Jenis Akun</td>
                        <td class="data">
                            <select name="jenis_akun">
                                <option value="Pribadi" <?php if($jenis_akun == "Pribadi") {echo "selected";} ?>>Pribadi</option>
                                <option value="Perusahaan" <?php if($jenis_akun == "Perusahaan") {echo "selected";} ?>>Perusahaan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="button"><button type="submit" name="update_profil"><i class="fas fa-pen-to-square"></i> Update Profil</button></td>
                    </tr>
                </table>
            </form>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
</body>
</html>