<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";

if (isset($_POST['aksi']) || isset($_GET['ubah'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
}

// $no_pesanan = '';
$id_pelanggan = '';
// $waktu_pemesanan = '';
// $nama_jalan = '';
// $kecamatan = '';
// $kabupaten_kota = '';
// $provinsi = '';
// $kode_pos = '';
// $detail = '';
// $id_service = '';
// $status = '';
$result = null;
$pesan = '';

if (isset($_GET['ubah'])) {
    $no_pesanan = $_GET['ubah'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM pemesanan JOIN pemesanan_item ON pemesanan.no_pesanan = pemesanan_item.no_pesanan WHERE pemesanan.no_pesanan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $no_pesanan);
    $stmt->execute();
    $res = $stmt->get_result();
    $result = $res->fetch_assoc();
}

if (isset($_POST['aksi'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
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

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($id_pelanggan) || empty($layanan) || empty($nama_item) || empty($material) || empty($jumlah_item) || empty($nama_jalan) || empty($kecamatan) || empty($kabupaten_kota) || empty($provinsi) || empty($kode_pos) || empty($detail)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } else if (empty($pesan)) {
            if (insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $layanan)) {
                $no_pesanan = $conn->insert_id;

                $split = explode('.', $_FILES['desain_gambar']['name']); //array
                $ekstensi = $split[count($split) - 1];

                $desain_gambar = $no_pesanan . '.' . $ekstensi;

                $from = $_FILES['desain_gambar']['tmp_name'];
                $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/desain/' . $desain_gambar;

                move_uploaded_file($from, $to);

                if ($no_pesanan) {
                    if (insertPemesananItem($conn, $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item)) {
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
    }

    // UPDATE DATA
    if ($_POST['aksi'] == 'edit') {
        $no_pesanan = $_POST['no_pesanan'];
        if (updatePemesanan($conn, $no_pesanan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service, $id_pelanggan)) {
            $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
            header("location: ../");
        } else {
            die("Query gagal: " . $conn->error);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../../assets/css/kelola.css">
    <link rel="shortcut icon" href="../../../../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/fontawesome/css/all.css">

    <title>Kelola - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">
            <!-- <form action="./" method="POST">
                <h1>
                    <?= isset($_GET['ubah']) ? "Edit Data" : "Tambah Data" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>" id="no_pesanan">
                <div class="input-box">
                    <label for="nama">Nama Pelanggan </label>
                    <select name="id_pelanggan" id="id_pelanggan">
                        <?php $resultSelect = $conn->query("SELECT * FROM pelanggan");
                        while ($row = $resultSelect->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_pelanggan'] ?>" <?php if ($id_pelanggan == $row['id_pelanggan']) echo 'selected'; ?>><?= $row['nama_pelanggan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box">
                    <label for="jalan">Nama Jalan </label>
                    <input type="text" name="nama_jalan" id="jalan" placeholder="Ex: Jl. Kolonel Sugiono No. 13" value="<?= $nama_jalan ?>" required>
                </div>
                <div class="input-box">
                    <label for="kecamatan">Kecamatan </label>
                    <input type="text" name="kecamatan" id="kecamatan" placeholder="Ex: Waru" value="<?= $kecamatan ?>" required>
                </div>
                <div class="input-box">
                    <label for="kabupaten">Kabupaten/Kota </label>
                    <input type="text" name="kabupaten_kota" id="kabupaten" placeholder="Ex: Sidoarjo" value="<?= $kabupaten_kota ?>" required>
                </div>
                <div class="input-box">
                    <label for="provinsi">Provinsi </label>
                    <input type="text" name="provinsi" id="provinsi" placeholder="Ex: Jawa Timur" value="<?= $provinsi ?>" required>
                </div>
                <div class="input-box">
                    <label for="kode_pos">Kode Pos </label>
                    <input type="text" name="kode_pos" id="kode_pos" placeholder="Ex: 61256" value="<?= $kode_pos ?>" required>
                </div>
                <div class="input-box">
                    <label for="detail">Detail </label>
                    <input type="text" name="detail" id="detail" placeholder="Ex: Rumah Tingkat, sebelah toko" value="<?= $detail ?>" required>
                </div>
                <div class="input-box">
                    <label for="detail">Service </label>
                    <select name="id_service" id="id_service">
                        <?php $resultSelect = $conn->query("SELECT * FROM service");
                        while ($row = $resultSelect->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_service'] ?>" <?php if ($row['id_service'] == $id_service) echo 'Selected' ?>><?= $row['nama_service'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php
                if (isset($_GET['ubah'])) { ?>
                    <button type="submit" name="aksi" value="edit" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                <?php } else { ?>
                    <button type="submit" name="aksi" value="add" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Tambahkan
                    </button>
                <?php } ?>
                <a href="../" class="btn-kelola back">
                    <i class="fas fa-reply"></i>
                    Batal
                </a>
            </form> -->
            <h1>Buat Pesanan</h1>
            <hr>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>
                <div class="form-pesanan">
                    <div class="step-form" id="form1">
                        <h2>Data Item</h2>
                        <em><span>*</span> Wajib Diisi</em>
                        <p id="validate_form" style="color: red;"></p>
                        <input type="hidden" hidden name="id_pelanggan" id="id_pelanggan" value="">
                        <?php var_dump($result); ?>
                        <div class="input-box">
                            <label for="nama_pelanggan">Nama Pelanggan </label>
                            <select name="id_pelanggan" id="id_pelanggan">
                                <?php $resultSelect = $conn->query("SELECT * FROM pelanggan WHERE role ='User'");
                                while ($row = $resultSelect->fetch_assoc()) {
                                ?>
                                    <option value="<?= $row['id_pelanggan'] ?>" <?= $result != null && $result['id_pelanggan'] == $row['id_pelanggan'] ? 'selected' : ''; ?>><?= $row['nama_pelanggan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="jenis_layanan">Jenis Layanan <span>*</span></label>
                            <?php
                            $service = mysqli_query($conn, "SELECT * FROM service");
                            ?>
                            <select name="jenis_layanan" id="jenis_layanan">
                                <?php foreach ($service as $serviceKey) { ?>
                                    <option value="<?= $serviceKey['id_service'] ?>" <?= $result != null && $result['id_service'] == $serviceKey['id_service'] ? 'selected' : ''; ?>><?= $serviceKey['nama_service'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="nama_item">Nama Item/Barang <span>*</span></label>
                            <input type="text" name="nama_item" id="nama_item" required value="<?= $result != null ? $result['nama_item'] : '' ?>">
                        </div>
                        <div class="input-box">
                            <label for="desain_gambar">Desain Gambar <span>*</span></label>
                            <input type="file" name="desain_gambar" id="desain_gambar" accept=".pdf, .jpg, .jpeg, .png" required>
                        </div>
                        <div class="input-box">
                            <label for="material">Material <span>*</span></label>
                            <input type="text" name="material" id="material" required>
                        </div>
                        <div class="input-box">
                            <label for="jumlah_item">Jumlah Item <span>*</span></label>
                            <input type="number" name="jumlah_item" id="jumlah_item" placeholder="Masukkan Dalam Bentuk Angka" min="1" maxlength="2" required>
                        </div>
                    </div>
                    <div class="step-form" id="form2">
                        <h2>Alamat Pengiriman</h2>
                        <p id="validate_form2" style="color: red;"></p>
                        <div class="input-box">
                            <label for="nama_jalan">Nama Jalan & Nomor <span>*</span></label>
                            <input type="text" name="nama_jalan" id="nama_jalan" value="" required>
                        </div>
                        <div class="input-box">
                            <label for="kecamatan">Kecamatan <span>*</span></label>
                            <input type="text" name="kecamatan" id="kecamatan" required>
                        </div>
                        <div class="input-box">
                            <label for="kabupaten_kota">Kabupaten/Kota <span>*</span></label>
                            <input type="text" name="kabupaten_kota" id="kabupaten_kota" required>
                        </div>
                        <div class="input-box">
                            <label for="provinsi">Provinsi <span>*</span></label>
                            <input type="text" name="provinsi" id="provinsi" required>
                        </div>
                        <div class="input-box">
                            <label for="kode_pos">Kode Pos <span>*</span></label>
                            <input type="number" name="kode_pos" id="kode_pos" required>
                        </div>
                        <div class="input-box">
                            <label for="detail">Detail Alamat</label>
                            <input type="text" name="detail" id="detail" required>
                        </div>
                        <div class="btn">
                            <?php if (isset($_GET['ubah'])) { ?>
                                <button class="button" type="submit" name="aksi" value="edit">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan Perubahan
                                </button>
                            <?php } else { ?>
                                <button class="button" type="submit" id="submit" name="aksi" value="add">
                                    Buat Pesanan
                                    <i class="fas fa-check-to-slot"></i>
                                </button>
                            <?php } ?>
                            <a href="../" class="btn-kelola back" style="width: fit-content; padding-left: 20px; padding-right: 20px;">
                                <i class="fas fa-reply"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
    <script>
        let jumlahItem = document.getElementById('jumlah_item');
        jumlahItem.oninput = () => {
            if (jumlahItem.value.length > jumlahItem.maxLength)
                jumlahItem.value = jumlahItem.value.slice(0, jumlahItem.maxLength);
        };
    </script>
</body>

</html>