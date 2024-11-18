<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tagihan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi ID dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

// Ambil dan amankan ID dari URL
$id = intval($_GET['id']); // Konversi ke integer untuk keamanan

// Ambil data kamar berdasarkan ID
$sql = "SELECT * FROM kost WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $kost = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="kamar2.css">
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h4 class="text-center">Edit Data Kamar</h4>
        </div>
        <div class="card-body">
            <form id="formKamar" method="POST" action="updkamar.php">
                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($kost['id']); ?>">
                <div class="mb-3">
                    <label for="no_kamar" class="form-label">No Kamar</label>
                    <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?php echo htmlspecialchars($kost['no_kamar']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                    <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                        <option value="Dengan AC" <?php echo ($kost['tipe_kamar'] === 'Dengan AC') ? 'selected' : ''; ?>>Dengan AC</option>
                        <option value="Tanpa AC" <?php echo ($kost['tipe_kamar'] === 'Tanpa AC') ? 'selected' : ''; ?>>Tanpa AC</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($kost['harga']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Dihuni" <?php echo ($kost['status'] === 'Dihuni') ? 'selected' : ''; ?>>Dihuni</option>
                        <option value="Kosong" <?php echo ($kost['status'] === 'Kosong') ? 'selected' : ''; ?>>Kosong</option>
                    </select>
                </div>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='kamar2.php'">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
