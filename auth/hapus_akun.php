<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
session_start();

$id_pelanggan = $_SESSION['data']['id_pelanggan'];

$delete = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
?>

<script>
    alert('Akun berhasil dihapus. Selamat Tinggal.');
    location.href = "login/";
</script>