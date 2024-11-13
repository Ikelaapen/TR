<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_penghuni = $_GET['id_penghuni'];


$sql = "DELETE FROM tagihan WHERE id_penghuni='$id_penghuni'";

if ($conn->query($sql) === TRUE){
    header("Location: tagihan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>