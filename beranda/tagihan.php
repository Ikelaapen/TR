<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">   
  <title>Data Tagihan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="beranda.css">
  <link rel="stylesheet" href="tagihan.css">
</head>
<script>
  function editData(id, nama, tglbayar, tagihan, status){
    document.getElementById('id_penghuni'). value = id;
    document.getElementById('nama'). value = nama;
    document.getElementById('tglbayar'). value = tglbayar;
    document.getElementById('tagihan'). value = tagihan;
    document.getElementById('status'). vaue = status;

    document.getElementById('formTagihan').action = 'updtagihan.php';
  }

  </script>
  <body>
      <!-- Navigasi -->
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

        <!-- Menu Navigasi -->
         <div class="nav-right">
        <ul id="menu">
            <li class="active"><a href="beranda.php">Beranda</a></li>
            <li><a href="kamar.php">Data Kamar</a></li>
            <li><a href="dathuni.php">Data Penghuni</a></li>
            <li><a href="tagihan.php">Data Tagihan</a></li>
            <li><a href="pelunasan.php">Pembayaran Lunas</a></li>
        </ul>
    </nav>
  </div>
  
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
                      echo "<td>" . $tagihan['id_penghuni']. "</td>";
                      echo "<td>" . $tagihan['nama']. "</td>";
                      echo "<td>" . $tagihan['tglbayar']. "</td>";
                      echo "<td>" . $tagihan['tagihan']. "</td>";
                      echo "<td>" . $tagihan['status']."</td>";
                      echo '<td>
                      <a href="hapustagihan.php?id_penghuni='.$tagihan['id_penghuni'].'" class="btn btn-success btn-sm">Hapus</a>
                      <a href="edittagihan.php>id_penghuni='.$tagihan['id_penghuni'].'" class="btn btn-danger btn-sm onclick-"editData (\''.$tagihan['id_penghuni']. '\',\''.$tagihan['nama'].'\',\''.$tagihan['tglbayar'].'\',\''.$tagihan['tagihan'].'\',\''.$tagihan['status'].'\')">Edit</a>
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
                </body>
                </html>