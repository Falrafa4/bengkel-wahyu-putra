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
$jalan = '';
$kecamatan = '';
$kabupaten_kota = '';
$provinsi = '';
$kode_pos = '';
$detail = '';
$id_service = '';
$status = '';
$pesan = '';

if (isset($_GET['ubah'])) {
    $id_pelanggan = $_GET['ubah'];

    //query SELECT untuk memasukkan data ke dalam form => untuk diedit
    $query = "SELECT * FROM pemesanan WHERE id_pelanggan = '$id_pelanggan';";
    $sql = $conn->query($query);
    $result = $sql->fetch_assoc();

    //data di bawah akan diletakkan pada tiap input-an
    $no_pesanan = $result['no_pesanan'];
    $id_pelanggan = $result['id_pelanggan'];
    $waktu_pemesanan = $result['waktu_pemesanan'];
    $jalan = $result['nama_jalan'];
    $kecamatan = $result['kecamatan'];
    $kabupaten_kota = $result['kabupaten_kota'];
    $provinsi = $result['provinsi'];
    $kode_pos = $result['kode_pos'];
    $detail = $result['detail'];
    $id_service = $result['id_service'];
    $status = $result['status_pesanan'];
}

if (isset($_POST['aksi'])) {
    // CREATE DATA
    if ($_POST['aksi'] == 'add') {
        $password = $_POST['pass_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];
        $jenis_akun = $_POST['jenis_akun'];
        $role = $_POST['role'];

        if (empty($password) || empty($nama_pelanggan) || empty($email) || empty($no_telp)) {
            $pesan = "Data ada yang kosong! Harap diisi!";
        }

        if (empty($pesan)) {
            if (insertPelanggan($conn, $password, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role)) {
                $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan!";
                header("location: ../");
            } else {
                echo $stmt->execute();
            }
        }
    }

    // UPDATE DATA
    if ($_POST['aksi'] == 'edit') {
        $id_pelanggan = $_POST['id_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telp'];
        $jenis_akun = $_POST['jenis_akun'];
        $role = $_POST['role'];

        if (isset($_POST['pass_pelanggan'])) {
            $password = $_POST['pass_pelanggan'];
            if (!updatePassword($conn, $id_pelanggan, $password)) {
                error_log('Terdapat kesalahan. Coba lagi nanti!');
            }
        }

        if (updatePelanggan($conn, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan)) {
            $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
            header("location: ../");
        } else {
            echo $sql;
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
    <title>Kelola - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>

    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <section class="content">
            <form action="index.php" method="POST">
                <h1>
                    <?= isset($_GET['ubah']) ? "Edit Data" : "Tambah Data" ?>
                </h1>
                <hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>

                <input type="hidden" value="<?= $id_pelanggan ?>" name="id_pelanggan">
                <!-- <div class="input-box">
                    <label for="no">No Pesanan</label>
                    <input type="text" id="no" name="no" value="<?= $no_pesanan ?>">
                </div> -->
                <div class="input-box">
                    <label for="nama">Nama Pelanggan </label>
                    <select name="" id="">
                        <?php $result = $conn->query("SELECT * FROM pelanggan");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_pelanggan'] ?>"><?= $row['nama_pelanggan'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-box">
                    <label for="jalan">Nama Jalan </label>
                    <input type="text" name="nama_jalan" id="jalan" placeholder="Ex: Jl. Kolonel Sugiono No. 13" value="<?= $jalan ?>" required>
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
                    <input type="text" name="detail" id="detail" placeholder="Ex: 61256" value="<?= $detail ?>" required>
                </div>
                <div class="input-box">
                    <label for="detail">Service </label>
                    <select name="" id="">
                        <?php $result = $conn->query("SELECT * FROM service");
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['id_service'] ?>"><?= $row['nama_service'] ?></option>
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

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
</body>

</html>