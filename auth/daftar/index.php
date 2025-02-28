<?php 
    include "../../config/koneksi.php";
    
    $pesan = "";
    if(isset($_POST['daftar'])) {
        $password = md5($_POST['pass']);
        $nama_pelanggan = $conn -> real_escape_string($_POST['nama']);
        $no_telp = $_POST['telp'];
        $jenis_akun = $_POST['jenis_akun'];

        $queryCheck = "SELECT username FROM pelanggan WHERE username = '$username'";
        $sqlCheck = mysqli_query($conn, $queryCheck);

        if(mysqli_num_rows($sqlCheck) < 1) {
            $queryAdd = "INSERT INTO pelanggan (username, password, nama_pelanggan, no_telp, jenis_kelamin, tgl_lahir, jenis_akun) VALUES ('$username', '$password', '$nama_pelanggan', '$no_telp', '$jenis_kelamin', '$tgl_lahir', '$jenis_akun');";
            $sqlAdd = mysqli_query($conn, $queryAdd);
    
            if($sqlAdd) {
                $pesan = "<em class='sukses'>Sukses membuat akun! Silahkan <a href='../login/'>login.</a></em>";
            } else {
                $pesan = "<em class='error'>Terjadi Kesalahan! Kode: " . $sqlAdd . "</em>";
            }
        } else if (mysqli_num_rows($sqlCheck) > 1 ) {
            $pesan = "<em class='error'>Username sudah dipakai. Harap memilih yang lain.</em>";
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
    <title>Daftar - Bengkel Wahyu Putra</title>
</head>
<body>
    <!-- NAVBAR -->
    <?php include "../../includes/nav.php"; ?>
    <!-- NAVBAR END -->

    <main>
        <form action="index.php" method="post" id="formDaftar">
            <h2>Daftar Akun</h2>
            <p>Silahkan daftar akun Bengkel Wahyu Putra Anda</p>
            <em id="validate" class="error"></em>
            <?= $pesan ?>

            <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required autocomplete="off"><br>
            <input type="email" name="email" id="email" placeholder="Alamat Email" autocomplete="off">
            
            <input type="tel" name="telp" id="telp" placeholder="Nomor Telepon" required autocomplete="off">
            
            <label for="jenis_akun" class="label">Jenis Akun: </label>
            <select name="jenis_akun" id="jenis_akun">
                <option value="Pribadi">Pribadi</option>
                <option value="Perusahaan">Perusahaan</option>
            </select>

            <input type="password" minlength="8" name="pass" id="pass" placeholder="Buat Password" required><br>
            <input type="password" name="ulangi_pass" id="ulangi_pass" placeholder="Ulangi Password" required><br>
            <p class="msgPass" style="font-size: 14px; margin: 0px 0px 10px 0px; font-style: italic;"></p>

            
            <button type="submit" name="daftar" id="btnDaftar">Daftar</button>
            <p style="font-size: 14px; text-align: center; color: black; margin: 20px 0px 0px 0px">Sudah punya akun? <a href="../login/">Login di sini!</a></p>
        </form>
    </main>


    <script src="https://kit.fontawesome.com/ed13b1bb03.js" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>

    <script> //Script For Validate Form DAFTAR
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
    </script>
</body>
</html>