<?php
$namaFolder = basename(dirname($_SERVER['SCRIPT_NAME'])); //mengambil nama url terakhir

$path2 = dirname($_SERVER['SCRIPT_NAME']);
$explode = explode('/', trim($path2, '/'));
$namaFolder2 = $explode[count($explode) - 2];
?>

<aside id="sidebar">
    <h1>Bengkel <br> Wahyu Putra</h1>
    <div class="nav-dash">
        <a href="/bengkel-wahyu-putra/dashboard/admin/" class="<?= ($namaFolder == "admin") ? 'active' : '' ?>">
            <i class="fas fa-house"></i>
            Dashboard
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/services" class="<?= ($namaFolder == "services" || $namaFolder2 == "services") ? 'active' : '' ?>">
            <i class="fas fa-screwdriver-wrench"></i>
            Layanan
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/pelanggan/" class="<?= ($namaFolder == "pelanggan" || $namaFolder2 == "pelanggan") ? 'active' : '' ?>">
            <i class="fas fa-users"></i>
            Pelanggan
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/pemesanan/" class="<?= ($namaFolder == "pemesanan" || $namaFolder2 == "pemesanan") ? 'active' : '' ?>">
            <i class="fas fa-bag-shopping"></i>
            Pemesanan
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/pemesanan_item/" class="<?= ($namaFolder == "pemesanan_item" || $namaFolder2 == "pemesanan_item") ? 'active' : '' ?>">
            <i class="fas fa-list"></i>
            Pemesanan Item
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/penawaran/" class="<?= ($namaFolder == "penawaran" || $namaFolder2 == "penawaran") ? 'active' : '' ?>">
            <i class="fas fa-envelope"></i>
            Penawaran
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/negosiasi/" class="<?= ($namaFolder == "negosiasi" || $namaFolder2 == "negosiasi") ? 'active' : '' ?>">
            <i class="fas fa-handshake"></i>
            Negosiasi Penawaran
        </a>

        <a href="/bengkel-wahyu-putra/dashboard/admin/pembayaran/" class="<?= ($namaFolder == "pembayaran" || $namaFolder2 == "pembayaran") ? 'active' : '' ?>">
            <i class="fas fa-money-bill"></i>
            Pembayaran
        </a>

        <!-- <a href="/bengkel-wahyu-putra/dashboard/admin/penilaian/" class="<?= ($namaFolder == "penilaian" || $namaFolder2 == "penilaian") ? 'active' : '' ?>">
            <i class="fas fa-comment"></i>
            Penilaian
        </a> -->

        <!-- <a href="/bengkel-wahyu-putra/dashboard/admin/settings/" class="<?= ($namaFolder == "settings") ? 'active' : '' ?>">
            <i class="fas fa-gear"></i>
            Settings
        </a> -->
    </div>
</aside>
<div id="sideBarIcon" onclick="closeSideBar()">
    <i class="fa-solid fa-chevron-left"></i>
</div>