<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari form
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan Password tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }

    // Username dan password yang valid
    $valid_user = "admin";
    $valid_pass = "1234";
   
    // Cek apakah username dan password cocok
    if ($username === $valid_user && $password === $valid_pass) {
        // Login berhasil, simpan data login dalam session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        echo "<script>alert('Login berhasil!'); window.location.href='beranda.php';</script>";
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Username atau Password salah!'); window.history.back();</script>";
        exit;
    }
} else {
    // Jika bukan POST request, redirect ke halaman login
    header("Location: menu login.php");
    exit;
}
?>
