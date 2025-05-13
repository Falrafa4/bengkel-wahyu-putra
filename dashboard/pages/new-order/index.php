<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";

    if(isset($_POST['submit_pesanan'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
        $id_pelanggan = $_SESSION['data']['id_pelanggan'];
        $layanan = $_POST['jenis_layanan'];
        $desain_gambar = $_FILES['desain_gambar']['name'];
        $nama_item = $_POST['nama_item'];
        $material = $_POST['material'];
        $jumlah_item = $_POST['jumlah_item'];

        $nama_jalan = $_POST['nama_jalan'];
        $kecamatan = $_POST['kecamatan'];
        $kabupaten_kota = $_POST['kabupaten_kota'];
        $provinsi = $_POST['provinsi'];
        $kode_pos = $_POST['kode_pos'];
        $detail = $_POST['detail'];
        
        $query = 'SELECT no_pesanan FROM pemesanan WHERE id_pelanggan = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id_pelanggan);
        $stmt->execute();
        $stmt->bind_result($no_pesanan);
        $stmt->fetch();
        $stmt->close();
        
        if(insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $layanan)) {
            $no_pesanan = $conn->insert_id;

            $split = explode('.', $_FILES['desain_gambar']['name']); //array
            $ekstensi = $split[count($split)-1];

            $desain_gambar = $no_pesanan . '.' . $ekstensi;

            $from = $_FILES['desain_gambar']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/desain/' . $desain_gambar;

            move_uploaded_file($from, $to);

            if($no_pesanan) {
                if(insertPemesananItem($conn, $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item)) {
                    echo "<script>alert('Pesanan berhasil dibuat! Pesanan sedang menunggu penawaran. Terima kasih.'); location.href='../ ';</script>";
                } else {
                    echo "<script> alert('Terjadi kesalahan saat menambahkan item pesanan. :\(') </script>";
                }
            } else {
                echo "<script>alert('Gagal mengambil Nomor Pesanan :\(');</script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan pesanan :\(. Coba lagi nanti.');</script>";
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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.css">

    <title>Dashboard - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main class="buatPesanan">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <section class="utama">
            <h1>Buat Pesanan</h1>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="progress-bar"></div>
                <div class="form-pesanan">
                    <div class="step-form" id="form1">
                        <h2>Data Item</h2>
                        <em><span>*</span> Wajib Diisi</em>
                        <p id="validate_form" style="color: red;"></p>
                        <div class="input-box">
                            <label for="jenis_layanan">Jenis Layanan <span>*</span></label>
                            <?php
                            $service = mysqli_query($conn, "SELECT * FROM service");
                            ?>
                            <select name="jenis_layanan" id="">
                                <?php foreach ($service as $serviceKey) { ?>
                                    <option value="<?= $serviceKey['id_service'] ?>"><?= $serviceKey['nama_service'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="nama_item">Nama Item/Barang <span>*</span></label>
                            <input type="text" name="nama_item" id="nama_item" required>
                        </div>
                        <div class="input-box">
                            <label for="desain_gambar">Desain Gambar <span>*</span></label>
                            <input type="file" name="desain_gambar" id="desain_gambar" accept=".pdf, .jpg, .jpeg, .png" required>
                        </div>
                        <div class="input-box">
                            <label for="material">Material <span>*</span></label>
                            <input type="text" name="material" id="material" placeholder="Cth: Besi" required>
                        </div>
                        <div class="input-box">
                            <label for="jumlah_item">Jumlah Item <span>*</span></label>
                            <input type="number" name="jumlah_item" id="jumlah_item" placeholder="Masukkan Dalam Bentuk Angka" min="1" required>
                        </div>
                        <div class="btn">
                            <button type="button" id="next">
                                Lanjut
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="step-form" id="form2">
                        <h2>Alamat Pengiriman</h2>
                        <em><span>*</span> Wajib Diisi</em>
                        <p id="validate_form2" style="color: red;"></p>
                        <div class="input-box">
                            <label for="nama_jalan">Nama Jalan & Nomor <span>*</span></label>
                            <input type="text" name="nama_jalan" id="nama_jalan" value="" placeholder="Cth: Jl. Ir. Soekarno atau Perumahan Wadung Asri Indah Blok A6" required>
                        </div>
                        <div class="input-box">
                            <label for="kecamatan">Kecamatan <span>*</span></label>
                            <input type="text" name="kecamatan" id="kecamatan" placeholder="Cth: Wonokromo" required>
                        </div>
                        <div class="input-box">
                            <label for="kabupaten_kota">Kabupaten/Kota <span>*</span></label>
                            <input type="text" name="kabupaten_kota" id="kabupaten_kota" placeholder="Cth: Surabaya">
                        </div>
                        <div class="input-box">
                            <label for="provinsi">Provinsi <span>*</span></label>
                            <input type="text" name="provinsi" id="provinsi" placeholder="Cth: Jawa Timur">
                        </div>
                        <div class="input-box">
                            <label for="kode_pos">Kode Pos <span>*</span></label>
                            <input type="number" name="kode_pos" id="kode_pos" placeholder="Cth: 60242">
                        </div>
                        <div class="input-box">
                            <label for="detail">Detail Alamat</label>
                            <input type="text" name="detail" id="detail" placeholder="Cth: Depan Warung (Opsional)">
                        </div>
                        <div class="btn">
                            <button type="button" id="back">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </button>
                            <button type="submit" id="submit" name="submit_pesanan">
                                Buat Pesanan
                                <i class="fas fa-check-to-slot"></i>
                            </button>
                        </div>
                        <div class="btn">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script>
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');
        const next = document.getElementById('next');
        const back = document.getElementById('back');
        const submit = document.getElementById('submit');
        const heightForm = document.querySelector('.form-pesanan');
        const progressBar = document.querySelector('.progress-bar');

        back.onclick = function(){
            form2.style.display = 'none';
            form1.style.display = 'block';
            heightForm.style.height = '480px';
            progressBar.style.width = '50%';
            progressBar.style.borderRadius = '10px 5px 5px 0px';
        }

        const nama_item = document.getElementById('nama_item');
        const desain = document.getElementById('desain_gambar');
        const material = document.getElementById('material');
        const jumlah_item = document.getElementById('jumlah_item');
        const validate = document.getElementById('validate_form');

        next.addEventListener("click", function(){
            if(nama_item.value === "" || desain.value === "" || material.value === "" || jumlah_item.value === ""){
                event.preventDefault();
                validate.innerHTML = "Data masih ada yang kosong. Harap diisi!";
                heightForm.style.height = '500px';
            }
            else if (jumlah_item.value <= 0) {
                event.preventDefault();
                validate.innerHTML = "Jumlah item minimal 1!";
                heightForm.style.height = '500px';
            } 
            else {
                form1.style.display = 'none';
                form2.style.display = 'block';
                heightForm.style.height = '530px';
                progressBar.style.width = '100%';
                progressBar.style.borderRadius = '10px 10px 0px 0px';
                validate.innerHTML = "";
            }
        })

        const nama_jalan = document.getElementById('nama_jalan');
        const kecamatan = document.getElementById('kecamatan');
        const kabupaten_kota = document.getElementById('kabupaten_kota');
        const provinsi = document.getElementById('provinsi');
        const kode_pos = document.getElementById('kode_pos');
        const validate2 = document.getElementById('validate_form2');

        submit.addEventListener('click', function() {
            if(nama_jalan.value === '' || kecamatan.value === '' || kabupaten_kota.value === '' || provinsi.value === '' || kode_pos.value === '') {
                event.preventDefault();
                validate2.innerHTML = "Data masih ada yang kosong. Harap diisi!";
                heightForm.style.height = '540px';
            }
        })
    </script>
</body>
</html>