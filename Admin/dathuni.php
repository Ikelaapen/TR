<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penghuni</title>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="beranda.css">
    <link rel="stylesheet" href="dathuni.css">
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
    
    <div class="container my-5">
        <div class="card">
        <div class="card-header bg-success text-white">
    <h4 class="text-center custom-header">Data Penghuni</h4>
    <a href="tamdathuni.php" class="btn btn-primary">Tambah Data</a>

</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Penghuni</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Tgl Masuk</th>
                            <th>No Kamar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM penghuni";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $no = 1;
    while ($penghuni = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . str_pad($penghuni['id_penghuni'], 3, "0", STR_PAD_LEFT) . "</td>"; // Display ID with leading zeros
        echo "<td>" . $penghuni['nama'] . "</td>";
        echo "<td>" . $penghuni['noHp'] . "</td>";
        echo "<td>" . date("d-m-Y", strtotime($penghuni['tglMasuk'])) . "</td>";
        echo "<td>" . str_pad($penghuni['nokamar'], 2, "0", STR_PAD_LEFT) . "</td>";
        echo '<td>
            <a href="hapus.php?id_penghuni=' . $penghuni['id_penghuni'] . '" class="btn btn-success btn-sm">Hapus</a>
            <a href="edit.php?id_penghuni=' . $penghuni['id_penghuni'] . '" class="btn btn-danger btn-sm" onclick="editData (\'' . $penghuni['id_penghuni'] . '\', \'' . $penghuni['nama'] . '\', \'' . $penghuni['noHp'] . '\', \'' . $penghuni['tglMasuk'] . '\', \'' . $penghuni['nokamar'] . '\')">Edit</a>
        </td>';
        echo "</tr>";
    } 
} else {
    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
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