<?php
session_start();
session_destroy(); //tinggal menghentikan sesi

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="shortcut icon" href="../assets/img/logo-wp-circle.png">

    <!-- Sweetalert2 -->
    <script src="../assets/sweetalert2/sweetalert2.all.min.js"></script>

    <title>Logout</title>
</head>
<body>
    <script>
        Swal.fire({
            title: "Logout",
            text: "Anda berhasil logout. Selamat tinggal!",
            icon: "success"
        }).then(() => {
            location.href = "login/";
        });
        // alert('Anda berhasil logout. Selamat Tinggal!');
        // location.href = "login/";
    </script>
</body>
</html>