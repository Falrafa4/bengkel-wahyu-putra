<?php 
    $namaFolder = basename(dirname($_SERVER['SCRIPT_NAME'])); //mengambil nama url terakhir
?>
<aside>
    <h1>Bengkel Wahyu Putra</h1>
    <div class="nav-dash">
        <a href="/bengkel-wahyu-putra/dashboard/admin/" class="<?= ($namaFolder == "admin") ? 'active' : '' ?>"><i class="fas fa-house"></i>Dashboard</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/services" class="<?= ($namaFolder == "services") ? 'active' : '' ?>"><i class="fas fa-screwdriver-wrench"></i>Layanan</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/pelanggan/" class="<?= ($namaFolder == "pelanggan") ? 'active' : '' ?>"><i class="fas fa-users"></i>Pelanggan</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/pemesanan/" class="<?= ($namaFolder == "pemesanan") ? 'active' : '' ?>"><i class="fas fa-bag-shopping"></i>Pemesanan</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/pemesanan_item/" class="<?= ($namaFolder == "pemesanan_item") ? 'active' : '' ?>"><i class="fas fa-list"></i>Pemesanan Item</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/penawaran/" class="<?= ($namaFolder == "penawaran") ? 'active' : '' ?>"><i class="fas fa-envelope"></i>Penawaran</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/pembayaran/" class="<?= ($namaFolder == "pembayaran") ? 'active' : '' ?>"><i class="fas fa-money-bill"></i>Pembayaran</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/penilaian/" class="<?= ($namaFolder == "penilaian") ? 'active' : '' ?>"><i class="fas fa-comment"></i>Penilaian</a>
        <a href="/bengkel-wahyu-putra/dashboard/admin/settings/" class="<?= ($namaFolder == "settings") ? 'active' : '' ?>"><i class="fas fa-gear"></i>Settings</a>
    </div>
</aside>