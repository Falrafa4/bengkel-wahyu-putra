<?php
include("koneksi.php");
session_start();

$username = $_SESSION['user']['username'];

$delete = mysqli_query($conn, "DELETE FROM pelanggan WHERE username='$username'");
?>

<script>
    alert('Akun berhasil dihapus. Selamat Tinggal.');
    location.href = "login/";
</script>