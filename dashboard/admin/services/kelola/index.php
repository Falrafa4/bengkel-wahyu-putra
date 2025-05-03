<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";

if (isset($_POST['aksi']) || isset($_GET['ubah'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
}

$pesan = '';
$id_service = '';
$nama_service = '';
$deskripsi = '';
$gambar_jasa = '';

if (isset($_GET['ubah'])) {
    $id_service = $_GET['ubah'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM service WHERE id_service = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_service);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $id_service = $result['id_service'];
    $nama_service = $result['nama_service'];
    $deskripsi = $result['deskripsi'];
    $gambar_jasa = $result['gambar_jasa'];
}

if (isset($_POST['aksi'])) {
    $id_service = $_POST['id_service'];
    $nama_service = $_POST['nama_service'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_jasa = $_FILES['gambar_jasa'];

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($id_service) || empty($nama_service) || empty($deskripsi)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } // LANJUTKAN TAMBAH DATA DAN UPDATE DATA

        if (empty($pesan)) {
            if (insertPemesanan($conn, $id_pelanggan, $nama_jalan, $kecamatan, $kabupaten_kota, $provinsi, $kode_pos, $detail, $id_service)) {
                $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan!";
                header("location: ../");
            } else {
                die("Query gagal: " . $conn->error);
            }
        }
    }

    // UPDATE DATA
    if ($_POST['aksi'] == 'edit') {
        var_dump($_FILES);
        die();
        
        $no_pesanan = $_POST['no_pesanan'];
        if (empty($id_service) || empty($nama_service) || empty($deskripsi)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } // LANJUTKAN TAMBAH DATA DAN UPDATE DATA

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
            <form action="./" method="POST" enctype="multipart/form-data">
                <h1>
                    <?= isset($_GET['ubah']) ? "Edit Data" : "Tambah Data" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="id_service" value="<?= $id_service ?>" id="id_service">
                <div class="input-box">
                    <label for="jalan">Nama Service </label>
                    <input type="text" name="nama_service" id="jalan" placeholder="Ex: Bubut" value="<?= $nama_service ?>" required>
                </div>
                <div class="input-box">
                    <label for="kecamatan">Deskripsi </label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Ex: Layanan ini merupakan layanan kami yang mencakup..." required><?= $deskripsi ?></textarea>
                </div>
                <div class="input-box">
                    <label for="gambar_jasa">Gambar Jasa </label>
                    <input type="file" name="gambar_jasa" id="gambar_jasa" accept="image/*" required>
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