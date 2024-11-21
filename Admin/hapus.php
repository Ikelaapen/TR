<?php
$conn = new mysqli("localhost", "root", "", "admin");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_penghuni = $_GET['id_penghuni'];

// Hapus data penghuni
$sql = "DELETE FROM penghuni WHERE id_penghuni = $id_penghuni";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Penghuni berhasil dihapus!'); window.location.href='dathuni.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
