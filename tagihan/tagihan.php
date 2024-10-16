<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "tagihan";  // Database name

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

// Example data for table display (replace with real queries)
$sql = "SELECT * FROM tagihan";  // Assuming your table name is `tagihan`
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
        }
        .card-header {
            background-color: orange;
            color: white;
        }
        .btn-wa {
            background-color: #25D366;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .btn-wa:hover {
            background-color: #1da653;
        }
        .status-belum {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Data Tagihan - Bulan: Agustus, Tahun: 2023</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Penghuni</th>
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
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>" . $no++ . "</td>
                                    <td>" . $row['id_penghuni'] . "</td>
                                    <td>" . $row['nama'] . "</td>
                                    <td>Rp " . number_format($row['tagihan'], 0, ',', '.') . "</td>
                                    <td><span class='status-belum'>Belum Bayar</span></td>
                                    <td>
                                        <button class='btn btn-success'>✔</button>
                                        <button class='btn-wa'>WA</button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
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
