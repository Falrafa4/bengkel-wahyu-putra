<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

$id_penawaran = '';
$no_pesanan = '';
$harga = '';
$estimasi = '';
$tgl_penawaran = '';
$status_penawaran = '';
$pesan = '';

if (isset($_GET['edit'])) {
    $no_pesanan = $_GET['no'];

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
    // $estimasi = $result['estimasi'];
    $tgl_penawaran = $result['tgl_penawaran'];
    $status_penawaran = $result['status_penawaran'];
}

if (isset($_POST['aksi'])) {
    $id_penawaran = $_POST['id_penawaran'];
    $no_pesanan = $_POST['no_pesanan'];
    $harga = $_POST['harga'];
    $surat_penawaran = $_FILES['surat_penawaran']['name'];

    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        if (empty($no_pesanan) || empty($surat_penawaran)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        } elseif (empty($pesan)) {
            $split = explode('.', $_FILES['surat_penawaran']['name']);
            $ekstensi = $split[count($split) - 1];

            $surat_penawaran = 'spwp_' . time() . '.' . $ekstensi;

            $from = $_FILES['surat_penawaran']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/penawaran/' . $surat_penawaran;

            move_uploaded_file($from, $to);

            if (insertPenawaran($conn, $no_pesanan, $harga, $surat_penawaran)) {
                if (updateStatusPesanan($conn, $no_pesanan, 2)) {
                    $_SESSION['eksekusi'] = "Penawaran Berhasil Diterbitkan!";
                    header("location: ../");
                }
            } else {
                die("Gagal menambahkan data penawaran :(");
            }
        }
    }

    // UPDATE DATA
    if ($_POST['aksi'] == 'edit') {
        $stmt = $conn->prepare("SELECT * FROM penawaran WHERE id_penawaran = ?");
        $stmt->bind_param('i', $id_penawaran);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($_FILES['surat_penawaran']['name'] == '') {
            $surat_baru = $data['surat_penawaran'];
        } else {
            $path_lama = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/penawaran/' . $data['surat_penawaran'];
            if (file_exists($path_lama)) {
                unlink($path_lama);
            }

            $split = explode('.', $_FILES['surat_penawaran']['name']);
            $ekstensi = $split[count($split) - 1];

            $allowed_ext = ['pdf', 'jpg', 'png'];
            if (!in_array(strtolower($ekstensi), $allowed_ext)) {
                die("Format file tidak mendukung! Harap pilih pdf, jpg, atau png");
            }

            $surat_baru = 'spwp_' . time() . '.' . $ekstensi;

            $from = $_FILES['surat_penawaran']['tmp_name'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/bengkel-wahyu-putra/uploads/penawaran/' . $surat_baru;

            if (!move_uploaded_file($from, $to)) {
                die("Gagal mengunggah file penawaran baru.");
            }
        }

        if (updatePenawaran($conn, $no_pesanan, $surat_baru, $harga, $id_penawaran)) {
            $_SESSION['eksekusi'] = "Penawaran Berhasil Diedit!";
            header("Location: ../");
        } else {
            die("Gagal mengubah data penawaran :(");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/global.css">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/kelola.css">
    <link rel="shortcut icon" href="/bengkel-wahyu-putra/assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/fontawesome/css/all.css">

    <!-- Sweetalert2 -->
    <script src="/bengkel-wahyu-putra/assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Kelola - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>

    <?php
    // if(!isset($_GET['no'])) {
    // echo '<script>
    // Swal.fire({
    //     icon: "error",
    //     title: "Error",
    //     text: "Nomor Pesanan tidak valid!",
    // }).then((result) => {
    // if (result.isConfirmed) {
    //     window.location.href = "../";
    // }
    // });
    // </script>';
    // die();
    // }
    ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">
            <form action="./?" method="POST" enctype="multipart/form-data">
                <h1>
                    <?= isset($_GET['edit']) ? "Edit Penawaran" : "Buat Penawaran" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" name="id_penawaran" value="<?= $id_penawaran ?>" id="id_penawaran">
                <input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>" id="no_pesanan">
                <div class="input-box">
                    <label for="nama">No Pesanan </label>
                    <select name="no_pesanan" id="no_pesanan">
                        <?php $result = $conn->query("SELECT * FROM pemesanan");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['no_pesanan'] ?>" <?= ($no_pesanan == $row['no_pesanan'] || (isset($_GET['no']) && $_GET['no'] == $row['no_pesanan'])) ? 'selected' : '' ?>>
                                <?= $row['no_pesanan'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box">
                    <label for="harga">
                        Tulis Harga<br>
                        <em>Harga dari surat</em>
                    </label>
                    <input type="number" name="harga" id="harga" accept=".pdf, .jpg, .jpeg, .png" value="<?= $harga ?>" required>
                </div>
                <div class="input-box">
                    <label for="surat_penawaran">Surat Penawaran </label>
                    <input type="file" name="surat_penawaran" id="surat_penawaran" accept=".pdf, .jpg, .jpeg, .png" <?= isset($_GET['edit']) ? '' : 'required' ?>>
                </div>

                <?php
                if (isset($_GET['edit'])) { ?>
                    <button type="submit" name="aksi" value="edit" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                    <a href="../" class="btn-kelola back">
                        <i class="fas fa-reply"></i>
                        Batal
                    </a>
                <?php } else { ?>
                    <button type="submit" name="aksi" value="add" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Tambahkan
                    </button>
                    <a href="../../pemesanan/" class="btn-kelola back">
                        <i class="fas fa-reply"></i>
                        Batal
                    </a>
                <?php } ?>

            </form>
        </section>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>

</html>