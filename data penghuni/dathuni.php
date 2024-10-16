<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penghuni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dathuni.css">
</head>
<script>
    function editData(id, nama, alamat, noHp, tglRegistrasi, kamar){
        document.getElementById('idpenghuni').value = id;
        document.getElementById('nama').value = nama;
        document.getElementById('alamat').value = alamat;
        document.getElementById('noHp').value = noHp;
        document.getElementById('tglRegistrasi').value = tglRegistrasi;
        document.getElementById('kamar').value = kamar;

        document.getElementById('formPenghuni').action = 'update.php';
    }
</script>
<body>
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
                        $conn = new mysqli("localhost:8111", "root", "", "data_penghuni");

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
                                echo "<td>Kamar" . $penghuni['kamar'] . "</td>";
                                echo '<td>
                                    <a href="hapus.php?idpenghuni=' . $penghuni['idpenghuni'] . '" class="btn btn-success btn-sm">Hapus</a>
                                    <a href="edit.php?idpenghuni=' . $penghuni['idpenghuni'] . '" class="btn btn-danger btn-sm" onclick="editData (\'' . $penghuni['idpenghuni'] . '\', \'' . $penghuni['nama'] . '\', \'' . $penghuni['alamat'] . '\', \'' . $penghuni['noHp'] . '\', \'' . $penghuni['tglRegistrasi'] . '\', \'' . $penghuni['kamar'] . '\')">Edit</button>
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
