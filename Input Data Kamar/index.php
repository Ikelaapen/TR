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

    /* Awal CSS Navbar */
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  padding-top: 100px; /* Ensure content isn't hidden behind navbar */
}

nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: white;
  padding: 10px 20px;
  border-bottom: 1px solid gray;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

/*kiri : profil dan koskit */
.nav-left{
  display: flex;
  align-items: center;
}
.nav-left h1 a{
  text-decoration:none;
  color: #3CB371;
  font-size: 24px;
  font-weight: 600;
  display: flex;
  align-items: center;
}

    .profil{
      width: 60px;
      height: 60px;
      border-radius: 50%;
      margin-right: 20px;
    }

    /* kotak pencarian */
.nav-center{
  flex-grow: 1;
  display: flex;
  justify-content: center;
}

nav input[type='text'] {
  padding: 10px 15px;
  border: none;
  font-size: 16px;
  width: 200px;
  border-radius: 25px 0 0 25px;
}

nav button {
  background: none;
  border: none;
  cursor: pointer;
  padding: 10px 15px;
  color: #333;
  border-radius: 0 25px 25px 0;
}

/* menu navigasi */
.nav-right ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.nav-right ul li {
  margin-left: 20px;
}

.nav-right ul li a {
  text-decoration: none;
  color: #6c757d;
  font-size: 18px;
  font-weight: 400;
  transition: color 0.3s ease;
}

.nav-right ul li a:hover {
  color: #32de8a;
}

.nav-right ul li a.active {
  color: #32de8a;
  border-bottom: 2px solid #32de8a;
}

/* Akhir CSS Navbar */

/* Awal CSS Body */
/* Jumbotron Section */
.jumbotron {
  padding-top: 15rem;
  background-color: #3CB371;
  color: white;
  text-align: center;
  width: 100%;
  background-size: cover;
  background-position: center;
}

.col-sm {
  color: #32de8a;
}

.jumbotron1 {
  background-color: #c1c1c1;
}
  </style>
</head>

<body>
  <style>
/* Awal CSS Navbar */
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  padding-top: 80px; /* Ensure content isn't hidden behind navbar */
}

nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: white;
  padding: 10px 20px;
  border-bottom: 1px solid gray;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

/*kiri : profil dan koskit */
.nav-left{
  display: flex;
  align-items: center;
}
.nav-left h1 a{
  text-decoration:none;
  color: #3CB371;
  font-size: 24px;
  font-weight: 600;
  display: flex;
  align-items: center;
}

.profil{
  width: 60px;
  height: 60px;
  border-radius: 50%;
  margin-right: 20px;
}

/* kotak pencarian */
.nav-center{
  flex-grow: 1;
  display: flex;
  justify-content: center;
}

nav input[type='text'] {
  padding: 10px 15px;
  border: none;
  font-size: 16px;
  width: 200px;
  border-radius: 25px 0 0 25px;
}

nav button {
  background: none;
  border: none;
  cursor: pointer;
  padding: 10px 15px;
  color: #333;
  border-radius: 0 25px 25px 0;
}

/* menu navigasi */
.nav-right ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}

.nav-right ul li {
  margin-left: 20px;
}

.nav-right ul li a {
  text-decoration: none;
  color: #6c757d;
  font-size: 18px;
  font-weight: 400;
  transition: color 0.3s ease;
}

.nav-right ul li a:hover {
  color: #32de8a;
}

.nav-right ul li a.active {
  color: #32de8a;
  border-bottom: 2px solid #32de8a;
}

/* Akhir CSS Navbar */
  </style>
      <!-- Navigasi -->
      <nav>
      <div class="nav-left">
        <h1>
          <a href="">
        <img src="profil.jpg" alt="Profil" class="profil" />
        <span>Kos Kit</span>
        </a>
        </h1>
      </div>

        <!-- Kotak Pencarian -->
        <div class="nav-center box">
            <form id="formPencarian">
                <input type="text" id="kataKunci" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Menu Navigasi -->
         <div class="nav-right">
        <ul id="menu">
            <li class="active"><a href="#">Beranda</a></li>
            <li><a href="#">Data Kamar</a></li>
            <li><a href="#">Data Penghuni</a></li>
            <li><a href="#">Data Tagihan</a></li>
            <li><a href="#">Pembayaran Lunas</a></li>
        </ul>
    </nav>
  </div>
  
  <div class="container mx-auto">
    <div class="card">
      <div class="card-header">Create / Edit Data Kamar</div>
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKamar">
          Tambah Kamar
        </button>

        <div class="modal fade" id="modalTambahKamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kamar Baru</h5>
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
                    <label for="no_kamar" class="form-label">No. Kamar</label>
                    <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?php echo $no_kamar ?>">
                  </div>
                  <div class="mb-3">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                    <select class="form-select" name="tipe_kamar" id="tipe_kamar">
                      <option value="">- Pilih -</option>
                      <option value="Tanpa AC" <?php if ($status == "Tanpa AC") echo "selected" ?>>Tanpa AC</option>
                      <option value="Dengan AC" <?php if ($status == "Dengan AC") echo "selected" ?>>Dengan AC</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
                  </div>
                  <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                      <option value="">- Pilih -</option>
                      <option value="Kosong" <?php if ($status == "Kosong") echo "selected" ?>>Kosong</option>
                      <option value="Dihuni" <?php if ($status == "Dihuni") echo "selected" ?>>Dihuni</option>
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

    <div class="card">
      <div class="card-header text-white bg-secondary">
        Data Kamar
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">No Kamar</th>
              <th scope="col">Tipe Kamar</th>
              <th scope="col">Harga</th>
              <th scope="col">Status</th>
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