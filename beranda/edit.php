<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tagihan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID Penghuni dari URL
$idpenghuni = $_GET['idpenghuni'];

// Mengambil data penghuni berdasarkan ID
$sql = "SELECT * FROM penghuni WHERE idpenghuni = '$idpenghuni'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $penghuni = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penghuni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dathuni.css">
</head>
<body>
<div class="card mt-4">
    <div class="card-header bg-warning text-white">
        <h4 class="text-center">Edit Data Penghuni</h4>
    </div>
    <div class="card-body">
        <form id="formPenghuni" method="POST" action="updpenghuni.php">
            <input type="hidden" id="idpenghuni" name="idpenghuni" value="<?php echo $penghuni['idpenghuni']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $penghuni['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $penghuni['alamat']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="noHp" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="noHp" name="noHp" value="<?php echo $penghuni['noHp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tglRegistrasi" class="form-label">Tanggal Registrasi</label>
                <input type="date" class="form-control" id="tglRegistrasi" name="tglRegistrasi" value="<?php echo $penghuni['tglRegistrasi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kamar" class="form-label">Kamar</label>
                <input type="text" class="form-control" id="kamar" name="kamar" value="<?php echo $penghuni['kamar']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>