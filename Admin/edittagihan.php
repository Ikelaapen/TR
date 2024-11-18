<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tagihan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID Penghuni dari URL
$id_penghuni = $_GET['id_penghuni'];

// Mengambil data penghuni berdasarkan nama
$sql = "SELECT * FROM tagihan WHERE id_penghuni = '$id_penghuni'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tagihan = $result->fetch_assoc();
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
    <title>Daftar Tagihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tagihan.css">
</head>
<body>
<div class="card mt-4">
            <div class="card-header bg-warning text-white">
                <h4 class="text-center">Edit Data Tagihan</h4>
            </div>
            <div class="card-body">
            <form id="formTagihan" method="POST" action="updtagihan.php">
                <input type="hidden" id="id_penghuni" name="id_penghuni" value="<?php echo $tagihan['id_penghuni']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $tagihan['nama']; ?>" required>
                </div> 
                <div class="mb-3">
                    <label for="tglbayar" class="form-label">TglBayar</label>
                    <input type="date" class="form-control" id="tglbayar" name="tglbayar" value="<?php echo $tagihan['tglbayar']; ?>" required>
                </div> 
                <div class="mb-3">
                    <label for="tagihan" class="form-label">Tagihan</label>
                    <input type="text" class="form-control" id="tagihan" name="tagihan" value="<?php echo $tagihan['tagihan']; ?>" required>
                </div> 
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Lunas" <?php echo ($tagihan['status'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                        <option value="Belum Lunas" <?php echo ($tagihan['status'] == 'Belum Lunas') ? 'selected' : ''; ?>>Belum Lunas</option>
                </select>
                    </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" class="form-control" id="catatan" name="catatan" value="<?php echo $tagihan['catatan']; ?>" required>
                </div> 
                <button type="button" class="btn btn-secondary" onclick="window.location.href='tagihan.php'">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
