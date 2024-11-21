<?php
$conn = new mysqli("localhost", "root", "", "admin");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$noHp = isset($_POST['noHp']) ? trim($_POST['noHp']) : '';
$tglMasuk = isset($_POST['tglMasuk']) ? trim($_POST['tglMasuk']) : '';
$nokamar = isset($_POST['nokamar']) ? $_POST['nokamar'] : '';

// Validasi input: jika ada kolom kosong, tampilkan pesan error
if (empty($nama) || empty($noHp) || empty($tglMasuk) || $nokamar === "Pilih") {
    echo "<script>alert('Semua kolom wajib diisi!'); window.history.back();</script>";
    exit;
}

// Periksa ID yang tersedia atau buat ID baru
$sql = "SELECT id_penghuni FROM penghuni ORDER BY id_penghuni ASC";
$result = $conn->query($sql);

$available_ids = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $available_ids[] = (int)$row['id_penghuni'];
    }
}

// Cari ID yang tersedia (jika ada gap pada urutan ID)
$id_penghuni = null;
for ($i = 1; $i <= count($available_ids) + 1; $i++) {
    if (!in_array($i, $available_ids)) {
        $id_penghuni = str_pad($i, 3, "0", STR_PAD_LEFT);
        break;
    }
}

// Sisipkan penghuni baru
$sql = "INSERT INTO penghuni (id_penghuni, nama, noHp, tglMasuk, nokamar) VALUES ('$id_penghuni', '$nama', '$noHp', '$tglMasuk', '$nokamar')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Rekaman baru berhasil dibuat'); window.location.href = 'dathuni.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
