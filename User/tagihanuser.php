<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: loginuser.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$current_user = $_SESSION['username']; // Pastikan ini sesuai dengan kolom pada tabel tagihan
$sql = "SELECT * FROM tagihanuser WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
  .custom-header {
    margin-top: 20px; /* Mengatur jarak atas */
    margin-bottom: 50px; /* Mengatur jarak bawah */
}
/* General Body Styling */
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 20px 50px;
  box-sizing: border-box;
  padding-top: 20px 50px; /* Ensures content isn't hidden behind navbar */
}

/* Navbar Styling */
.navbar {
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  background-color: white !important;
  padding: 10px 50px !important;
  border-bottom: 1px solid #ddd !important;
  position: fixed !important;
  top: 0 !important;
  width: 100% !important;
  z-index: 1000 !important;
}

.navbar h3{
  color: #32de8a;
}

.navbar-nav {
  display: flex !important;
  gap: 15px !important;
  align-items: center !important;
}

.navbar-nav .nav-link {
  color: #6c757d !important;
  font-size: 20px !important;
  font-weight: 500 !important;
  text-decoration: none !important;
  padding: 10px 15px !important;
  line-height: 1.5 !important;
  transition: color 0.3s ease !important;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #32de8a !important;
  border-bottom: 2px solid #32de8a !important;
}


/* Profile Icon Dropdown */
.dropdown .nav-link {
  color: #6c757d;
  font-size: 18px;
  font-weight: 500;
}

.dropdown .nav-link:hover {
  color: #32de8a;
}

/* Navbar Dropdown Menu */
.dropdown-menu {
  border: 1px solid #ddd;
  border-radius: 4px;
  min-width: 150px;
}

.dropdown-item {
  color: #6c757d;
  padding: 8px 16px;
  font-size: 16px;
  transition: background-color 0.3s;
}

.dropdown-item:hover {
  background-color: #f1f1f1;
  color: #3CB371;
}

/* Jumbotron Section */
.jumbotron {
  padding-top: 15rem;
  background-color: #3CB371;
  color: white;
  text-align: center;
  width: 100%;
  background-size: cover;
  background-position: center;
}

/* Description Section */
#deskripsi {
  margin-top: 20px;
  padding: 20px;
}

#deskripsi .col-md-5 {
  width: 100%;
  max-width: 800px;
  margin: 20px auto;
  text-align: justify;
}

#deskripsi p {
  font-size: 18px;
  line-height: 1.8;
  margin-bottom: 20px;
}

/* Card Section */
.card {
  transition: transform 0.3s;
  cursor: pointer;
  border: 1px solid #ddd;
  border-radius: 8px;
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card h3 {
  color: #3CB371;
}

/* Footer Styling */
footer {
  background-color: #3CB371;
  color: white;
  padding: 20px;
  text-align: center;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .navbar-nav {
    flex-direction: column;
    gap: 10px;
  }
  
  #deskripsi p {
    font-size: 16px;
  }

  .card h3 {
    font-size: 18px;
  }
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
                    <li class="nav-item"><a class="nav-link" href="tagihanuser.php">Data Tagihan</a></li>
                </ul>
                
                 <!-- logout -->
                 <div class="logout-container">
                    <a href="loginuser.php" class="nav-link logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </nav>
  
    <div class="container my-5">
        <h4 class="text-center mb-4">Data Tagihan Anda</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tgl Bayar</th>
                    <th>Tagihan</th>
                    <th>Status</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($row['tglbayar'])) . "</td>";
                        echo "<td>" . $row['tagihan'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['catatan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data tagihan</td></tr>";
                }
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

