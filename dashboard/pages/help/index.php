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
        body {
            overflow-y: scroll;
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

                <section class="faq">
                    <h2 style="margin-top: 20px">Pertanyaan Umum (FAQ)</h2>
                    <div class="container-acc">             
                        <button class="accordion">Apa Saja Jenis Layanan Yang Tersedia?</button>
                        <div class="panel">
                            <p>Saat ini, kami menyediakan dua layanan sebagai berikut:</p>
                            <ol>
                                <li>
                                    <strong>Jasa Perbaikan</strong>
                                    <p>Di antaranya memperbaiki material, cetakan yang rusak, serta modifikasi unit atau komponen sesuai kebutuhan Anda.</p>
                                </li>
                                <li>
                                    <strong>Jasa Produksi Baru</strong>
                                    <p>Kami juga menerima pesanan pembuatan barang baru sesuai kebutuhan Anda.</p>
                                </li>
                            </ol>
                            <p>Untuk penjelasan lengkapnya, Anda bisa melihat di <a href="../../../pages/services/" style="font-style: italic;">halaman services.</a></p>
                        </div>
    
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
    
                        <button class="accordion">Di Mana Saya Dapat Melihat Pesanan Yang Telah Dipesan?</button>
                        <div class="panel">
                            <p>Untuk melihat pesanan yang telah dibuat sebelumnya, ikuti langkah berikut:</p>
                            <ol>
                                <li>
                                    <p>Klik menu <strong><i class="fas fa-list"></i> Daftar Pesanan</strong> pada sidebar kiri dashboard</p>
                                </li>
                                <li>
                                    <p>Lihat daftar pesanan yang telah Anda buat. Jika belum ada, maka Anda belum membuat pesanan.</p>
                                </li>
                                <li>
                                    <p>Pilih salah satu pesanan lalu klik tombol <strong>Detail</strong> pada kolom aksi untuk melihat detail pesanan.</p>
                                </li>
                                <li>
                                    <p>Anda juga dapat melihat status pesanan dengan berbagai macam kombinasi warna sesuai kepentingannya.</p>
                                </li>
                            </ol>
                        </div>
    
                        <button class="accordion">Apa Yang Dilakukan Setelah Memesan?</button>
                        <div class="panel">
                            <p>Setelah membuat pesanan, Anda harap menunggu surat penawaran dari pemilik yang nanti akan diterbitkan pada halaman <strong><i class="fas fa-envelope"></i> Surat Penawaran</strong></p>
                            <ol>
                                <li>
                                    <p>Lihat Surat Penawaran pada halaman <strong><i class="fas fa-envelope"></i> Surat Penawaran</strong></p>
                                </li>
                                <li>
                                    <p>Unduh surat penawaran untuk melihat detailnya.</p>
                                </li>
                                <li>
                                    <p>Jika setuju, maka klik tombol <strong><i class="fas fa-check"></i> Setuju</strong> pada bagian aksi.</p>
                                </li>
                                <li>
                                    <p>Jika kurang setuju, maka Anda dapat mengajukan negosiasi pada tombol <strong>Negosiasi</strong></p>
                                </li>
                            </ol>
                        </div>
                        
                        <button class="accordion">Bagaimana Cara Pengajuan Negosiasi Terhadap Surat Penawaran?</button>
                        <div class="panel">
                            <p>Untuk mengajukan negosiasi, caranya cukup mudah</p>
                            <ol>
                                <li>
                                    <p>Pertama, buka menu <strong><i class="fas fa-envelope"></i> Surat Penawaran</strong></p>
                                </li>
                                <li>
                                    <p>Lalu, pilih surat yang akan diajukan negosiasi.</p>
                                </li>
                                <li>
                                    <p>Kemudian, klik tombol <strong><i class="fas fa-handshake"></i> Negosiasi</strong> pada bagian aksi.</p>
                                </li>
                                <li>
                                    <p>Pilih jenis negosiasi pada form negosiasi kemudian isi catatan yang tertera.</p>
                                </li>
                                <li>
                                    <p>Terakhir, klik <strong>Kirim</strong> untuk mengirim pengajuan kepada pemilik Bengkel agar segera diterbitkan surat baru.</p>
                                </li>
                            </ol>
                        </div>
                    </div>
                </section>

                <section class="hubungi" style="padding-bottom: 20px;">
                    <h2 style="margin-bottom: 5px;">Hubungi Kami</h2>
                    <p>Masih mengalami kesulitan? Hubungi kami untuk penanganan lebih lanjut!</p><br>
                    <a href="mailto:jasabengkelwahyuputra@gmail.com" class="btn-primary">
                        <i class="fas fa-envelope fa-lg"></i> Email
                    </a>
                    <a href="https://wa.me/6281216977427" target="_blank" class="btn-primary" style="margin-left: 5px;">
                        <i class="fab fa-whatsapp fa-lg"></i> WhatsApp
                    </a>
                </section>
            </div>
        </section>
    </main>

    <script src="../../../assets/js/script.js"></script>
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