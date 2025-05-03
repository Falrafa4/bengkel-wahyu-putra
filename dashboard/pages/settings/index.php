<?php
//inisialisasi session
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_user.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";

$id_pelanggan = '';
$nama_pelanggan = '';
$email = '';
$no_telp = '';
$jenis_akun = '';

if (isset($_SESSION['data'])) {
    $id_pelanggan = $_SESSION['data']['id_pelanggan'];
    $nama_pelanggan = $_SESSION['data']['nama_pelanggan'];
    $email = $_SESSION['data']['email'];
    $no_telp = $_SESSION['data']['no_telp'];
    $jenis_akun = $_SESSION['data']['jenis_akun'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/global.css">
    <link rel="stylesheet" href="../../../assets/css/user.css">
    <link rel="shortcut icon" href="../../../assets/img/logo-wp-circle.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.css">

    <!-- Sweetalert2 -->
    <script src="../../../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Profil - Bengkel Wahyu Putra</title>
</head>

<body>
    <?php
    // update profil
    if (isset($_POST['update_profil'])) {
        if (updateProfil($_POST, $conn)) {
            echo '<script>
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "Data berhasil ubah!"
            }).then(() => {
                location.href = "../../";
            });
            </script>';
        } else {
            echo $sql;
        }
    }

    // update password
    if (isset($_POST['update_pw'])) {
        $pw_old = $_POST['pw_old'];
        $pw_new = $_POST['pw_new'];
        $repeat_pw = $_POST['repeat_pw'];

        $pw_from_db = getPassword($conn, $email);

        if (password_verify($pw_old, $pw_from_db)) {
            if (updatePassword($conn, $id_pelanggan, $pw_new)) {
                echo '
                    <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Password berhasil diupdate"
                    });
                    </script>
                    ';
            } else {
                echo '
                    <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Gagal update password. Silakan coba lagi."
                    });
                    </script>
                    ';
            }
        } else {
            echo '
                <script>
                Swal.fire({
                    icon: "error",
                    title: "Password salah!",
                    text: "Password lama tidak sama dengan yang tersimpan."
                });
                </script>
                ';
        }
    }
    ?>

    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main class="settings">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/user/aside.php"; ?>

        <div class="utama">
            <h1 class="profile-head">Pengaturan</h1>
            <section class="profile">
                <form action="index.php" method="post">
                    <table>
                        <tr>
                            <td>
                                <h2>Edit Profil</h2>
                            </td>
                            <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan ?>">
                        </tr>
                        <tr>
                            <td class="info">Nama Lengkap</td>
                            <td class="data"><input type="text" name="nama_pelanggan" value="<?= $nama_pelanggan ?>"></td>
                        </tr>
                        <tr>
                            <td class="info">Email</td>
                            <td class="data"><input type="email" name="email" value="<?= $email ?>"></td>
                        </tr>
                        <tr>
                            <td class="info">No. Telepon</td>
                            <td class="data"><input type="tel" name="no_telp" value="<?= $no_telp ?>"></td>
                        </tr>
                        <tr>
                            <td class="info">Jenis Akun</td>
                            <td class="data">
                                <select name="jenis_akun">
                                    <option value="Pribadi" <?php if ($jenis_akun == "Pribadi") {
                                                                echo "selected";
                                                            } ?>>Pribadi</option>
                                    <option value="Perusahaan" <?php if ($jenis_akun == "Perusahaan") {
                                                                    echo "selected";
                                                                } ?>>Perusahaan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="button"><button type="submit" name="update_profil"><i class="fas fa-pen-to-square"></i> Update Profil</button></td>
                        </tr>
                    </table>
                </form>
            </section>
            <section class="password" id="password_section">
                <h2>Ubah Password</h2>
                <form action="index.php" method="post" id="updatePwForm">
                    <div class="input-box">
                        <label for="pw-old">Password Lama</label>
                        <span><i class="fas fa-eye-slash" onclick="openPass(this)"></i></span>
                        <input type="password" name="pw_old" class="pass_user">
                    </div>
                    <div class="input-box">
                        <label for="pw-new">Password Baru</label>
                        <span><i class="fas fa-eye-slash" onclick="openPass(this)"></i></span>
                        <input type="password" name="pw_new" class="pass_user">
                    </div>
                    <div class="input-box">
                        <label for="repeat-pw">Ulangi Password Baru</label>
                        <span><i class="fas fa-eye-slash" onclick="openPass(this)"></i></span>
                        <input type="password" name="repeat_pw" class="pass_user">
                    </div>
                    <div class="button">
                        <button type="submit" name="update_pw"><i class="fas fa-pen-to-square"></i> Update Password</button>
                    </div>
                </form>
            </section>
            <section class="hapus-akun" id="hapus">
                <h2>Hapus Akun</h2>
                <em>Tindakan ini dapat beresiko. Semua data dan pemesanan yang telah disimpan akan dihapus seluruhnya secara permanen dan tidak dapat dikembalikan.</em>
                <a href="#hapus" id="btn-hapus"><i class="fas fa-trash" style="font-size: 14px;"></i> Hapus Akun</a>
            </section>
        </div>
    </main>

    <script src="../../../assets/js/main.js"></script>
    <script>
        const pw_old = document.getElementById('pw-old');
        const pw_new = document.getElementById('pw-new');
        const repeat_pw = document.getElementById('repeat-pw');
        const form_pw = document.getElementById('updatePwForm');

        form_pw.addEventListener('submit', function(e) {
            // Cek kalau ada yang kosong
            if (pw_old.value === '' || pw_new.value === '' || repeat_pw.value === '') {
                e.preventDefault(); // tahan form
                Swal.fire({
                    icon: "warning",
                    title: "Form belum lengkap!",
                    text: "Harap isi semua kolom.",
                });
            }

            // Cek kalau password baru tidak cocok
            if (pw_new.value !== repeat_pw.value) {
                e.preventDefault(); // tahan form
                Swal.fire({
                    icon: "error",
                    title: "Password tidak cocok!",
                    text: "Password baru dan konfirmasi tidak sama.",
                });
            }
        });

        const btnHapus = document.getElementById('btn-hapus');
        btnHapus.addEventListener('click', function(e) {
            e.preventDefault;

            Swal.fire({
                title: 'Hapus Akun Ini?',
                text: 'Tindakan ini dapat beresiko dan tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Akun',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if(result.isConfirmed) {
                    const {value: email} = await Swal.fire({
                        icon: 'info',
                        title: "Masukkan Email Anda",
                        input: "email",
                        inputLabel: "Email yang Anda daftarkan ke akun ini",
                        inputPlaceholder: "Email",
                        confirmButtonText: 'Lanjut'
                    });
                    if (email === "<?= $_SESSION['data']['email']; ?>") {
                        window.location.href = '../../../auth/hapus_akun.php';
                    } else {
                        Swal.fire("Gagal", "Email tidak cocok!", "error");
                    }
                }
            });
        })
    </script>

</body>

</html>