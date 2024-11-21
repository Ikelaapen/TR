<?php
include 'koneksibayar.php';

// Ambil id_penghuni dari URL
$id_penghuni = $_GET['id_penghuni'] ?? null;

if ($id_penghuni) {
    // Ambil data dari tabel pelunasan
    $query = "SELECT * FROM pelunasan WHERE id_penghuni = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id_penghuni);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        // Pastikan tagihan ada dan dalam format yang tepat
        $tagihan = isset($data['tagihan']) ? (float)$data['tagihan'] : 0.00; // Ensure it's numeric
        // Format tagihan dengan pemisah ribuan dan dua digit desimal
        $tagihan_formatted = number_format($tagihan, 0, ',', '.'); // Format to "Rp 1.000.000"
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID Penghuni tidak valid.";
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
                    <th>Id Penghuni</th>
                    <th>Nama</th>
                    <th>Tgl Bayar</th>
                    <th>Tagihan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo str_pad($data['id_penghuni'], 3, "0", STR_PAD_LEFT); ?></td>
                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    <td><?php echo (!empty($data['tglbayar']) && $data['tglbayar'] != '0000-00-00') 
    ? date("d-m-Y", strtotime($data['tglbayar'])) 
    : 'Tidak Ada'; ?></td>
                    <td>Rp <?php echo $tagihan_formatted; ?></td>
                    <td><?php echo htmlspecialchars($data['status']); ?></td>
                    
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
