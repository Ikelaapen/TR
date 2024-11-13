<?php
$servername = "localhost:8111";
$username = "root";
$password = "";
$dbname = "tr";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
