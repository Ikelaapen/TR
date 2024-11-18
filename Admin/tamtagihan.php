<?php
// Koneksi ke database
include('koneksi.php');

// Query untuk mengambil data idpenghuni dan nama dari tabel penghuni
$query = "SELECT id_penghuni, nama FROM penghuni";
$result = mysqli_query($koneksi, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Tagihan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="tamtagihan.css">
  <link rel="stylesheet" href="beranda.css">
  <style>
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
    <script>
        function updateNama() {
            const idPenghuni = document.getElementById('id_penghuni').value;

            if (idPenghuni) {
                fetch(`getNama.php?id_penghuni=${idPenghuni}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nama').value = data.nama || '';
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } else {
                document.getElementById('nama').value = '';
            }
        }
    </script>
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
                
                <!-- Profile Icon with Dropdown Menu -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> Pengguna
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

<div class="container">
    <div class="form-container">
        <h4 class="text-left">Tambah Data Tagihan</h4>
        <form id="formTagihan" action="prosestagihan.php" method="post" onsubmit="return validateForm()">  
        <div class="row mb-3">
    <label for="id_penghuni" class="col-sm-4 col-form-label text-end">Id Penghuni</label>
    <div class="col-sm-8">
    <select class="form-select" id="id_penghuni" name="id_penghuni" onchange="updateNama()">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id_penghuni'] . "'>" . str_pad($row['id_penghuni'], 3, '0', STR_PAD_LEFT) . "</option>";
    }    
        echo "<td>" . str_pad($tagihan['id_penghuni'], 3, '0', STR_PAD_LEFT) . "</td>";
    ?>
</select>

    </div>
</div>

            
            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label text-end">Nama</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" readonly required>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="tglbayar" class="col-sm-4 col-form-label text-end">Tgl Bayar</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tglbayar" name="tglbayar" required>
                </div>
            </div>
            
            <div class="row mb-3">
    <label for="tagihan" class="col-sm-4 col-form-label text-end">Tagihan</label>
    <div class="col-sm-8">
            <input type="text" class="form-control" id="tagihan" name="tagihan" placeholder="Rp0" required oninput="formatRupiah(this)">
</div>
</div>

<script>
function formatRupiah(input) {
    let value = input.value.replace(/[^,\d]/g, ""); 
    if (value) {
        let formatted = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(value.replace(/,/g, ''));

        input.value = formatted.replace("IDR", "Rp");
    } else {
        input.value = "";
    }
}

</script>

            
            <div class="row mb-3">
                <label for="status" class="col-sm-4 col-form-label text-end">Status</label>
                <div class="col-sm-8">
                    <select class="form-select" id="status" name="status" required>
                        <option selected>Pilih</option>
                        <option value="Lunas">Sudah Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="catatan" class="col-sm-4 col-form-label text-end">Catatan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan">
                </div>
            </div>
            
            <div class="text-end">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='tagihan.php'">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const idPenghuni = document.getElementById('id_penghuni').value;
        const tglBayar = document.getElementById('tglbayar').value;
        const tagihan = document.getElementById('tagihan').value;
        const status = document.getElementById('status').value;

        if (!idPenghuni || !tglBayar || !tagihan || !status) {
            alert('Semua kolom yang bertanda wajib harus diisi!');
            return false;
        }
        return true;
    }
</script>

<body>
    <script>
        function updateNama() {
            const idPenghuni = document.getElementById('id_penghuni').value;

            if (idPenghuni) {
                fetch(`getNama.php?id_penghuni=${idPenghuni}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nama').value = data.nama || '';
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            } else {
                document.getElementById('nama').value = '';
            }
        }
    </script>
</body>
</html>
