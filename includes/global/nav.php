<!-- THIS INCLUDES ONLY FOR PAGES (EXCEPT HOME) -->
<nav>
    <div class="logo">
        <a href="#"><img src="/bengkel-wahyu-putra/assets/img/logo-wp-circle.png" alt="logo-bengkel-wp"></a>
    </div>
    <div class="navbar">
        <ul>
        <?php 
        $namaFolder = basename(dirname($_SERVER['SCRIPT_NAME'])); //mengambil nama url terakhir
        ?>
            <li><a href="/bengkel-wahyu-putra/">Home</a></li>
            <li><a href="/bengkel-wahyu-putra/pages/services/" class="<?= ($namaFolder == "services") ? 'active' : '' ?>">Services</a></li>
            <li><a href="/bengkel-wahyu-putra/pages/gallery/" class="<?= ($namaFolder == "gallery") ? 'active' : '' ?>">Gallery</a></li>
            <li><a href="/bengkel-wahyu-putra/pages/contact/" class="<?= ($namaFolder == "contact") ? 'active' : '' ?>">Contact</a></li>
            <li><a href="/bengkel-wahyu-putra/pages/about/" class="<?= ($namaFolder == "about") ? 'active' : '' ?>">About</a></li>
        </ul>
    </div>
    <div class="right-bar">
        <ul>
        <?php if(!isset($_SESSION['data'])){ ?>
            <li><a href="/bengkel-wahyu-putra/auth/login/" class="login <?= ($namaFolder == "login") ? 'active' : '' ?>">Login</a></li>
        <?php } else {?>
        <li class="profil">
            <i class="fas fa-user-circle"></i>
            <div class="dropdown">
                <ul>
                    <li><a href="/bengkel-wahyu-putra/dashboard/<?= ($_SESSION['data']['role'] == "Admin") ? 'admin/' : '' ?>">Dashboard</a></li>
                    <li><a href="/bengkel-wahyu-putra/auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </li>
        <?php } ?>
        </ul>
    </div>


    <!-- sidebar -->
    <a id="toggleSideBar" onclick="toggleClick()"><i class="fas fa-bars" id="toggleIcon"></i></a>
    <div class="ham-bar">
        <a href="/bengkel-wahyu-putra/">Home</a>
        <a href="/bengkel-wahyu-putra/pages/services/" class="<?= ($namaFolder == "services") ? 'active' : '' ?>">Services</a>
        <a href="/bengkel-wahyu-putra/pages/gallery/" class="<?= ($namaFolder == "gallery") ? 'active' : '' ?>">Gallery</a>
        <a href="/bengkel-wahyu-putra/pages/contact/" class="<?= ($namaFolder == "contact") ? 'active' : '' ?>">Contact</a>
        <a href="/bengkel-wahyu-putra/pages/about/" class="<?= ($namaFolder == "about") ? 'active' : '' ?>">About</a>
        <a href="/bengkel-wahyu-putra/auth/login/" class="<?= ($namaFolder == "login") ? 'active' : '' ?>">Login</a>
    </div>
</nav>