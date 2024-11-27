<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "admin");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_penghuni = $_POST['id_penghuni'];
$nama = $_POST['nama'];
$tglbayar = $_POST['tglbayar'];
$tagihan = $_POST['tagihan'];
$status = $_POST['status'];
$catatan = $_POST['catatan'];

// Query untuk update tagihan di tabel tagihan
$sql = "UPDATE tagihan SET tglbayar=?, tagihan=?, status=?, catatan=? WHERE id_penghuni=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $tglbayar, $tagihan, $status, $catatan, $id_penghuni);
$stmt->execute();

// Query untuk menyalin data ke tabel tagihanuser (untuk pengguna)
$sql_user = "INSERT INTO tagihanuser (nama, tglbayar, tagihan, status, catatan) 
             VALUES (?, ?, ?, ?, ?)";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("sssss", $nama, $tglbayar, $tagihan, $status, $catatan);
$stmt_user->execute();

$stmt->close();
$stmt_user->close();
$conn->close();

header("Location: tagihan.php"); // Redirect setelah proses selesai
exit;
?>
