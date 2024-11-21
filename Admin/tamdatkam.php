<?php
$conn = new mysqli("localhost", "root", "", "admin");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil nomor kamar yang sudah digunakan
$sql_used_rooms = "SELECT no_kamar FROM kost";
$result_used_rooms = $conn->query($sql_used_rooms);

$used_rooms = [];
if ($result_used_rooms->num_rows > 0) {
    while ($row = $result_used_rooms->fetch_assoc()) {
        $used_rooms[] = $row['no_kamar']; // Simpan nomor kamar yang sudah digunakan
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
    <title>Tambah Data Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tamdatkam.css">
    <link rel="stylesheet" href="beranda.css">
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
        <h4 class="text-left">Tambah Data Kamar</h4>
        <form id="formKamar" action="proseskamar.php" method="post" onsubmit="return validateForm()">
            <script>
            function validateForm() {
                const no_kamar = document.getElementById("no_kamar").value.trim();
                const tipe_kamar = document.getElementById("tipe_kamar").value.trim();
                const harga = document.getElementById("harga").value.trim();
                const status = document.getElementById("status").value.trim();

                if (!no_kamar || !tipe_kamar || !harga || !status || no_kamar === "Pilih") {
                    alert("Semua kolom wajib diisi!");
                    return false; // Gagal submit form
                }

                return true; // Lolos validasi
            }
            </script>

            <div class="row mb-3">
                <label for="no_kamar" class="col-sm-4 col-form-label text-end">No Kamar</label>
                <div class="col-sm-8">
                    <select class="form-select" id="no_kamar" name="no_kamar" required>
                        <option selected>Pilih</option>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <?php 
                                $room_number = str_pad($i, 2, "0", STR_PAD_LEFT); 
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

            <div class="row mb-3">
                <label for="tipe_kamar" class="col-sm-4 col-form-label text-end">Tipe Kamar</label>
                <div class="col-sm-8">
                    <select class="form-select" id="tipe_kamar" name="tipe_kamar" required onchange="updateHarga()">
                        <option selected>Pilih</option>
                        <option value="Dengan AC">Dengan AC</option>
                        <option value="Tanpa AC">Tanpa AC</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="harga" class="col-sm-4 col-form-label text-end">Harga</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Rp0" readonly>
                </div>
            </div>
            <script>
            function updateHarga() {
                const tipeKamar = document.getElementById("tipe_kamar").value;
                const hargaInput = document.getElementById("harga");

                if (tipeKamar === "Dengan AC") {
                    hargaInput.value = "Rp1.000.000";
                } else if (tipeKamar === "Tanpa AC") {
                    hargaInput.value = "Rp800.000";
                } else {
                    hargaInput.value = "";
                }
            }
            </script>

            <div class="row mb-3">
                <label for="status" class="col-sm-4 col-form-label text-end">Status</label>
                <div class="col-sm-8">
                    <select class="form-select" id="status" name="status" required>
                        <option selected>Pilih</option>
                        <option value="Dihuni">Dihuni</option>
                        <option value="Kosong">Kosong</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='kamar2.php'">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>
