<!-- THIS INCLUDES ONLY FOR PAGES (EXCEPT HOME) -->
<nav>
    <div class="logo">
        <a href="#"><img src="../../assets/img/logo-wp-circle.png" alt="logo-bengkel-wp"></a>
    </div>
    <div class="navbar">
        <ul>
        <?php 
        $namaFolder = basename(dirname($_SERVER['SCRIPT_NAME'])); //mengambil nama url terakhir
        ?>
            <li><a href="../../">Home</a></li>
            <li><a href="../../pages/services/" class="<?= ($namaFolder == "services") ? 'active' : '' ?>">Services</a></li>
            <li><a href="../../pages/gallery/" class="<?= ($namaFolder == "gallery") ? 'active' : '' ?>">Gallery</a></li>
            <li><a href="../../pages/contact/" class="<?= ($namaFolder == "contact") ? 'active' : '' ?>">Contact</a></li>
            <li><a href="../../pages/about/" class="<?= ($namaFolder == "about") ? 'active' : '' ?>">About</a></li>
        </ul>
    </div>
    <div class="right-bar">
        <ul>
        <?php if(!isset($_SESSION['data'])){ ?>
            <li><a href="../../auth/login/" class="login <?= ($namaFolder == "login") ? 'active' : '' ?>">Login</a></li>
        <?php } else {?>
        <li>
            <i class="fas fa-user-circle"></i>
            <span><?= $_SESSION['data']['username']; ?></span>
            <div class="dropdown">
                <ul>
                    <li><a href="../../auth/dashboard/<?= ($_SESSION['data']['role'] == "Admin") ? 'admin.php' : 'user.php' ?>">Dashboard</a></li>
                    <li><a href="../../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </li>
        <?php } ?>
        </ul>
    </div>


    <!-- sidebar -->
    <a id="toggleSideBar" onclick="toggleClick()"><i class="fas fa-bars"></i></a>
    <div class="ham-bar">
        <a href="../../">Home</a>
        <a href="../../pages/services/" class="<?= ($namaFolder == "services") ? 'active' : '' ?>">Services</a>
        <a href="../../pages/gallery/" class="<?= ($namaFolder == "gallery") ? 'active' : '' ?>">Gallery</a>
        <a href="../../pages/contact/" class="<?= ($namaFolder == "contact") ? 'active' : '' ?>">Contact</a>
        <a href="../../pages/about/" class="<?= ($namaFolder == "about") ? 'active' : '' ?>">About</a>
        <a href="../../auth/login/" class="<?= ($namaFolder == "login") ? 'active' : '' ?>">Login</a>
    </div>
</nav>