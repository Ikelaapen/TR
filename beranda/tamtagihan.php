<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Tagihan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="tamtagihan.css">
  <link rel="stylesheet" href="beranda.css">
  <style>
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
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
    <div class="nav-center box">
        <form id="formPencarian">
            <input type="text" id="kataKunci" placeholder="Search...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="nav-right">
        <ul id="menu">
            <li class="active"><a href="beranda.php">Beranda</a></li>
            <li><a href="kamar.php">Data Kamar</a></li>
            <li><a href="dathuni.php">Data Penghuni</a></li>
            <li><a href="tagihan.php">Data Tagihan</a></li>
            <li><a href="#">Pembayaran Lunas</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="form-container">
        <h4 class="text-left">Tambah Data Tagihan</h4>
        <form id="formTagihan" action="prosestagihan.php" method="post">
            
            <div class="row mb-3">
                <label for="id_penghuni" class="col-sm-4 col-form-label text-end">Id Penghuni</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="id_penghuni" name="id_penghuni" placeholder="Id Penghuni">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label text-end">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="tglbayar" class="col-sm-4 col-form-label text-end">Tgl Bayar</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tglbayar" name="tglbayar">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="tagihan" class="col-sm-4 col-form-label text-end">Tagihan</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="tagihan" name="tagihan" placeholder="Jumlah Tagihan">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="status" class="col-sm-4 col-form-label text-end">Status</label>
                <div class="col-sm-8">
                    <select class="form-select" id="status" name="status">
                        <option selected>Pilih</option>
                        <option value="Lunas">Sudah Bayar</option>
                        <option value="Belum Lunas">Belum Bayar</option>
                    </select>
                </div>
            </div>
            
            <div class="text-end">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='tagihan.php'">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
