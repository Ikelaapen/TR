<?php
include 'koneksibayar.php';

// Ambil data dari tabel pelunasan dengan tagihan yang valid
$query = "SELECT pelunasan.*, IFNULL(tagihan.tagihan, 0) AS tagihan 
          FROM pelunasan 
          JOIN tagihan ON pelunasan.id_penghuni = tagihan.id_penghuni
          WHERE pelunasan.status = 'Lunas'
          ORDER BY pelunasan.id_penghuni ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}


while ($row = mysqli_fetch_assoc($result)) {
    // Validasi data yang diambil
    if (!isset($row['id_penghuni']) || empty($row['id_penghuni'])) {
        continue; // Lewati jika id_penghuni tidak valid
    }

    $id_penghuni = $row['id_penghuni'];

    // Cek apakah data sudah ada di tabel pelunasan
    $check_query = "SELECT COUNT(*) AS count FROM pelunasan WHERE id_penghuni = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $id_penghuni);
    $stmt->execute();
    $check_result = $stmt->get_result();
    $check_data = $check_result->fetch_assoc();

    // Jika belum ada, tambahkan ke pelunasan
    if ($check_data['count'] == 0) {
        $tglbayar = (!empty($row['tglbayar']) && $row['tglbayar'] != '0000-00-00') 
            ? date("Y-m-d", strtotime($row['tglbayar'])) 
            : null;

        // Validasi semua kolom sebelum dimasukkan
        $nama = $row['nama'] ?? 'Tidak Ada Nama';
        $tagihan = isset($row['tagihan']) && is_numeric($row['tagihan']) ? $row['tagihan'] : 0; 
        $status = $row['status'] ?? 'Tidak Diketahui';
        $aksi = ''; 

        $insert_query = "INSERT INTO pelunasan (id_penghuni, nama, tglbayar, tagihan, status, aksi) 
                         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        $stmt->bind_param("ssssss", $id_penghuni, $nama, $tglbayar, $tagihan, $status, $aksi);

        if (!$stmt->execute()) {
            die("Gagal menyisipkan data: " . $stmt->error);
        }
    }
}

// Ambil data untuk ditampilkan
$pelunasan_query = "SELECT p.id_penghuni, p.nama, p.tglbayar, 
                           IFNULL(t.tagihan, 0) AS tagihan, p.status
                    FROM pelunasan p
                    LEFT JOIN tagihan t ON p.id_penghuni = t.id_penghuni
                    ORDER BY p.id_penghuni ASC";

$pelunasan_result = mysqli_query($conn, $pelunasan_query);

if (!$pelunasan_result) {
die("Gagal mengambil data: " . mysqli_error($conn));
}

?>


  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <title>Pelunasan</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="beranda.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
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


      <div class="container mt-5">
          <h2 class="text-center">Tagihan Pelunasan</h2>
          <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Id Penghuni</th>
            <th>Nama</th>
            <th>TglBayar</th>
            <th>Tagihan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    //nomor urut
    $no = 1;

    // Loop untuk menampilkan data pelunasan
    while ($row = mysqli_fetch_assoc($pelunasan_result)) {
        echo "<tr>";
        echo "<td>" . $no++. "</td>";
        echo "<td>" . str_pad($row['id_penghuni'], 3, "0", STR_PAD_LEFT) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . (!empty($row['tglbayar']) ? date("d-m-Y", strtotime($row['tglbayar'])) : 'Tidak Ada') . "</td>";
        $tagihan = preg_replace('/[^0-9]/', '', $row['tagihan']); // Hapus semua karakter selain angka
echo "<td>Rp " . number_format((float)$tagihan, 0, ',', '.') . "</td>";

        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>
                <a href='struk.php?id_penghuni=" . urlencode($row['id_penghuni']) . "' class='btn btn-primary btn-sm'>Cetak Struk</a>
              </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

      </div>
      <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>
  
  <?php
  $conn->close();
  ?>