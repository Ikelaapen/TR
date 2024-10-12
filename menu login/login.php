<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari form
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan Password tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }

    // Daftar pengguna yang valid
    $users = [
        "Nathania Kumalasari" => "672022135",
        "Eunike Loise Laapen" => "672022190",
        "Tiara Naomi Sanda" => "672022258",
        "Armastya Reyhan Putra Rusmantara" => "672022338"
    ];

    // Cek apakah username dan password cocok
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        echo "<script>alert('Login berhasil!'); window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Username atau Password salah!'); window.history.back();</script>";
    }
} else {
    // Jika bukan POST request, redirect ke halaman login
    header("Location: login.html");
    exit;
}
?>
