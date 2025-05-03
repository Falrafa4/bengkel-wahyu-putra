<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";

if (isset($_POST['aksi']) || isset($_GET['ubah'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
}

$no_pesanan = '';
$id_pelanggan = '';
$waktu_pemesanan = '';
$nama_jalan = '';
$kecamatan = '';
$kabupaten_kota = '';
$provinsi = '';
$kode_pos = '';
$detail = '';
$id_service = '';
$status = '';
$pesan = '';

if (isset($_GET['ubah'])) {
    $no_pesanan = $_GET['ubah'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM pemesanan WHERE no_pesanan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $no_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $no_pesanan = $result['no_pesanan'];
    $id_pelanggan = $result['id_pelanggan'];
    $waktu_pemesanan = $result['waktu_pemesanan'];
    $nama_jalan = $result['nama_jalan'];
    $kecamatan = $result['kecamatan'];
    $kabupaten_kota = $result['kabupaten_kota'];
    $provinsi = $result['provinsi'];
    $kode_pos = $result['kode_pos'];
    $detail = $result['detail'];
    $id_service = $result['id_service'];
    $status = $result['status_pesanan'];
}

if (isset($_POST['aksi'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_jalan = $_POST['nama_jalan'];
    $kecamatan = $_POST['kecamatan'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $provinsi = $_POST['provinsi'];
    $kode_pos = $_POST['kode_pos'];
    $detail = $_POST['detail'];
    $id_service = $_POST['id_service'];

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($id_pelanggan) || empty($nama_jalan) || empty($kecamatan) || empty($kabupaten_kota) || empty($provinsi) || empty($kode_pos) || empty($detail) || empty($id_service)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } // LANJUTKAN TAMBAH DATA DAN UPDATE DATA

        if (empty($pesan)) {
            if (insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service)) {
                $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan!";
                header("location: ../");
            } else {
                echo $stmt->execute();
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
            echo $stmt->execute();
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

    <title>Kelola Pemesanan Item - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">
            <form action="./" method="POST">
                <h1>
                    <?= isset($_GET['ubah']) ? "Edit Data" : "Tambah Data" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>" id="no_pesanan">
                <div class="input-box">
                    <label for="nama">Nama Pelanggan </label>
                    <select name="id_pelanggan" id="id_pelanggan">
                        <?php $result = $conn->query("SELECT * FROM pelanggan");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_pelanggan'] ?>" <?php if($id_pelanggan == $row['id_pelanggan']) echo 'selected'; ?>><?= $row['nama_pelanggan'] ?></option>
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
                        <?php $result = $conn->query("SELECT * FROM service");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_service'] ?>" <?php if($row['id_service'] == $id_service) echo 'Selected' ?>><?= $row['nama_service'] ?></option>
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
            </form>
        </section>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>

</html>