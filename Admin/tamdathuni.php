<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


// Ambil nomor kamar yang sudah digunakan
$sql_used_rooms = "SELECT nokamar FROM penghuni";
$result_used_rooms = $conn->query($sql_used_rooms);

$used_rooms = [];
if ($result_used_rooms->num_rows > 0) {
    while ($row = $result_used_rooms->fetch_assoc()) {
        $used_rooms[] = $row['nokamar']; // Simpan nomor kamar yang sudah digunakan
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penghuni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tamdathuni.css">
    <link rel="stylesheet" href="beranda.css">
    <style>
        .form-container button {
            padding: 10px 20px;
            font-size: 16px;
        }
        </style>
</head>
<body>
  <!-- Navigasi -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="beranda.php">
                <h3>Kos Kit</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu Navigasi -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="kamar2.php">Data Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="dathuni.php">Data Penghuni</a></li>
                    <li class="nav-item"><a class="nav-link" href="tagihan.php">Data Tagihan</a></li>
                    <li class="nav-item"><a class="nav-link" href="pelunasan.php">Pelunasan</a></li>
                </ul>
                
                              <!-- logout -->
                              <div class="logout-container">
                    <a href="menu login.php" class="nav-link logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </nav>


<div class="container">
    <div class="form-container">
        <h4 class="text-left">Tambah Data Penghuni</h4>
        <form id="formPenghuni" action="proses.php" method="post" onsubmit="return validateForm()">
        <script>
    function validateForm() {
        const nama = document.getElementById("nama").value.trim();
        const noHp = document.getElementById("noHp").value.trim();
        const tglMasuk = document.getElementById("tglMasuk").value.trim();
        const nokamar = document.getElementById("nokamar").value;

        if (!nama || !noHp || !tglMasuk || kamar === "Pilih") {
            alert("Semua kolom wajib diisi!");
            return false; // Gagal submit form
        }

        return true; // Lolos validasi
    }
</script>

            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label text-end">Nama Lengkap</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="row mb-3">
                <label for="noHp" class="col-sm-4 col-form-label text-end">No HP</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="noHp" name="noHp" placeholder="No HP">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tglMasuk" class="col-sm-4 col-form-label text-end">Tgl Masuk</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tglMasuk" name="tglMasuk">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nokamar" class="col-sm-4 col-form-label text-end">No Kamar</label>
                <div class="col-sm-8">
                    <select class="form-select" id="nokamar" name="nokamar" required>
                    <option selected>Pilih</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <?php 
                    $room_number = sprintf('%02d', $i); 
                    $disabled = in_array($room_number, $used_rooms) ? 'disabled' : '';
                ?>
                <option value="<?php echo $room_number; ?>" <?php echo $disabled; ?>>
                    <?php echo $room_number; ?>
                    <?php if ($disabled): ?> (Sudah Digunakan) <?php endif; ?>
                </option>
            <?php endfor; ?>
        </select>
    </div>
</div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='dathuni.php'">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>