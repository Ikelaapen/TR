<?php
$servername = "localhost:8111";
$username = "root";
$password = "";
$dbname = "tr";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
