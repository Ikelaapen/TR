<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "admin");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data yang dikirimkan dari formulir
$id_penghuni = $_POST['id_penghuni'];
$nama = $_POST['nama'];
$tglbayar = $_POST['tglbayar'];
$tagihan = $_POST['tagihan'];
$status = $_POST['status'];
$catatan = $_POST['catatan'];

// Update data di tabel tagihan
$sql_tagihan = "UPDATE tagihan SET nama = ?, tglbayar = ?, tagihan = ?, status = ?, catatan = ? WHERE id_penghuni = ?";
$stmt = $conn->prepare($sql_tagihan);
$stmt->bind_param("ssssss", $nama, $tglbayar, $tagihan, $status, $catatan, $id_penghuni);
if ($stmt->execute()) {
    // Update data di tabel pelunasan jika perlu
    $sql_pelunasan = "UPDATE pelunasan SET nama = ?, tglbayar = ?, tagihan = ?, status = ? WHERE id_penghuni = ?";
    $stmt_pelunasan = $conn->prepare($sql_pelunasan);
    $stmt_pelunasan->bind_param("sssss", $nama, $tglbayar, $tagihan, $status, $id_penghuni);
    $stmt_pelunasan->execute();

    // Setelah berhasil diperbarui, arahkan kembali ke halaman tagihan.php
    header("Location: tagihan.php?status=success");
    exit(); // Menghentikan eksekusi lebih lanjut setelah redirect
} else {
    echo "Gagal memperbarui data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
