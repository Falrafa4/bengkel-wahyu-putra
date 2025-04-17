<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/session_admin.php";
    
    if(isset($_GET['hapus'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
        $id_pelanggan = $_GET['hapus'];

        if(deletePelanggan($conn, $id_pelanggan)) {
            $_SESSION['eksekusi'] = "Data Berhasil Dihapus!";
            header("location: ./");
            exit();
        } else {
            echo $stmt->execute();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/global.css">
    <link rel="stylesheet" href="/bengkel-wahyu-putra/assets/css/admin.css">
    <link rel="shortcut icon" href="/bengkel-wahyu-putra/assets/img/logo-wp-circle.png">
    <title>Pelanggan - Bengkel Wahyu Putra</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->
    
    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/admin/aside.php"; ?>

        <div class="utama">
            <section class="daftar-crud">
                <h1>Data Pelanggan</h1><hr>
                <a href="kelola/" class="btn-add"><i class="fas fa-plus"></i> Tambah Data</a>
        
                <?php if(isset($_SESSION['eksekusi'])) {?>
                <div class="success-update">
                    <em><?= $_SESSION['eksekusi'] ?></em>
                    <i class="fas fa-close" onclick="closeAlert()"></i>
                </div>
                <?php unset($_SESSION['eksekusi']); }?>
        
                <?php 
                    $querySelect = "SELECT * FROM pelanggan;";
                    $sql = mysqli_query($conn, $querySelect);
                ?>
        
                <div class="container-card">
                    <?php while ($result = mysqli_fetch_assoc($sql)) { ?>
                    <div class="card">
                        <h2><?= $result['nama_pelanggan']; ?></h2>
                        <p><i class="fas fa-phone"></i> <?= $result['no_telp']; ?></p>
                        <p><i class="fas fa-envelope"></i> <?= $result['email']; ?></p>
                        <em class="role <?= $result['role']; ?>"><?= $result['role']; ?></em>
                        <em class="type <?= $result['jenis_akun']; ?>"><?= $result['jenis_akun']; ?></em>
        
                        <div class="action-btn">
                            <a 
                            href="<?php if($result['role'] == 'Admin') {echo '#';} 
                                        else {echo 'kelola/index.php?ubah=' . $result['id_pelanggan']; }?>"
                            
                            class="btn edit"
                            onclick="<?php if($result['role'] == 'Admin') {
                                echo "return Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Can\'t edit this account (Administrator Account). Please contact your developer.',
                                    });";
                            }?>">
                            <i class="fas fa-pen-to-square"></i> Edit
                            </a>
                            <a  
                            href="<?php if($result['role'] == 'Admin') {echo '#';}
                                        else {echo './?hapus=' . $result['id_pelanggan'];} ?>" 
                            
                            class="btn hapus"
                            data-role="<?= $result['role'] ?>"
                            data-id="<?= $result['id_pelanggan'] ?>"
                            
                            >
                            <i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="/bengkel-wahyu-putra/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.btn.hapus').forEach(button => {
            button.addEventListener('click', function(e){
            const role = this.dataset.role;
            const id = this.dataset.id;
            const href = this.getAttribute('href');

            e.preventDefault();

            if(role === 'Admin') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Can\'t delete this account (Administrator Account). Please contact your developer.',
                });
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success'
                        });
                        window.location.href = href;
                    }
                });
            }
        })
    })
    </script>
</body>
</html>