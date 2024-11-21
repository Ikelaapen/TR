<?php
$conn = new mysqli("localhost", "root", "", "admin");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//ambil nomor kamar terakhir dari database
$sql_last_no_kamar = "SELECT no_kamar FROM kost ORDER BY id DESC LIMIT 1";
$result_last_no_kamar = $conn->query($sql_last_no_kamar);

//hitung nomor kamar berikutnya
if ($result_last_no_kamar->num_rows > 0){
    $row = $result_last_no_kamar->fetch_assoc();
    $last_no_kamar = intval($row['no_kamar']);
    $next_no_kamar = str_pad($last_no_kamar + 1, 2, "0", STR_PAD_LEFT);
} else {
    $next_no_kamar ="01";
}

// Ambil data dari form
$no_kamar = $conn->real_escape_string(trim($_POST['no_kamar']));
$tipe_kamar = $conn->real_escape_string(trim($_POST['tipe_kamar']));
$harga = $conn->real_escape_string(trim($_POST['harga']));
$status = $conn->real_escape_string(trim($_POST['status']));

// Query untuk menyimpan data
$sql = "INSERT INTO kost (no_kamar, tipe_kamar, harga, status) VALUES ('$no_kamar', '$tipe_kamar', '$harga', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan.";
    header("Location: kamar2.php"); // Redirect ke halaman data kamar
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
