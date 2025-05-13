<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";

if (isset($_POST['aksi']) || isset($_GET['ubah'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
}

$id_item = '';
$no_pesanan = '';
$nama_item = '';
$desain_gambar = '';
$material = '';
$jumlah_item = '';
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
    $id_item = $result['id_item'];
    $no_pesanan = $result['no_pesanan'];
    $nama_item = $result['nama_item'];
    $desain_gambar = $result['desain_gambar'];
    $material = $result['material'];
    $jumlah_item = $result['jumlah_item'];
}

if (isset($_POST['aksi'])) {
    $id_item = $_POST['id_item'];
    $no_pesanan = $_POST['no_pesanan'];
    $nama_item = $_POST['nama_item'];
    $desain_gambar = $_POST['desain_gambar'];
    $material = $_POST['material'];
    $jumlah_item = $_POST['jumlah_item'];

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($id_pelanggan) || empty($nama_jalan) || empty($kecamatan) || empty($kabupaten_kota) || empty($provinsi) || empty($kode_pos) || empty($detail) || empty($id_service)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } // LANJUTKAN TAMBAH DATA DAN UPDATE DATA

        if (empty($pesan)) {
            if (insertPemesananItem($conn, $no_pesanan, $nama_item, $desain_gambar, $material, $jumlah_item)) {
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
                    <?= isset($_GET['ubah']) ? "Edit Data Item" : "Tambah Data Item" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="id_item" value="<?= $id_item ?>" id="id_item">
                <div class="input-box">
                    <label for="nama">No Pesanan </label>
                    <select name="no_pesanan" id="no_pesanan">
                        <?php $result = $conn->query("SELECT * FROM pemesanan_item");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['no_pesanan'] ?>" <?php if ($no_pesanan == $row['no_pesanan']) echo 'selected'; ?>><?= $row['no_pesanan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box">
                    <label for="nama_item">Nama Item </label>
                    <input type="text" name="nama_item" id="jalan" placeholder="Ex: Ambatubut" value="<?= $nama_item ?>" required>
                </div>
                <div class="input-box">
                    <label for="desain_gambar">Desain Gambar </label>
                    <input type="file" name="desain_gambar" id="desain_gambar" placeholder="Ex: Waru" value="<?= $desain_gambar ?>" required>
                </div>
                <div class="input-box">
                    <label for="material">Material </label>
                    <input type="text" name="material" id="material" placeholder="Ex: Sidoarjo" value="<?= $material ?>" required>
                </div>
                <div class="input-box">
                    <label for="jumlah_item">Jumlah Item </label>
                    <input type="text" name="jumlah_item" id="jumlah_item" placeholder="Ex: Jawa Timur" value="<?= $jumlah_item ?>" required>
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