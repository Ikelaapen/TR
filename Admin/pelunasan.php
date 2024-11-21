<?php
  include 'koneksibayar.php';
    
  // Ambil data dari database
    $query = "SELECT * FROM tagihan WHERE status = 'Lunas'";
    $result = mysqli_query($conn, $query);
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
                    <li class="nav-item"><a class="nav-link" href="kamar.php">Data Kamar</a></li>
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
                      <th>ID Penghuni</th>
                      <th>Nama</th>
                      <th>TglBayar</th>
                      <th>Tagihan</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
              <?php
// Loop data dari tabel tagihan
if (mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {

        // Cek dan format tagihan
        if (!empty($row['tagihan']) && is_numeric($row['tagihan'])) {
            $tagihan = number_format($row['tagihan'], 2, ',', '.'); // Format sebagai angka
        } else {
            $tagihan = "0,00"; // Atau bisa juga 0 jika tidak valid
        }

        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . str_pad($row['id_penghuni'], 3, "0", STR_PAD_LEFT) . "</td>";
        echo "<td>" . $row['nama'] . "</td>";
        echo "<td>" . date("d-m-Y", strtotime($row['tglbayar'])) . "</td>";
        echo "<td>" . $row['tagihan'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='struk.php?id=" . $row['id_penghuni'] . "' class='btn btn-primary'>Cetak Struk</a></td>";
        echo "</tr>";

        // Masukkan data ke tabel pelunasan
        $insert_query = $conn->prepare("INSERT INTO pelunasan (id_penghuni, nama, tglbayar, tagihan, status) 
                                VALUES (?, ?, ?, ?, ?)");
$insert_query->bind_param("issds", $row['id_penghuni'], $row['nama'], $row['tglbayar'], $row['tagihan'], $row['status']);
if (!$insert_query->execute()) {
    echo "<script>console.error('Error: " . $insert_query->error . "');</script>";
}
    }
}else {
    echo "<script>console.log('Data berhasil disimpan');</script>";
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