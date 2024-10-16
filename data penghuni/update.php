<?php
$conn = new mysqli("localhost:8111", "root", "", "data_penghuni");

if ($conn->connect_error){
    die("Koneksi gagal: " . $conn->connect_error);
}


$idpenghuni = $_POST['idpenghuni'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$noHp = $_POST['noHp'];
$tglRegistrasi = $_POST['tglRegistrasi'];
$kamar = $_POST['kamar'];

$sql = "UPDATE penghuni SET
            nama='$nama',
            alamat='$alamat',
            noHp='$noHp',
            tglRegistrasi='$tglRegistrasi',
            kamar='$kamar'
        WHERE idpenghuni='$idpenghuni'";

if ($conn->query($sql) === TRUE){
    header("Location: dathuni.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>