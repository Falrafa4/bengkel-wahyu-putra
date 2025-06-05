<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['data']) || $_SESSION['data']['role'] !== 'User'){
    header("location: /bengkel-wahyu-putra/auth/login/");
    exit();
}