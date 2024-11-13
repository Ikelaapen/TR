<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penghuni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dathuni.css">
    <link rel="stylesheet" href="beranda.css">
</head>
<script>
    function editData(id, nama, alamat, noHp, tglRegistrasi, kamar){
        document.getElementById('idpenghuni').value = id;
        document.getElementById('nama').value = nama;
        document.getElementById('alamat').value = alamat;
        document.getElementById('noHp').value = noHp;
        document.getElementById('tglRegistrasi').value = tglRegistrasi;
        document.getElementById('kamar').value = kamar;

        document.getElementById('formPenghuni').action = 'updpenghuni.php';
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
        </div>
    </nav>

    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="text-center custom-header">Data Penghuni</h4>
                <button class="btn btn-primary" onclick="window.location.href='tamdathuni.html'">Tambah Data</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Penghuni</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Registrasi</th>
                            <th>Kamar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "tagihan");

                        if ($conn->connect_error){
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM penghuni";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($penghuni = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $penghuni['idpenghuni'] . "</td>";
                                echo "<td>" . $penghuni['nama'] . "</td>";
                                echo "<td>" . $penghuni['alamat'] . "</td>";
                                echo "<td>" . $penghuni['noHp'] . "</td>";
                                echo "<td>" . $penghuni['tglRegistrasi'] . "</td>";
                                echo "<td>kamar" . $penghuni['kamar'] . "</td>";
                                echo '<td>
                                    <a href="hapus.php?idpenghuni=' . $penghuni['idpenghuni'] . '" class="btn btn-success btn-sm">Hapus</a>
                                    <a href="edit.php?idpenghuni=' . $penghuni['idpenghuni'] . '" class="btn btn-danger btn-sm" onclick="editData (\'' . $penghuni['idpenghuni'] . '\', \'' . $penghuni['nama'] . '\', \'' . $penghuni['alamat'] . '\', \'' . $penghuni['noHp'] . '\', \'' . $penghuni['tglRegistrasi'] . '\', \'' . $penghuni['kamar'] . '\')">Edit</a>
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