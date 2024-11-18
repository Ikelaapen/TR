<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tagihan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$id_penghuni = $_POST['id_penghuni'];
$nama = $_POST['nama'];
$noHp = $_POST['noHp'];
$tglMasuk = $_POST['tglMasuk'];
$nokamar = $_POST['nokamar'];

// Update data penghuni
$sql = "UPDATE penghuni SET nama='$nama', noHp='$noHp', tglMasuk='$tglMasuk', nokamar='$nokamar' WHERE id_penghuni='$id_penghuni'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil diupdate!'); window.location.href='dathuni.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
