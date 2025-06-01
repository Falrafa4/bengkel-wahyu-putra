<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
session_start();

$id_pelanggan = $_SESSION['data']['id_pelanggan'];

$stmt = $conn->prepare('DELETE FROM pelanggan WHERE id_pelanggan = ?');
$stmt->bind_param('i', $id_pelanggan);
$result = $stmt->execute();

if ($result) {
    $alert = 'Swal.fire({
            title: "Logout",
            text: "Akun anda berhasil dihapus.",
            icon: "success",
            timer: 1500,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            location.href = "login/";
        });';
    session_destroy();
} else {
    $alert = 'Swal.fire({
            title: "Error",
            text: "Akun anda gagal dihapus.",
            icon: "error",
            timer: 1500,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            location.href = "login/";
        });';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="shortcut icon" href="../assets/img/logo-wp-circle.png">

    <!-- Sweetalert2 -->
    <script src="../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Logout</title>
</head>

<body>
    <script>
        <?= $alert ?>
    </script>
</body>

</html>