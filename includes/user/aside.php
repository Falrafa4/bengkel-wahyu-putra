<?php
$namaFolder = basename(dirname($_SERVER['SCRIPT_NAME'])); //mengambil nama url terakhir
?>
<aside>
    <h1>Bengkel Wahyu Putra</h1>
    <div class="nav-dash">
        <a href="/bengkel-wahyu-putra/dashboard/" class="<?= ($namaFolder == "dashboard") ? 'active' : '' ?>"><i class="fas fa-house"></i>Dashboard</a>
        <a href="/bengkel-wahyu-putra/dashboard/pages/new-order" class="<?= ($namaFolder == "new-order") ? 'active' : '' ?>"><i class="fas fa-bag-shopping"></i>Buat Pesanan</a>
        <a href="/bengkel-wahyu-putra/dashboard/pages/my-order" class="<?= ($namaFolder == "my-order"  || $namaFolder == "detail") ? 'active' : '' ?>"><i class="fas fa-list"></i>Daftar Pesanan</a>
        <a href="/bengkel-wahyu-putra/dashboard/pages/notification" class="<?= ($namaFolder == "notification") ? 'active' : '' ?>"><i class="fas fa-bell"></i>Notifikasi</a>
        <a href="/bengkel-wahyu-putra/dashboard/pages/help" class="<?= ($namaFolder == "help") ? 'active' : '' ?>"><i class="fas fa-comment"></i>Bantuan</a>
        <a href="/bengkel-wahyu-putra/dashboard/pages/settings" class="<?= ($namaFolder == "settings") ? 'active' : '' ?>"><i class="fas fa-gear"></i>Pengaturan</a>
        <a href="/bengkel-wahyu-putra/auth/logout.php" class="<?= ($namaFolder == "logout") ? 'active' : '' ?>"><i class="fas fa-right-from-bracket"></i>Logout</a>
    </div>
</aside>