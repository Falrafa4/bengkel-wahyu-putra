<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
session_start();

$id_pelanggan = $_SESSION['data']['id_pelanggan'];

$stmt = $conn->prepare('DELETE FROM pelanggan WHERE id_pelanggan = ?');
$stmt->bind_param('i', $id_pelanggan);
$result = $stmt->execute();

if($result) {
    echo "<script>
    alert('Akun berhasil dihapus. Selamat Tinggal.');
    location.href = 'login/';
    </script>";
}