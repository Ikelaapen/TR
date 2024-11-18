<?php
$koneksi = mysqli_connect("localhost", "root", "", "tagihan");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
