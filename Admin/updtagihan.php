<?php
$conn = new mysqli("localhost", "root", "", "tagihan");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}


$id_penghuni = $_POST['id_penghuni'];
$nama = $_POST['nama'];
$tglbayar = $_POST['tglbayar'];
$tagihan = $_POST['tagihan'];
$status = $_POST['status'];
$catatan = $_POST['catatan'];

$sql = "UPDATE tagihan SET
            nama='$nama',
            tglbayar='$tglbayar',
            tagihan='$tagihan',
            status='$status',
            catatan='$catatan'
        WHERE id_penghuni='$id_penghuni'";

if ($conn->query($sql) === TRUE){
    header("Location: tagihan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>