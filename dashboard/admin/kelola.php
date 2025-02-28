<?php 
    //inisialisasi session
    session_start();
    include "../../config/koneksi.php";

    //untuk menampilkan data yang akan diedit
    $id_pelanggan = '';
    $nama_pelanggan = '';
    $email = '';
    $no_telp = '';
    $jenis_akun = '';
    $role = '';

    if(isset($_GET['ubah'])){
        $id_pelanggan = $_GET['ubah'];

        //query SELECT untuk memasukkan data ke dalam form => untuk diedit
        $query = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan';";
        $sql = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($sql);

        //data di bawah akan diletakkan pada tiap input-an
        $id_pelanggan = $result['id_pelanggan'];
        $email = $result['email'];
        $nama_pelanggan = $result['nama_pelanggan'];
        $no_telp = $result['no_telp'];
        $jenis_akun = $result['jenis_akun'];
        $role = $result['role'];
    }

    if(!isset($_SESSION['data']['role']) || $_SESSION['data']['role'] !== 'Admin'){
        //header("location: ../../auth/login/"); // arahkan ke login.php
        exit("You don't have permission to access this!");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/kelola.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    <title>Kelola - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php include "../../includes/nav.php"; ?>

    <main>
        <form action="../../auth/proses.php" method="POST">
            <h1>
                <?php if(isset($_GET['ubah'])) {echo "Edit Data";} else {echo "Tambah Data";}?>
            </h1><hr>

            <input type="hidden" value="<?= $id_pelanggan ?>" name="id_pelanggan">
            <div class="input-box">
                <label for="nama">Nama Pelanggan </label>
                <input type="text" name="nama_pelanggan" id="nama" placeholder="Ex: Rafa Asad" value="<?= $nama_pelanggan ?>" required>
            </div>
            <div class="input-box">
                <label for="email">Email </label>
                <input type="email" name="email" id="email" placeholder="Ex: user@gmail.com" value="<?= $email ?>" required>
            </div>
            <?php if(!isset($_GET['ubah'])){ ?>
            <div class="input-box">
                <label for="password">New Password </label>
                <span><i class="fas fa-eye-slash" id="eye" onclick="openPass()"></i></span>
                <input type="password" name="pass_pelanggan" id="password">
            </div>
            <?php } ?>
            <div class="input-box">
                <label for="notelp">No. Telepon </label>
                <input type="text" name="no_telp" id="notelp" placeholder="Ex: 081122334455" value="<?= $no_telp ?>" required>
            </div>
            <div class="input-box">
                <label for="jenis_akun">Jenis Akun </label>
                <select name="jenis_akun" id="jenis_akun" required>
                    <option value="Pribadi" <?php if($jenis_akun == 'Pribadi') {echo "selected";}?>>Pribadi</option>
                    <option value="Perusahaan" <?php if($jenis_akun == 'Perusahaan') {echo "selected";}?>>Perusahaan</option>
                </select>
            </div>
            <div class="input-box">
                <label for="role">Role </label>
                <select name="role" id="role" required>
                    <option value="User" <?php if($role == 'User') {echo "selected";}?>>User</option>
                    <option value="Admin" <?php if($role == 'Admin') {echo "selected";}?>>Admin</option>
                </select>
            </div>
            <?php 
            if(isset($_GET['ubah'])){ ?>
                <button type="submit" name="aksi" value="edit" class="btn-kelola update">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            <?php } else {?>
                <button type="submit" name="aksi" value="add" class="btn-kelola update">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Tambahkan
                </button>
            <?php } ?>
            <a href="admin.php" class="btn-kelola back">
                <i class="fas fa-reply"></i>
                Batal
            </a>
        </form>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>