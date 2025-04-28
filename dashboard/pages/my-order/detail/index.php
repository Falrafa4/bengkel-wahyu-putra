<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

    if(isset($_GET['detail'])) {
        $query = "SELECT * FROM ";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../../assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../assets/fontawesome/css/all.css">

    <title>Detail Pesanan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main class="detailPesanan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>
        
        <section class="utama">
            <div class="main-content">
                <h1>Detail Pesanan</h1>

                <a href="../">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

                <div class="informasi">
                    <h2 style="margin-bottom: 10px;">Informasi Pesanan</h2>
                    <div class="informasi-flex">
                        <div class="img-jasa">
                            <img src="../../../../assets/img/machineh-2.jpg" alt="Jasa">
                            <h1>Jasa Bubut</h1>
                        </div>
                        <table>
                            <tr>
                                <th>Jenis Layanan</th>
                                <td>Bubut</td>
                            </tr>
                            <tr>
                                <th>Nama Item</th>
                                <td>Item Termahal Se-dunia</td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td>Material rawan maling</td>
                            </tr>
                            <tr>
                                <th>Jumlah Item</th>
                                <td>Barang terbanyak</td>
                            </tr>
                            <tr>
                                <th>Waktu Pemesanan</th>
                                <td>09:00</td>
                            </tr>
                            <tr>
                                <th>Status Pesanan</th>
                                <td>Selesai</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="desain-alamat">
                    <div class="desain">
                        <h2>Desain Gambar</h2>
                        <iframe src="../../../../uploads/desain/test.pdf"></iframe>
                    </div>
                    <div class="alamat">
                        <h2>Alamat Lengkap</h2>
                        <table>
                            <tr>
                                <th>Nama Jalan</th>
                                <td>jl raya</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>waru</td>
                            </tr>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <td>sidoarjo</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>Jawa Timur</td>
                            </tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td>61256</td>
                            </tr>
                            <tr>
                                <th>Detail Alamat</th>
                                <td>depan rumah tetangga</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </main>
</body>
</html>