<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$idpenghuni = $_POST['idpenghuni'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$noHp = $_POST['noHp'];
$tglRegistrasi = $_POST['tglRegistrasi'];
$kamar = $_POST['kamar'];

$sql = "INSERT INTO penghuni (idpenghuni, nama, alamat, noHp, tglRegistrasi, kamar)
        VALUES ('$idpenghuni', '$nama', '$alamat', '$noHp', '$tglRegistrasi', '$kamar')";

if ($conn->query($sql) === TRUE){
    header("Location: dathuni.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>