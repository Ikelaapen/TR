<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_penghuni = $_POST['id_penghuni'] ?? null;
$nama = $_POST['nama'] ?? null;
$tglbayar = $_POST['tglbayar'] ?? null;
$tagihan = $_POST['tagihan'] ?? null;
$status = $_POST['status'] ?? null;
$catatan = $_POST['catatan'] ?? null;

// Validasi server-side
if (empty($id_penghuni) || empty($nama) || empty($tglbayar) || empty($tagihan) || empty($status)) {
    echo "Semua kolom yang bertanda wajib harus diisi!";
    exit;
}

$sql = "INSERT INTO tagihan (id_penghuni, nama, tglbayar, tagihan, status, catatan)
        VALUES ('$id_penghuni', '$nama','$tglbayar', '$tagihan', '$status', '$catatan')";

if ($conn->query($sql) === TRUE){
    header("Location: tagihan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>