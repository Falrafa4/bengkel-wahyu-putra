<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

$id_penawaran = '';
$no_pesanan = '';
$harga_penawaran = '';
$estimasi_penawaran = '';
$tgl_penawaran = '';
$status_penawaran = '';
$pesan = '';

if (isset($_GET['edit']) || isset($_GET['status'])) {
    $id_penawaran = $_GET['id'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM penawaran WHERE id_penawaran = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_penawaran);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $id_penawaran = $result['id_penawaran'];
    $no_pesanan = $result['no_pesanan'];
    $harga_penawaran = $result['harga_penawaran'];
    $estimasi_penawaran = $result['estimasi_penawaran'];
    $tgl_penawaran = $result['tgl_penawaran'];
    $status_penawaran = $result['status_penawaran'];
}

if (isset($_POST['aksi'])) {
    $id_penawaran = $_POST['id_penawaran'];
    $no_pesanan = $_POST['no_pesanan'];
    $harga_penawaran = $_POST['harga_penawaran'];
    $estimasi_penawaran = $_POST['estimasi_penawaran'];
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

            if (insertPenawaran($conn, $no_pesanan, $harga_penawaran, $estimasi_penawaran, $surat_penawaran)) {
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
        $status_penawaran = $_POST['status_penawaran'];

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

        if (updatePenawaran($conn, $no_pesanan, $surat_baru, $harga_penawaran, $estimasi_penawaran, $id_penawaran) && updateStatusPenawaran($conn, $status_penawaran, $id_penawaran)) {
            $_SESSION['eksekusi'] = "Penawaran Berhasil Diedit!";
            header("Location: ../");
        } else {
            die("Gagal mengubah data penawaran :(");
        }
    }
}

if (isset($_POST['edit_status'])) {
    $id_penawaran = $_POST['id_penawaran'];
    $status_penawaran = $_POST['status_penawaran'];
    // var_dump($_POST);
    // die();
    if (updateStatusPenawaran($conn, $status_penawaran, $id_penawaran)) {
        $_SESSION['eksekusi'] = "Status Penawaran Berhasil Diubah!";
        header("location: ../");
    } else {
        die("Gagal mengubah status");
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

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">

            <?php if (isset($_GET['no'])) : ?>
                <form action="./?no=<?= $_GET['no'] ?>" method="POST" enctype="multipart/form-data">
                    <h1>Buat Penawaran</h1>
                    <hr>
                    <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                    <input type="hidden" name="id_penawaran" value="<?= $id_penawaran ?>" id="id_penawaran">
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
                        <label for="harga_penawaran">
                            Harga Penawaran
                        </label>
                        <input type="number" name="harga_penawaran" id="harga_penawaran" accept=".pdf, .jpg, .jpeg, .png" value="<?= $harga_penawaran ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="estimasi_penawaran">Estimasi </label>
                        <input type="date" name="estimasi_penawaran" id="estimasi_penawaran" required>
                    </div>
                    <div class="input-box">
                        <label for="surat_penawaran">Surat Penawaran </label>
                        <input type="file" name="surat_penawaran" id="surat_penawaran" accept=".pdf, .jpg, .jpeg, .png" required>
                    </div>

                    <button type="submit" name="aksi" value="add" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Tambahkan
                    </button>
                    <a href="../../pemesanan/#<?= $_GET['no'] - 1 ?>" class="btn-kelola back">
                        <i class="fas fa-reply"></i>
                        Batal
                    </a>
                </form>

            <?php elseif (isset($_GET['id']) && isset($_GET['edit'])) : ?>
                <form action="./?id=<?= $_GET['id'] ?>&edit=1" method="POST" enctype="multipart/form-data">
                    <h1>Edit Penawaran</h1>
                    <hr>
                    <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                    <div class="input-box">
                        <label for="id_penawaran">ID Penawaran</label>
                        <input type="text" name="id_penawaran" id="id_penawaran" value="<?= $id_penawaran ?>" readonly>
                    </div>
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
                        <label for="harga_penawaran">
                            Harga Penawaran
                        </label>
                        <input type="number" name="harga_penawaran" id="harga_penawaran" accept=".pdf, .jpg, .jpeg, .png" value="<?= $harga_penawaran ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="estimasi_penawaran">
                            Estimasi Penawaran
                        </label>
                        <input type="date" name="estimasi_penawaran" id="estimasi_penawaran" accept=".pdf, .jpg, .jpeg, .png" value="<?= $estimasi_penawaran ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="surat_penawaran">Surat Penawaran </label>
                        <input type="file" name="surat_penawaran" id="surat_penawaran" accept=".pdf, .jpg, .jpeg, .png">
                    </div>
                    <div class="input-box">
                        <label for="status_penawaran">Status Penawaran</label>
                        <select name="status_penawaran" id="status_penawaran">
                            <option value="1" <?= $status_penawaran == 'Diterbitkan' ? 'selected' : '' ?>>Diterbitkan</option>
                            <option value="2" <?= $status_penawaran == 'Negosiasi' ? 'selected' : '' ?>>Negosiasi</option>
                            <option value="3" <?= $status_penawaran == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="4" <?= $status_penawaran == 'Terbit Baru' ? 'selected' : '' ?>>Terbit Baru (Setelah Negosiasi)</option>
                        </select>
                    </div>

                    <button type="submit" name="aksi" value="edit" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                    <a href="../" class="btn-kelola back">
                        <i class="fas fa-reply"></i>
                        Batal
                    </a>
                </form>

            <?php elseif (isset($_GET['id']) && isset($_GET['status'])) : ?>
                <form action="./?id=<?= $_GET['id'] ?>&status=1" method="post">
                    <h1>Edit Status Penawaran</h1>
                    <hr>
                    <div class="input-box">
                        <label for="id_penawaran">ID Penawaran</label>
                        <input type="text" name="id_penawaran" id="id_penawaran" value="<?= $id_penawaran ?>" readonly>
                    </div>
                    <div class="input-box">
                        <label for="nama">No Pesanan </label>
                        <input type="text" name="no_pesanan" id="no_pesanan" value="<?= $no_pesanan ?>" readonly>
                    </div>
                    <div class="input-box">
                        <label for="status_penawaran">Status Penawaran</label>
                        <select name="status_penawaran" id="status_penawaran">
                            <option value="1" <?= $status_penawaran == 'Diterbitkan' ? 'selected' : '' ?>>Diterbitkan</option>
                            <option value="2" <?= $status_penawaran == 'Negosiasi' ? 'selected' : '' ?>>Negosiasi</option>
                            <option value="3" <?= $status_penawaran == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="4" <?= $status_penawaran == 'Terbit Baru' ? 'selected' : '' ?>>Terbit Baru (Setelah Negosiasi)</option>
                        </select>
                    </div>
                    <button type="submit" name="edit_status" class="btn-kelola update">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                    <a href="../" class="btn-kelola back">
                        <i class="fas fa-reply"></i>
                        Batal
                    </a>
                </form>

            <?php
            else :
                echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "ID Penawaran/No Pesanan dan status tidak valid!",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../";
        }
        });
        </script>';
                die();
            endif;
            ?>

        </section>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/script.js"></script>
</body>

</html>