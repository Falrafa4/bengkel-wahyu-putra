<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
    
    if(isset($_POST['aksi']) || isset($_GET['ubah'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
    }

    $id_pelanggan = '';
    $nama_pelanggan = '';
    $email = '';
    $no_telp = '';
    $jenis_akun = '';
    $role = '';
    $pesan = '';

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

    if(isset($_POST['aksi'])) {
        // CREATE DATA
        if($_POST['aksi'] == 'add'){
            $password = $_POST['pass_pelanggan'];
            $nama_pelanggan =$_POST['nama_pelanggan'];
            $email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $jenis_akun = $_POST['jenis_akun'];
            $role = $_POST['role'];

            if(empty($password) || empty($nama_pelanggan) || empty($email) || empty($no_telp)) {
                $pesan = "Data ada yang kosong! Harap diisi!";
            }

            if(empty($pesan)) {
                if(insertPelanggan($conn, $password, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role)) {
                    $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan!";
                    header("location: ../");
                } else {
                    echo $stmt->execute();
                }
            }
        }

        // UPDATE DATA
        if($_POST['aksi'] == 'edit') {
            $id_pelanggan = $_POST['id_pelanggan'];
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $jenis_akun = $_POST['jenis_akun'];
            $role = $_POST['role'];

            if(isset($_POST['pass_pelanggan'])) {
                $password = $_POST['pass_pelanggan'];
                if(!updatePassword($conn, $id_pelanggan, $password)) {
                    die('Terdapat kesalahan. Coba lagi nanti!');
                }
            }

            if(updatePelanggan($conn, $nama_pelanggan, $email, $no_telp, $jenis_akun, $role, $id_pelanggan)) {
                $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
                header("location: ../");
            } else {
                die('Terjadi kesalahan saat update data :(');
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
            <form action="index.php" method="POST">
                <h1>
                    <?= isset($_GET['ubah']) ? "Edit Data Pelanggan" : "Tambah Data Pelanggan" ?>
                </h1><hr>
                <span style="color: red; font-style:italic;"><?= $pesan ?></span>
    
                <input type="hidden" value="<?= $id_pelanggan ?>" name="id_pelanggan">
                <div class="input-box">
                    <label for="nama">Nama Pelanggan </label>
                    <input type="text" name="nama_pelanggan" id="nama" placeholder="Ex: Rafa Asad" value="<?= $nama_pelanggan ?>" required>
                </div>
                <div class="input-box">
                    <label for="email">Email </label>
                    <input type="email" name="email" id="email" placeholder="Ex: user@gmail.com" value="<?= $email ?>" required>
                </div>
                <div class="input-box">
                    <label for="pass_user"><?= isset($_GET['ubah']) ? "Change Password (Optional)" : "New Password" ?></label>
                    <span><i class="fas fa-eye-slash" id="eye" onclick="openPass(eye)"></i></span>
                    <input type="password" name="pass_pelanggan" id="pass_user" <?php if(!isset($_GET['ubah'])) {echo "required";} ?>>
                </div>
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