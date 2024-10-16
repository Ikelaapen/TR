<?php
// Database connection
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "kost"; // Change this to your actual database name

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { 
    die("Tidak bisa terkoneksi ke database");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    if ($bulan && $tahun) {
        // Insert the new bills based on the selected month and year
        $sql = "INSERT INTO tagihan (bulan, tahun, id_penghuni, tagihan) 
                SELECT '$bulan', '$tahun', penghuni.id_penghuni, penghuni.tagihan 
                FROM penghuni";  // Modify this query based on your actual table structure

        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            echo "<script>alert('Tagihan berhasil dibuat');</script>";
        } else {
            echo "<script>alert('Gagal membuat tagihan');</script>";
        }
    } else {
        echo "<script>alert('Mohon pilih bulan dan tahun');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Tagihan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <style>
    .mx-auto {
      max-width: 800px;
      margin: 20px auto;
    }
    .card {
      margin-top: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    .card-header {
      background-color: #f8f9fa;
      font-size: 1.2em;
      font-weight: bold;
      padding: 15px;
    }
    .table th, .table td {
      padding: 10px 15px;
      border: 1px solid #e0e0e0;
    }
    .btn-create {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 10px;
    }
    .btn-create button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container mx-auto">
    <!-- Buat Tagihan Form -->
    <div class="card">
      <div class="card-header">
        <i class="fa fa-plus"></i> Buat Tagihan
      </div>
      <div class="card-body">
        <form method="POST" action="">
          <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select class="form-select" name="bulan" id="bulan" required>
              <option value="" selected>Pilih Bulan</option>
              <option value="Januari">Januari</option>
              <option value="Februari">Februari</option>
              <option value="Maret">Maret</option>
              <option value="April">April</option>
              <option value="Mei">Mei</option>
              <option value="Juni">Juni</option>
              <option value="Juli">Juli</option>
              <option value="Agustus">Agustus</option>
              <option value="September">September</option>
              <option value="Oktober">Oktober</option>
              <option value="November">November</option>
              <option value="Desember">Desember</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select" name="tahun" id="tahun" required>
              <option value="" selected>Pilih Tahun</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <!-- Add other years as needed -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Buat Tagihan</button>
        </form>
      </div>
    </div>

    <!-- Data Tagihan Table -->
    <div class="card mt-4">
      <div class="card-header">Data Tagihan Bulanan</div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Penghuni</th>
              <th>Nama</th>
              <th>Kamar</th>
              <th>Tagihan (Rp)</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Query to fetch bills from the database
            $sql = "SELECT t.id_tagihan, t.bulan, t.tahun, p.id_penghuni, p.nama, p.kamar, t.tagihan, t.status 
                    FROM tagihan t 
                    JOIN penghuni p ON t.id_penghuni = p.id_penghuni 
                    ORDER BY t.bulan DESC, t.tahun DESC";

            $result = mysqli_query($koneksi, $sql);
            $no = 1;

            if ($result) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['id_penghuni']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['kamar']}</td>
                        <td>Rp " . number_format($row['tagihan'], 0, ',', '.') . "</td>
                        <td>{$row['status']}</td>
                        <td>
                          <button class='btn btn-success btn-sm'>Konfirmasi</button>
                          <button class='btn btn-info btn-sm'>Kirim WA</button>
                        </td>
                      </tr>";
                $no++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
