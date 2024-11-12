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
    $sql1 = "DELETE FROM tagihan WHERE no = '$id_penghuni'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil Hapus Data Tagihan";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
  $no = $_GET['no'];
    $sql1 = "SELECT * FROM tagihan WHERE no = '$id_penghuni'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($r1 = mysqli_fetch_array($q1)) {
    $id_penghuni = $r1['id_penghuni'];
    $nama = $r1['nama'];
    $tagihan = $r1['tagihan'];
    $status = $r1['status'];
    } else {
      $error = "Data Tidak Ditemukan";
    }
}

// Handling POST request for saving or updating data
if (isset($_POST['simpan'])) {
    $id_penghuni = $_POST['id_penghuni'];
    $nama = $_POST['nama'];
    $tagihan = $_POST['tagihan'];
    $status =  $_POST['status'] ?? '' ;

    if ($id_penghuni && $nama && $tagihan && $status) {
        if ($op == 'edit') {
            $no = $_GET['no'];
            $sql1 = "UPDATE tagihan SET id_penghuni = '$id_penghuni', nama = '$nama', tagihan = '$tagihan' ,status = '$status' WHERE no = '$no'";
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
$sql2 = "SELECT * FROM tagihan ORDER BY id_penghuni DESC";
$q2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tagihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="your-custom-styles.css">
    <style>

.mx-auto {
      max-width: 800px; 
      margin: 0 auto;
    }

    
    .card {
      margin-top: 20px; 
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      border-radius: 5px;
    }

    
    .card-header {
      font-size: 1.2em;
      font-weight: bold;
      padding: 15px; 
      background-color: #f8f9fa; 
      border-bottom: 1px solid #e0e0e0;
    }

    .table {
      margin-bottom: 0; 
      border-collapse: collapse; 
    }

    th, td {
      padding: 10px 15px; 
      border: 1px solid #e0e0e0; /
    }

    th {
      background-color: #f0f0f0; 
    }

   
    tr:hover {
      background-color: #F5F5F5; 
    }

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
<div class="container mx-auto">
    <div class="card">
      <div class="card-header">Create/Edit Data Tagihan</div>
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTagihan">
          Tambah Tagihan
        </button>

        <div class="modal fade" id="modalTambahTagihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <?php
                  if ($error) {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $error ?>
                    </div>

                  <?php
                  header("refresh:5;url=index.php");
                  }
                  ?>
                  <?php
                  if ($sukses) {
                  ?>
                    <div class="alert alert-success" role="alert">
                      <?php echo $sukses ?>
                    </div>
                  <?php
                  header("refresh:5;url=index.php");
                  }
                  ?>
                  <div class="mb-3">
                    <label for="id_penghuni" class="form-label">Id_Penghuni</label>
                    <input type="text" class="form-control" id="id_penghuni" name="id_penghuni" value="<?php echo $id_penghuni?>">
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama?>">
                  </div>
                  <div class="mb-3">
                    <label for="tagihan" class="form-label">Tagihan</label>
                    <input type="text" class="form-control" id="tagihan" name="tagihan" value="<?php echo $tagihan ?>">
                  </div>
                  <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                    <option value="" selected> Pilih </option>
                    <option value="Sudah Bayar" <?php if ($status == 'Sudah Bayar') echo 'selected';?>>Sudah Bayar</option>
                    <option value="Belum Bayar"<?php if ($status == 'Belum Bayar') echo 'selected';?>>Belum Bayar</option>
                    </select>

                  </div>
                  <div class="col-12">
                    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
       
        <h2>Daftar Tagihan</h2>
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
                            <a href="your_page.php?op=edit&no=<?php echo $id_penghuni; ?>" class="btn-edit">Edit</a>
                            <a href="your_page.php?op=delete&no=<?php echo $id_penghuni; ?>" class="btn-delete" onclick="return confirm('Yakin mau delete data?')">Delete</a>
                        </td>
                    </tr>
                <?php 
              } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>