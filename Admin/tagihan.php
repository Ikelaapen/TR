<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">   
  <title>Data Tagihan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="beranda.css">
  <link rel="stylesheet" href="tagihan.css">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<script>
  function editData(id, nama, tglbayar, tagihan, status, catatan){
    document.getElementById('id_penghuni'). value = id;
    document.getElementById('nama'). value = nama;
    document.getElementById('tglbayar'). value = tglbayar;
    document.getElementById('tagihan'). value = tagihan;
    document.getElementById('status'). value = status;
    document.getElementById('catatan'). value = catatan;

    document.getElementById('formTagihan').action = 'updtagihan.php';
  }

  </script>
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
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
  
<div class="container my-5">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4 class="text-center custom-header">Data Tagihan</h4>
        <button class="btn btn-primary" onclick="window.location.href='tamtagihan.php'">Tambah Data</button>
</div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>No</th>
                <th>Id Penghuni</th>
                <th>Nama</th>
                <th>TglBayar</th>
                <th>Tagihan</th>
                <th>Status</th>
                <th>Catatan</th>
</tr>
</thead>
<tbody>
                  <?php
                  $conn = new mysqli("localhost", "root", "", "tagihan");

                  if ($conn->connect_error){
                    die("Koneksi gagal: " . $conn->connect_error);
                  }

                  $sql = "SELECT * FROM tagihan";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0){
                    $no = 1;
                    while ($tagihan = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $no++ . "</td>";
                      echo "<td>" . str_pad($tagihan['id_penghuni'], 3, "0", STR_PAD_LEFT) . "</td>";
                      echo "<td>" . $tagihan['nama']. "</td>";
                      echo "<td>" . date("d-m-Y", strtotime($tagihan['tglbayar'])) . "</td>";
                      echo "<td>" . $tagihan['tagihan']. "</td>";
                      echo "<td>" . $tagihan['status']."</td>";
                      echo "<td>" . $tagihan['catatan']."</td>";
                      echo '<td>
                      <a href="hapustagihan.php?id_penghuni='.$tagihan['id_penghuni'].'" class="btn btn-success btn-sm">Hapus</a>
                      <a href="edittagihan.php?id_penghuni='.$tagihan['id_penghuni'].'" class="btn btn-danger btn-sm onclick="editData (\''.$tagihan['id_penghuni']. '\',\''.$tagihan['nama'].'\',\''.$tagihan['tglbayar'].'\',\''.$tagihan['tagihan'].'\',\''.$tagihan['status'].'\',\''.$tagihan['catatan']. '\')">Edit</a>
                      </td>';
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                  }
                  $conn->close();
                  ?>
                  </tbody>
                </table>
                </div>
                </div>
                </div>
                <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                </body>
                </html>