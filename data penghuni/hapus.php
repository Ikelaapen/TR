<?php
$conn = new mysqli("localhost:8111", "root", "", "data_penghuni");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$idpenghuni = $_GET['idpenghuni'];


$sql = "DELETE FROM penghuni WHERE idpenghuni='$idpenghuni'";

if ($conn->query($sql) === TRUE){
    header("Location: dathuni.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>