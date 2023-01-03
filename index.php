<?php
  include('header.php');
?>

<main id="main">

<!-- ======= Carousel ======= -->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  
  <div class="carousel-inner">
    <div class="carousel-item active" style="height: 600px;">
      <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
        <rect width="100%" height="100%" fill="#FFDA72">
      </svg>
      <div class="container">
        <div class="carousel-caption text-start">
          <h1><b>WM Hana Asri</b></h1>
          <p>Some representative placeholder content for the first slide of the carousel.</p>
          <p><a class="btn btn-lg" href="#">Sign up today</a></p>
        </div>
      </div>
    </div>
    <div class="carousel-item" style="height: 600px;">
      <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
        <rect width="100%" height="100%" fill="#FFDA72" />
      </svg>
      <div class="container">
        <div class="carousel-caption">
          <h1><b>Recommended Catering</b></h1>
          <p>Some representative placeholder content for the second slide of the carousel.</p>
          <p><a class="btn btn-lg" href="#">Learn more</a></p>
        </div>
      </div>
    </div>
          
    <div class="carousel-item" style="height: 600px;">
      <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
        <rect width="100%" height="100%" fill="#FFDA72" />
      </svg>
      <div class="container">
        <div class="carousel-caption text-end">
          <h1><b>One more for good measure</b></h1>
          <p>Some representative placeholder content for the third slide of this carousel.</p>
          <p><a class="btn btn-lg" href="#">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
        
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</div>
<!-- End Carousel -->

<!-- ======= Categories Section ======= -->
<section id="categories" class="what-we-do">
  
  <div class="container">

    <div class="section-title">
      <h2>Kategori</h2>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <div class="icon-box">
          <div class="icon"><i class="bx bx-file"></i></div>
            <h4><a href="categories.php?id_kategori=1">Harian</a></h4>
            <p>Paket Harian dengan banyak pilihan menu setiap harinya</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="categories.php?id_kategori=2">Prasmanan</a></h4>
              <p>Paket Prasmanan dengan satu menu untuk bersama-sama</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="categories.php?id_kategori=3">Kotakan</a></h4>
              <p>Paket Kotakan dengan banyak pilihan menu untuk mendukung kegiatan anda</p>
            </div>
          </div>
        </div>  
      </div>
  </div>
</section>
<!-- Categories Section -->
    
<!-- popular section starts  -->
<section id="menu" class="what-we-do">
  <div class="container">

    <div class="section-title">
      <h2>Rekomendasi Menu</h2>
    </div>

    <div class="row">
      <?php 
        $batas = 6;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  
 
        $previous = $halaman - 1;
        $next = $halaman + 1;
        
        $data = mysqli_query($koneksi,"SELECT * FROM menu;");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
 
        $data_menu = mysqli_query($koneksi,"SELECT * FROM menu LIMIT $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($d = mysqli_fetch_array($data_menu)){
      ?>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-0" style="margin-bottom: 30px;">
          <div class="card icon-box" style="border-radius: 20px;">
            <div class="img">
              <img src="assets/img/menu/<?php echo $d['gambar']; ?>" alt="" width="300px" height="250px" style="border-radius: 20px;">
            </div>
            <br>
            <h4><a href="product_detail.php"><?php echo $d['nama_menu']; ?></a></h4>
            <h5 class="text-secondary" style="font-family: 'Open Sans', sans-serif;"><?php echo rupiah($d['harga']); ?></h5>
          <div>
          <a href="product_detail.php?id_menu=<?php echo $d['id_menu'] ?>"><button class="btn m-2 pt-2 pb-2" style="color: #E8853D;">Detail Menu</button></a>
          <?php 
          if(isset($_SESSION['id'])) {
          ?>
          <button class="btn m-2" style="background-color: #E8853D;">
            <a href="cart.php?id_menu=<?php echo $d['id_menu'] ?> & action=add" style="color: #fff; font-size: 20px"><span class="bi-cart2"></span></a>
          </button>
        </div>
      </div>
    </div>
      <?php }else{ ?>
        <button class="btn m-2" style="background-color: #E8853D;">
            <a onclick="return confirm('Silahkan Login Terlebih Dahulu!')" href="login.php" style="color: #fff; font-size: 20px"><span class="bi-cart2"></span></a>
          </button>
        </div>
      </div>
    </div>
      <?php }} ?>       
  </div>
</section>
<!-- End Section -->

</main>
<!-- End #main -->

<?php 
  include('footer.php')
?>