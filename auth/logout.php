<?php
session_start();
session_destroy(); //tinggal menghentikan sesi

?>

<script>
    alert('Anda berhasil logout. Selamat Tinggal!');
    location.href = "login/";
</script>