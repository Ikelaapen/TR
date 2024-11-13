<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_penghuni = $_POST['id_penghuni'];
$nama = $_POST['nama'];
$tglbayar = $_POST['tglbayar'];
$tagihan = $_POST['tagihan'];
$status= $_POST['status'];


$sql = "INSERT INTO tagihan (id_penghuni, nama, tglbayar, tagihan, status)
        VALUES ('$id_penghuni', '$nama','$tglbayar', '$tagihan', '$status')";

if ($conn->query($sql) === TRUE){
    header("Location: tagihan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>