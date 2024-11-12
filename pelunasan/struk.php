<?php
include 'koneksibayar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pelunasan WHERE idPenghuni = $id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk Pelunasan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">** Laporan Transaksi KOSTQ **</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID Penghuni</th>
                <th>Nama</th>
                <th>Tagihan</th>
                <th>Status</th>
                <th>Tgl Bayar</th>
            </tr>
            <tr>
                <td><?php echo $data['idPenghuni']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td>Rp <?php echo number_format($data['tagihan'], 2, ',', '.'); ?></td>
                <td><?php echo $data['status']; ?></td>
                <td><?php echo date('d-M-Y'); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
