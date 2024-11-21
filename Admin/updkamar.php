<?php
$conn = new mysqli("localhost", "root", "", "admin");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['id'], $_POST['no_kamar'], $_POST['tipe_kamar'], $_POST['harga'], $_POST['status'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $no_kamar = $conn->real_escape_string($_POST['no_kamar']);
    $tipe_kamar = $conn->real_escape_string($_POST['tipe_kamar']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $status = $conn->real_escape_string($_POST['status']);

    // Pastikan nama tabel sesuai dengan database
    $sql = "UPDATE kost SET
                no_kamar='$no_kamar',
                tipe_kamar='$tipe_kamar',
                harga='$harga',
                status='$status'
            WHERE id ='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: kamar2.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Data tidak lengkap.";
}

$conn->close();
?>