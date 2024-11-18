<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tagihan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID Penghuni dari URL
$id_penghuni = $_GET['id_penghuni'];

// Mengambil data penghuni berdasarkan ID
$sql = "SELECT * FROM penghuni WHERE id_penghuni = '$id_penghuni'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $penghuni = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
// Ambil semua kamar yang sedang digunakan, kecuali kamar penghuni ini
$used_rooms = [];
$sql_used = "SELECT nokamar FROM penghuni WHERE id_penghuni != '$id_penghuni'";
$result_used = $conn->query($sql_used);
if ($result_used->num_rows > 0) {
    while ($row = $result_used->fetch_assoc()) {
        $used_rooms[] = $row['nokamar'];
    }
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
            <input type="hidden" id="id_penghuni" name="id_penghuni" value="<?php echo $penghuni['id_penghuni']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $penghuni['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="noHp" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="noHp" name="noHp" value="<?php echo $penghuni['noHp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tglMasuk" class="form-label">Tgl Masuk</label>
                <input type="date" class="form-control" id="tglMasuk" name="tglMasuk" value="<?php echo $penghuni['tglMasuk']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nokamar" class="form-label">No Kamar</label>
                <select class="form-select" id="nokamar" name="nokamar" required>
                    <option value="" <?php if ($penghuni['nokamar'] == '') echo 'selected'; ?>>Pilih</option>
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <?php 
                            $disabled = in_array($i, $used_rooms) ? 'disabled' : '';
                            $selected = ($penghuni['nokamar'] == $i) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $i; ?>" <?php echo $disabled . ' ' . $selected; ?>>
                            No Kamar <?php echo $i; ?>
                            <?php if ($disabled && !$selected): ?> (Sudah Digunakan) <?php endif; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <button type="button" class="btn btn-secondary" onclick="window.location.href='dathuni.php'">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>