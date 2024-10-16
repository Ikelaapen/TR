<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "kost";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { 
    die("Tidak bisa terkoneksi ke database");
}
$no_kamar        = "";
$tipe_kamar       = "";
$harga    = "";
$status   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from kost where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil Hapus Data Kamar";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from kost where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $no_kamar       = $r1['no_kamar'];
    $tipe_kamar       = $r1['tipe_kamar'];
    $harga     = $r1['harga'];
    $status   = $r1['status'];

    if ($no_kamar == '') {
        $error = "Data Tidak Ditemukan";
    }
}
if (isset($_POST['simpan'])) { 
    $no_kamar        = $_POST['no_kamar'];
    $tipe_kamar       = $_POST['tipe_kamar'];
    $harga     = $_POST['harga'];
    $status   = $_POST['status'];

    if ($no_kamar && $tipe_kamar && $harga && $status) {
        if ($op == 'edit') { 
            $sql1       = "update kost set no_kamar = '$no_kamar',tipe_kamar='$tipe_kamar',harga = '$harga',status='$status' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { 
            $sql1   = "insert into kost(no_kamar,tipe_kamar,harga,status) values ('$no_kamar','$tipe_kamar','$harga','$status')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil Memasukkan Data Kamar";
            } else {
                $error      = "Gagal Memasukkan Data";
            }
        }
    } else {
        $error = "Silakan Masukkan Semua Data Kamar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Data Kamar</title>

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
  </style>
</head>

<body>
  <div class="container mx-auto">
    <div class="card">
      <div class="card-header">Create / Edit Data Kamar</div>
      <div class="card-body">
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
        <form action="" method="POST">
          <div class="mb-3 row">
            <label for="no_kamar"  class="col-sm-2 col-form-label">no_kamar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?php echo $no_kamar ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="tipe_kamar" class="col-sm-2 col-form-label">tipe_kamar</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar" value="<?php echo $tipe_kamar ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">harga</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="status" class="col-sm-2 col-form-label">status</label>
            <div class="col-sm-10">
              <select class="form-control" name="status" id="status">
                <option value="">- Pilih -</option>
                <option value="Kosong" <?php if ($status == "Kosong") echo "selected" ?>>Kosong</option>
                <option value="Dihuni" <?php if ($status == "Dihuni") echo "selected" ?>>Dihuni</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
          </div>
        </form>
      </div> 
    </div>

    <div class="card">
      <div class="card-header text-white bg-secondary">
        Data Kamar
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">no_kamar</th>
              <th scope="col">tipe_kamar</th>
              <th scope="col">harga</th>
              <th scope="col">status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql2 = "select * from kost order by id desc";
            $q2 = mysqli_query($koneksi, $sql2);
            $urut = 1;
            while ($r2 = mysqli_fetch_array($q2)) {
              $id = $r2['id'];
              $no_kamar = $r2['no_kamar'];
              $tipe_kamar = $r2['tipe_kamar'];
              $harga = $r2['harga'];
              $status = $r2['status'];
            ?>
              <tr>
                <th scope="row"><?php echo $urut++ ?></th>
                <td scope="row"><?php echo $no_kamar ?></td>
                <td scope="row"><?php echo $tipe_kamar ?></td>
                <td scope="row"><?php echo $harga ?></td>
                <td scope="row"><?php echo $status ?></td>
                <td scope="row">
                  <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>   

                  <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Apakah Anda Yakin Ingin Delete Data?')"><button type="button" class="btn btn-danger">Delete</button></a>   

                </td>
              </tr>
            <?php
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