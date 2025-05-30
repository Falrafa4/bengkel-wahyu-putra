<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

$pesan = '';
if (isset($_GET['id'])) {
    $id_pembayaran = $_GET['id'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM pembayaran WHERE id_pembayaran = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pembayaran);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $status_bayar = $result['status_bayar'];
}

if (isset($_POST['aksi'])) {
    $id_pembayaran = $_POST['id_pembayaran'];
    $status_bayar = $_POST['status_bayar'];

    if (updateStatusPembayaran($conn, $id_pembayaran, $status_bayar)) {
        $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
        header("location: ../");
    } else {
        die("Gagal mengupdate status negosiasi");
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

    <!-- Sweetalert2 -->
    <script src="../../../../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Kelola - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php";

    if (!isset($_GET['id']) || $_GET['id'] == null) {
        echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "ID Pembayaran tidak valid!",
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = "../";
    }
    });
    </script>';
        die();
    }
    ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">
            <form action="./?edit=<?= $id_pembayaran ?>" method="POST" enctype="multipart/form-data">
                <h1>Edit Status Pembayaran</h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <div class="input-box">
                    <label for="">ID Pembayaran</label>
                    <input type="text" name="id_pembayaran" value="<?= $id_pembayaran ?>" id="id_pembayaran" readonly>
                </div>

                <div class="input-box">
                    <label for="status_bayar">Status Pembayaran </label>
                    <select name="status_bayar" id="status_bayar">
                        <option value="1" <?php if ($result['status_bayar'] == 'Sedang Dikonfirmasi') echo 'selected'; ?>>Sedang Dikonfirmasi (Oleh pemilik)</option>
                        <option value="2" <?php if ($result['status_bayar'] == 'Lunas') echo 'selected'; ?>>Lunas</option>
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
        </section>
    </main>

    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>

</html>