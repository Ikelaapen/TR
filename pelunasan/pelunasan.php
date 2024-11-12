<?php
  include 'koneksibayar.php';

    $query = "SELECT * FROM tagihan WHERE status = 'Lunas'";
    $result = mysqli_query($conn, $query);
?>

  <!DOCTYPE html>
  <html lang="id">
  <head>
      <meta charset="UTF-8">
      <title>Pelunasan Pembayaran</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="beranda.css" />
      <link rel="stylesheet" href="pelunasan.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
    </head>
  <body>
 <!-- Navigasi-->
 <nav>
      <div class="nav-left">
        <h1>
          <a href="">
        <img src="profil.jpg" alt="Profil" class="profil" />
        <span>Kos Kit</span>
        </a>
        </h1>
      </div>

      <!-- Kotak Pencarian -->
    <div class="nav-center box">
        <form id="formPencarian">
            <input type="text" id="kataKunci" placeholder="Search...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

     <!--Menu Navigasi-->
     <div class="nav-right">
    <ul id="menu">
    <li class="active"><a href="beranda.html">Beranda</a></li>
            <li><a href="indexdatkam.php">Data Kamar</a></li>
            <li><a href="dathuni.php">Data Penghuni</a></li>
            <li><a href="tagihan.php">Data Tagihan</a></li>
            <li><a href="pelunasan.php">Pembayaran Lunas</a></li>
    </ul>
</nav>
</div>
      <div class="container mt-5">
          <h2 class="text-center">Tagihan Pelunasan</h2>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>ID Penghuni</th>
                      <th>Nama</th>
                      <th>Tagihan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                     while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";  
                echo "<td>" . $row['id_penghuni'] . "</td>";  
                echo "<td>" . $row['nama'] . "</td>";  
                echo "<td>Rp " . number_format($row['tagihan'], 2, ',', '.') . "</td>";  
                echo "<td>" . $row['status'] . "</td>";  
                echo "<td><a href='struk.php?id=" . $row['id_penghuni'] . "' class='btn btn-primary'>Cetak Struk</a></td>";  
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' align='center'>Tidak ada data</td></tr>";
        }
        ?>
              </tbody>
          </table>
      </div>
  </body>
  </html>
  
  <?php
  $conn->close();
  ?>
