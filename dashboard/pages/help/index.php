<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.css">

    <title>Bantuan - Bengkel Wahyu Putra</title>

    <style>
        body::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main class="bantuan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <div class="main-content">
                <h1>Bantuan</h1>
                <hr class="hr-standar" style="width: 10dvw;">
                <!-- <p>Berisi notifikasi surat penawaran dari Bengkel Wahyu Putra</p> -->

                <h2>Pertanyaan Umum (FAQ)</h2>
                <button class="accordion">Bagaimana Cara Memesan Di Bengkel Wahyu Putra?</button>
                <div class="panel">
                    <p>Untuk melakukan pemesanan layanan di Bengkel Wahyu Putra, ikuti langkah-langkah berikut: </p>
                    <ol>
                        <li>
                            <b>Klik menu "Buat Pesanan" pada sidebar kiri dashboard</b>
                            <p>Setelah berhasil login, Anda akan melihat menu navigasi di sisi kiri layar. Klik opsi "Buat Pesanan".</p>
                        </li>
                        <li>
                            <b>Isi formulir pemesanan dengan lengkap</b>
                            <p>Anda akan diarahkan ke halaman formulir. Lengkapi data yang diminta, seperti:</p>
                            <ul>
                                <li>Jenis layanan yang dipesan</li>
                                <li>Nama item</li>
                                <li>Desain gambar</li>
                                <li>Jenis material</li>
                                <li>Alamat lengkap</li>
                            </ul><br>
                        </li>
                        <li>
                            <b>Periksa kembali data yang terisi</b>
                            <p>Pastikan semua informasi sudah benar untuk menghindari kesalahan proses.</p>
                        </li>
                        <li>
                            <b>Klik tombol "Buat Pesanan"</b>
                            <p>Setelah yakin, klik tombol "Buat Pesanan" untuk mengirimkan pesanan Anda.</p>
                        </li>
                        <li>
                            <b>Tunggu surat penawaran</b>
                            <p>Tim kami akan memproses pesanan Anda. Surat penawaran akan muncul di menu "Surat Penawaran" pada sidebar.</p>
                        </li>
                    </ol>
                </div>
                <button class="accordion">Apa Saja Jenis Layanan Yang Tersedia?</button>
                <div class="panel">
                    <p>Saat ini, kami menyediakan dua layanan sebagai berikut:</p>
                    <ol>
                        <li>
                            Jasa Perbaikan
                            <p>Di antaranya memperbaiki material, cetakan yang rusak, serta modifikasi unit atau komponen sesuai kebutuhan Anda.</p>
                        </li>
                        <li>
                            Jasa Produksi Baru
                            <p>Kami juga menerima pesanan pembuatan barang baru sesuai kebutuhan Anda.</p>
                        </li>
                    </ol>
                    <p>Untuk penjelasan lengkapnya, Anda bisa melihat di <a href="../../../pages/services/" style="font-style: italic;">halaman services.</a></p>
                </div>
            </div>
        </section>
    </main>

    <script src="../../../assets/js/main.js"></script>
    <script>
        let acc = document.getElementsByClassName('accordion');
        let i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener('click', function() {
                this.classList.toggle('acc-active');
                let panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                }
            })
        }
    </script>
</body>

</html>