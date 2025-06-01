<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/koneksi.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/functions/functions.php";
    
    $pesan = "";
    if(isset($_POST['daftar'])) {
        $password = $_POST['pass'];
        $nama_pelanggan = $_POST['nama'];
        $email = $_POST['email'];
        $no_telp = $_POST['telp'];
        $jenis_akun = $_POST['jenis_akun'];
        $nama_perusahaan = $_POST['nama_perusahaan'];
        $role = "User";

        $queryCheck = "SELECT email FROM pelanggan WHERE email = ?";
        $stmt = $conn->prepare($queryCheck);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows < 1) {
            if(insertPelanggan($conn, $password, $nama_pelanggan, $email, $no_telp, $jenis_akun, $nama_perusahaan, $role)) {
                $pesan = '<script>
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Sukses membuat akun! silahkan login.",
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href="../../dashboard/admin/";
                        });
                        </script>';
                //$pesan = "<em class='sukses'>Sukses membuat akun! Silahkan <a href='../login/'>login.</a></em>";
            } else {
                $pesan = "<em class='error'>Terjadi Kesalahan! Silahkan Coba Kembali Nanti.</em>";
            }
        } else {
            $pesan = "<em class='error'>Email sudah didaftarkan. Harap login atau memilih email yang lain.</em>";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/daftar.css">
    <link rel="shortcut icon" href="../../assets/img/logo-wp-circle.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.css">
    
    <!-- Sweetalert2 -->
    <script src="../../assets/sweetalert2/sweetalert2.all.min.js"></script>
    
    <title>Daftar - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/bengkel-wahyu-putra/includes/global/nav.php"; ?>
    <!-- NAVBAR END -->

    <main>
        <form action="index.php" method="post" id="formDaftar">
            <h2>Daftar Akun</h2>
            <p>Silahkan daftar akun Bengkel Wahyu Putra Anda</p>
            <em id="validate" class="error"></em>
            <?= $pesan ?>

            <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" autofocus required><br>
            <input type="email" name="email" id="email" placeholder="Alamat Email" required>
            
            <input type="tel" name="telp" id="telp" placeholder="Nomor Telepon" required>
            
            <label for="jenis_akun" class="label">Jenis Akun: </label>
            <select name="jenis_akun" id="jenis_akun" onchange="inputPT()">
                <option value="Pribadi">Pribadi</option>
                <option value="Perusahaan">Perusahaan</option>
            </select>

            <div class="input-box" id="perusahaan" style="display: none;">
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan">
            </div>

            <div class="input-box">
                <span><i class="fas fa-eye-slash" onclick="openPass(this)"></i></span>
                <input type="password" minlength="8" name="pass" id="pass" placeholder="Buat Password" required>
            </div>
            
            <div class="input-box">
                <span><i class="fas fa-eye-slash" onclick="openPass(this)"></i></span>
                <input type="password" name="ulangi_pass" id="ulangi_pass" placeholder="Ulangi Password" required>
            </div>
            <p class="msgPass" style="font-size: 14px; margin: 0px 0px 10px 0px; font-style: italic;"></p>

            
            <button type="submit" name="daftar" id="btnDaftar">Daftar</button>
            <p style="font-size: 14px; text-align: center; color: black; margin: 20px 0px 0px 0px">Sudah punya akun? <a href="../login/">Login di sini!</a></p>
        </form>
    </main>

    <script src="../../assets/js/main.js"></script>

    <script> 
        //Script For Validate Form DAFTAR
        let form = document.getElementById('formDaftar')
        let nama = document.getElementById('nama');
        let email = document.getElementById('email');
        let tgl_lahir = document.getElementById('tgl_lahir');
        let telp = document.getElementById('telp');
        let username = document.getElementById('username');
        let validate = document.getElementById('validate');

        let pass = document.getElementById('pass');
        let ulangi_pass = document.getElementById('ulangi_pass');
        let msgPass = document.querySelector('.msgPass');

        document.getElementById("btnDaftar").addEventListener("click", function(){
            if(nama.value === "" || email.value === "" || tgl_lahir.value === "" || telp.value === "" || username.value === "" || pass.value === "" || ulangi_pass.value === ""){
                event.preventDefault();
                validate.innerHTML = "Data masih ada yang kosong. Harap diisi!";
                location.href = "#";
            } else {
                validate.innerHTML = "";
            }
        })
        
        formDaftar.addEventListener("submit", function(){
            if(ulangi_pass.value === "") {
                msgPass.innerHTML = "";
                event.preventDefault();
            } else if(ulangi_pass.value === pass.value ){
                msgPass.innerHTML = "Password Cocok!"
                msgPass.style.color = "green";
            } else {
                msgPass.innerHTML = "Password Tidak Cocok. Harap Coba Lagi."
                msgPass.style.color = "red";
                event.preventDefault();
            }
        })
        
        ulangi_pass.addEventListener("input", function(){
            if(ulangi_pass.value === "") {
                msgPass.innerHTML = "";
            } else if(ulangi_pass.value === pass.value ){
                msgPass.innerHTML = "Password Cocok!"
                msgPass.style.color = "green";
            } else {
                msgPass.innerHTML = "Password Tidak Cocok. Harap Coba Lagi."
                msgPass.style.color = "red";
            }
        })

        // onchange event untuk input jenis akun
        function inputPT() {
            const jenis = document.getElementById('jenis_akun').value;
            const perusahaan = document.getElementById('perusahaan');

            perusahaan.style.display = 'none';

            if (jenis === 'Perusahaan') {
                perusahaan.style.display = 'block';
            } else if (jenis === 'Pribadi') {
                perusahaan.style.display = 'none';
            }
        }
    </script>
</body>
</html>