<?php
include 'koneksibayar.php'; // Koneksi database

// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validasi parameter ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "ID tidak valid.";
    exit;
}

// Query untuk mengambil data
$query = "SELECT * FROM pelunasan WHERE idPenghuni = $id";
$result = $conn->query($query);

if (!$result) {
    echo "Error pada query: " . $conn->error;
    exit;
}

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data untuk ID Penghuni $id tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk Pelunasan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                margin: 20px 0;
                border-collapse: collapse;
            }
            table th, table td {
                padding: 8px;
                text-align: left;
                border: 1px solid #ddd;
            }
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">** Laporan Transaksi KosKit **</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Penghuni</th>
                    <th>Nama</th>
                    <th>Tagihan</th>
                    <th>Status</th>
                    <th>Tgl Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $data['idPenghuni']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td>
                        <?php 
                        if (!empty($data['tglBayar']) && strtotime($data['tglBayar'])) {
                            echo date('d-M-Y', strtotime($data['tglBayar']));
                        } else {
                            echo "Tanggal tidak valid.";
                        }
                        ?>
                    </td>
                    <td>Rp <?php echo number_format($data['tagihan'], 2, ',', '.'); ?></td>
                    <td><?php echo $data['status']; ?></td>
                    <td><?php echo $data['catatan']; ?></td>
                    
                </tr>
            </tbody>
        </table>
        <!-- Tombol untuk Print -->
        <div class="text-center">
            <button onclick="window.print();" class="btn btn-success">Cetak Struk</button>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
