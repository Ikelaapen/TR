<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="beranda.css" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/80b4ed07b3.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="beranda.php">
                <h3>Kos Kit</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu Navigasi -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="kamar2.php">Data Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="dathuni.php">Data Penghuni</a></li>
                    <li class="nav-item"><a class="nav-link" href="tagihan.php">Data Tagihan</a></li>
                    <li class="nav-item"><a class="nav-link" href="pelunasan.php">Pelunasan</a></li>
                </ul>
                
                <!-- logout -->
                <div class="logout-container">
                    <a href="menu login.php" class="nav-link logout-btn">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Rest of your content remains the same -->
     <section class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4 text-center fw-bolder">Selamat Datang</h1>
</div>
<!-- SVG Waves -->
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,160L26.7,160C53.3,160,107,160,160,149.3C213.3,139,267,117,320,128C373.3,139,427,181,480,197.3C533.3,213,587,203,640,213.3C693.3,224,747,256,800,234.7C853.3,213,907,139,960,144C1013.3,149,1067,235,1120,256C1173.3,277,1227,235,1280,229.3C1333.3,224,1387,256,1413,272L1440,288L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- Awal Deskripsi -->
    <section id="deskripsi">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-sm">
                    <h2>Cerita Kos Kit</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5">
                <div class="col-md-5">
                    <p>
                        Website ini digunakan untuk manajemen kost “KosKit” agar penghuni dan pengelola dapat saling berinteraksi.
                        Terdapat beberapa fitur dalam website ini yaitu Beranda, Data Kamar, Data Penghuni, Data Tagihan, Pembayaran Lunas.
                        Ada beberapa penjelasan tiap fitur:
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Deskripsi -->

 <!-- Awal Card -->
<section id="suasanapohon">
  <div class="container">
      <div class="row">
          <div class="col-md-3 mb-3">
              <div class="card" onclick="toggleDescription(this)">
                  <img src="data kamar.jpeg" class="card-img-top" alt="data kamar" />
                  <div class="card-body">
                      <h3 class="card-text">Data Kamar</h3>
                      <p class="card-description" style="display: none;">Menampilkan no.kamar, tipe kamar, harga dan status huni</p>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <div class="card" onclick="toggleDescription(this)">
                  <img src="penghuni.jpeg" class="card-img-top" alt="penghuni" />
                  <div class="card-body">
                      <h3 class="card-text">Data Penghuni</h3>
                      <p class="card-description" style="display: none;">Menampilkan data penghuni berupa nama, alamat, no.hp, dan jika ada penghuni baru maka bisa menambahkan data penghuni baru tersebut.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <div class="card" onclick="toggleDescription(this)">
                  <img src="tagihan.jpeg" class="card-img-top" alt="tagihan" />
                  <div class="card-body">
                      <h3 class="card-text">Data Tagihan</h3>
                      <p class="card-description" style="display: none;">Penghuni akan diminta ingin melihat tagihan pada bulan dan tahun kemudian sistem akan menampilkan data penghuni seperti nama, tagihan, status pembayaran, aksi. Pengelola juga bisa menambahkan data tagihan bagi penghuni yang belum membayar atau sudah waktunya untuk membayar uang kost.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <div class="card" onclick="toggleDescription(this)">
                  <img src="lunas.jpeg" class="card-img-top" alt="lunas" />
                  <div class="card-body">
                      <h3 class="card-text">Pembayaran Lunas</h3>
                      <p class="card-description" style="display: none;">Menampilkan data penghuni ketika selesai membayar uang kost dan status pembayaran berhasil atau tidak.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- Akhir Card -->


    <!-- Awal Footer -->
    <footer class="bg-success p-2 text-white text-center text-lg-start">
        <div class="container-fluid p-4">
            <div class="text-center p-3">© 2024 Hak Cipta: Eunike Loise, Tiara Naomi, Nathania Kumalasari, Armastya Reyhan</div>
        </div>
    </footer>
    <!-- Akhir Footer -->
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
  function toggleDescription(card) {
      const description = card.querySelector('.card-description');
      if (description.style.display === 'none' || description.style.display === '') {
          description.style.display = 'block'; // Menampilkan deskripsi
      } else {
          description.style.display = 'none'; // Menyembunyikan deskripsi
      }
  }
</script>

</html>
