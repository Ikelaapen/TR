<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah parameter 'id' ada dan tidak kosong
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM kost WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" untuk tipe data integer

    if ($stmt->execute()) {
        // Berhasil menghapus, redirect ke halaman 'kamar2.php'
        header("Location: kamar2.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Parameter 'id' tidak valid.";
}

$conn->close();
?>
