<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "tagihan";

// Database connection
$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$id_penghuni = "";
$nama = "";
$tagihan = "";
$status = "";
$sukses = "";
$error = "";

// Handling GET requests for 'delete' and 'edit'
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $no = $_GET['no'];
    $sql1 = "DELETE FROM tagihan WHERE no = '$no'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Hapus Data Tagihan";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $no = $_GET['no'];
    $sql1 = "SELECT * FROM tagihan WHERE no = '$no'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $id_penghuni = $r1['id_penghuni'];
    $nama = $r1['nama'];
    $tagihan = $r1['tagihan'];
    $status = $r1['status'];

    if ($id_penghuni == '') {
        $error = "Data Tidak Ditemukan";
    }
}

// Handling POST request for saving or updating data
if (isset($_POST['simpan'])) {
    $id_penghuni = $_POST['id_penghuni'];
    $nama = $_POST['nama'];
    $tagihan = $_POST['tagihan'];
    $status = $_POST['status'];

    if ($id_penghuni && $nama && $tagihan && $status) {
        if ($op == 'edit') {
            $sql1 = "UPDATE tagihan SET id_penghuni = '$id_penghuni', nama = '$nama', tagihan = '$tagihan', status = '$status' WHERE no = '$no'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO tagihan (id_penghuni, nama, tagihan, status) VALUES ('$id_penghuni', '$nama', '$tagihan', '$status')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Memasukkan Data Tagihan";
            } else {
                $error = "Gagal Memasukkan Data";
            }
        }
    } else {
        $error = "Silakan Masukkan Semua Data Tagihan";
    }
}

// Retrieve data for display in the table
$sql2 = "SELECT * FROM tagihan ORDER BY no DESC";
$q2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    text-align: center;
    color: #333;
}

.form-container {
    margin-bottom: 30px;
}

form input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.btn-save {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-save:hover {
    background-color: #218838;
}

.btn-add {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    margin-bottom: 20px;
    border-radius: 4px;
}

.btn-add:hover {
    background-color: #0069d9;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.data-table th, .data-table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.data-table th {
    background-color: #f8f9fa;
}

.btn-edit {
    background-color: #ffc107;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
}

.btn-delete {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-delete:hover {
    background-color: #c82333;
}

.alert-success {
    color: green;
    text-align: center;
    margin-bottom: 20px;
}

.alert-error {
    color: red;
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>
<body>
    <div class="container">
        <h1>Data Tagihan Penghuni</h1>

        <!-- Notification for success or error -->
        <?php if ($sukses) { ?>
            <div class="alert-success"><?php echo $sukses; ?></div>
        <?php } ?>
        <?php if ($error) { ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="form-container">
            <form action="" method="POST">
                <label for="id_penghuni">ID Penghuni</label><br>
                <input type="text" name="id_penghuni" value="<?php echo $id_penghuni; ?>"><br>

                <label for="nama">Nama</label><br>
                <input type="text" name="nama" value="<?php echo $nama; ?>"><br>

                <label for="tagihan">Tagihan</label><br>
                <input type="text" name="tagihan" value="<?php echo $tagihan; ?>"><br>

                <label for="status">Status</label><br>
                <input type="text" name="status" value="<?php echo $status; ?>"><br><br>

                <input type="submit" name="simpan" value="Simpan Data" class="btn-save">
            </form>
        </div>

        <h2>Daftar Tagihan</h2>
        <a href="your_page.php?op=create" class="btn-add">Tambah Tagihan</a>

        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID Penghuni</th>
                    <th>Nama</th>
                    <th>Tagihan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $no = $r2['no'];
                    $id_penghuni = $r2['id_penghuni'];
                    $nama = $r2['nama'];
                    $tagihan = $r2['tagihan'];
                    $status = $r2['status'];
                ?>
                    <tr>
                        <td><?php echo $urut++; ?></td>
                        <td><?php echo $id_penghuni; ?></td>
                        <td><?php echo $nama; ?></td>
                        <td><?php echo $tagihan; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                            <a href="your_page.php?op=edit&no=<?php echo $no; ?>" class="btn-edit">Edit</a>
                            <a href="your_page.php?op=delete&no=<?php echo $no; ?>" class="btn-delete" onclick="return confirm('Yakin mau delete data?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>