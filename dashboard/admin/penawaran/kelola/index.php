<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

if (isset($_POST['aksi']) || isset($_GET['ubah'])) {
}

$id_penawaran = '';
$no_pesanan = '';
$harga = '';
$estimasi = '';
$tgl_penawaran = '';
$status_penawaran = '';
$pesan = '';

if (isset($_GET['ubah'])) {
    $no_pesanan = $_GET['ubah'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM penawaran WHERE no_pesanan = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $no_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $id_penawaran = $result['id_penawaran'];
    $no_pesanan = $result['no_pesanan'];
    $harga = $result['harga'];
    $estimasi = $result['estimasi'];
    $tgl_penawaran = $result['tgl_penawaran'];
    $status_penawaran = $result['status_penawaran'];
}

if (isset($_POST['aksi'])) {
    $no_pesanan = $_POST['no_pesanan'];
    $surat_penawaran = $_FILES['surat_penawaran']['name'];

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($no_pesanan) || empty($surat_penawaran)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } else if (empty($pesan)) {
            $split = explode('.', $_FILES['surat_penawaran']['name']);
            $ekstensi = $split[count($split)-1];

            $surat_penawaran = time() . '.' . $ekstensi;

            $from = $_FILES['surat_penawaran']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/penawaran/' . $surat_penawaran;

            move_uploaded_file($from, $to);

            if (insertPenawaran($conn, $no_pesanan, $surat_penawaran)) {
                $_SESSION['eksekusi'] = "Penawaran Berhasil Diterbitkan!";
                header("location: ../");
            } else {
                die("Query gagal: " . $conn->error);
            }
        }
    }

    // UPDATE DATA
    if ($_POST['aksi'] == 'edit') {
        $no_pesanan = $_POST['no_pesanan'];
        if ($no_pesanan = 1) {
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
                    <?= isset($_GET['ubah']) ? "Edit Penawaran" : "Buat Penawaran" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>" id="no_pesanan">
                <div class="input-box">
                    <label for="nama">No Pesanan </label>
                    <select name="no_pesanan" id="no_pesanan">
                        <?php $result = $conn->query("SELECT * FROM pemesanan");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['no_pesanan'] ?>" <?php if($no_pesanan == $row['no_pesanan']) echo "Selected" ?> ><?= $row['no_pesanan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box">
                    <label for="surat_penawaran">Surat Penawaran  </label>
                    <input type="file" name="surat_penawaran" id="surat_penawaran" accept=".pdf, .jpg, .jpeg, .png" required>
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