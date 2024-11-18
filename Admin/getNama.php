<?php
include('koneksi.php');

if (isset($_GET['id_penghuni'])) {
    $id_penghuni = $_GET['id_penghuni'];
    $query = "SELECT nama FROM penghuni WHERE id_penghuni = '$id_penghuni'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['nama' => $row['nama']]);
    } else {
        echo json_encode(['nama' => '']);
    }
}
?>
