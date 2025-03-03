<?php
    session_start();
    include "../config/koneksi.php";
    
    if(isset($_POST['aksi'])) {
        // CREATE DATA
        if($_POST['aksi'] == 'add'){
            $password = md5($_POST['pass_pelanggan']);
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $jenis_akun = $_POST['jenis_akun'];
            $role = $_POST['role'];

            $query = "INSERT INTO pelanggan (password, nama_pelanggan, email, no_telp, jenis_akun, role) VALUES ('$password', '$nama_pelanggan','$email','$no_telp','$jenis_akun', '$role')";
            $sql = mysqli_query($conn, $query);

            if($sql) {
                $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan!";
                header("location: ../dashboard/admin/admin.php");
            } else {
                echo $sql;
            }
        }

        // UPDATE DATA
        if($_POST['aksi'] == 'edit') {
            $id_pelanggan = $_POST['id_pelanggan'];
            //$password = md5($_POST['pass_pelanggan']);
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $email = $_POST['email'];
            $no_telp = $_POST['no_telp'];
            $jenis_akun = $_POST['jenis_akun'];
            $role = $_POST['role'];

            
            
            $query = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', email = '$email', no_telp = '$no_telp', jenis_akun = '$jenis_akun', role = '$role' WHERE id_pelanggan = $id_pelanggan;";
            $sql = mysqli_query($conn, $query);

            if($sql) {
                $_SESSION['eksekusi'] = "Data Berhasil Diubah!";
                header("location: ../dashboard/admin/admin.php");
            } else {
                echo $sql;
            }
        }
    }

    if(isset($_GET['hapus'])) {
        $id_pelanggan = $_GET['hapus'];

        $query = "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan';";
        $sql = mysqli_query($conn, $query);

        if($sql) {
            $_SESSION['eksekusi'] = "Data Berhasil Dihapus!";
            header("location: ../dashboard/admin/admin.php");
        } else {
            echo $sql;
        }
    }